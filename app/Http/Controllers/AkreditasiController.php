<?php

namespace App\Http\Controllers;

use App\Models\Komponen;
use App\Models\SubKomponen;
use App\Models\Indikator;
use App\Models\SubIndikator;
use App\Models\DokumenBukti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AkreditasiController extends Controller
{
    private function sortKomponens($komponens)
    {
        return $komponens->sortBy('nomor')->values()->map(function($komp) {
            if ($komp->relationLoaded('subKomponens')) {
                $komp->setRelation('subKomponens', $komp->subKomponens->sortBy('nomor_sub', SORT_NATURAL)->values()->map(function($sub) {
                    if ($sub->relationLoaded('indikators')) {
                        $sub->setRelation('indikators', $sub->indikators->sortBy('nomor_indikator', SORT_NATURAL)->values()->map(function($ind) {
                            if ($ind->relationLoaded('subIndikators')) {
                                $ind->setRelation('subIndikators', $ind->subIndikators->sortBy('nomor_sub_indikator', SORT_NATURAL)->values());
                            }
                            return $ind;
                        }));
                    }
                    return $sub;
                }));
            }
            return $komp;
        });
    }

    public function index()
    {
        // Fetch all komponen with their related data
        $komponens = Komponen::with([
            'subKomponens.indikators.subIndikators.dokumenBuktis',
            'subKomponens.indikators.dokumenBuktis',
            'subKomponens.dokumenBuktis'
        ])->get();
        $komponens = $this->sortKomponens($komponens);
        return view('welcome', compact('komponens'));
    }

    public function adminDashboard()
    {
        $komponens = Komponen::with([
            'subKomponens.indikators.subIndikators.dokumenBuktis',
            'subKomponens.indikators.dokumenBuktis',
            'subKomponens.dokumenBuktis'
        ])->get();
        $komponens = $this->sortKomponens($komponens);
        return view('admin.dashboard', compact('komponens'));
    }

    public function exportReport()
    {
        $komponens = Komponen::with([
            'subKomponens.indikators.subIndikators.dokumenBuktis',
            'subKomponens.indikators.dokumenBuktis',
            'subKomponens.dokumenBuktis'
        ])->get();
        $komponens = $this->sortKomponens($komponens);
        return view('admin.report', compact('komponens'));
    }

    public function upload(Request $request, $type = null, $id = null)
    {
        $isYoutube = $request->has('youtube_link') && !empty($request->youtube_link);
        $isDrive = $request->has('drive_link') && !empty($request->drive_link);

        if ($isYoutube) {
            $request->validate([
                'youtube_link' => 'required|url',
                'nama_video' => 'nullable|string|max:255',
            ]);
            $path_file = $request->youtube_link;
            $nama_file = $request->nama_video;
            
            // Auto-fetch title from YouTube if not provided
            if (empty($nama_file)) {
                try {
                    $response = \Illuminate\Support\Facades\Http::timeout(5)->get($path_file);
                    if ($response->successful() && preg_match('/<title>(.*?)<\/title>/i', $response->body(), $matches)) {
                        $title = html_entity_decode($matches[1]);
                        $nama_file = trim(str_ireplace(' - YouTube', '', $title));
                    }
                } catch (\Exception $e) {}
                
                if (empty($nama_file)) $nama_file = 'Video YouTube';
            }
        } elseif ($isDrive) {
            $request->validate([
                'drive_link' => 'required|url',
                'nama_drive' => 'nullable|string|max:255',
            ]);
            $path_file = $request->drive_link;
            $nama_file = $request->nama_drive;
            
            // Auto-fetch title from Google Drive if not provided
            if (empty($nama_file)) {
                try {
                    $response = \Illuminate\Support\Facades\Http::timeout(5)->get($path_file);
                    if ($response->successful()) {
                        $body = $response->body();
                        $title = '';
                        
                        if (preg_match('/<meta\s+property=["\']og:title["\']\s+content=["\'](.*?)["\']/i', $body, $matches) || preg_match('/<meta\s+content=["\'](.*?)["\']\s+property=["\']og:title["\']/i', $body, $matches)) {
                            $title = html_entity_decode($matches[1]);
                        } elseif (preg_match('/<title>(.*?)<\/title>/i', $body, $matches)) {
                            $title = html_entity_decode($matches[1]);
                        }

                        $hapusKata = [
                            ' - Google Drive', ' - Google Docs', ' - Google Dokumen', 
                            ' - Google Sheets', ' - Google Spreadsheet', ' - Google Slides',
                            ' - Microsoft Word', ' - Microsoft Excel', ' - Microsoft PowerPoint',
                            'Google Dokumen - ', 'Google Docs - ', 'Microsoft Word - '
                        ];
                        
                        $nama_file = trim(str_ireplace($hapusKata, '', $title));
                    }
                } catch (\Exception $e) {}
                
                // Fallbacks in case it hits a generic login or error page
                $genericNames = [
                    'Google Drive', 'Google Dokumen', 'Google Docs', 
                    'Microsoft Word', 'Microsoft Dokumen', 'Meet Google Drive',
                    'Memuat Google Dokumen', 'Loading Google Docs'
                ];
                if (empty($nama_file) || in_array($nama_file, $genericNames) || str_contains(strtolower($nama_file), 'meet google drive')) {
                    $nama_file = 'Dokumen Drive';
                }
            }
        } else {
            return back()->with('error', 'Silakan masukkan link Google Drive atau YouTube.');
        }

        // Handle backward compatibility (if old route is called)
        if (is_numeric($type) && $id === null) {
            $id = $type;
            $type = 'sub_komponen';
        }

        $subKomponenId = null;
        $indikatorId = null;
        $subIndikatorId = null;
        $code = '';

        $cleanFn = function($str) {
            return str_replace(['/', '\\', ':', '*', '?', '"', '<', '>', '|'], '-', $str);
        };

        if ($type === 'sub_indikator') {
            $subIndikator = SubIndikator::with('indikator.subKomponen.komponen')->findOrFail($id);
            $subIndikatorId = $subIndikator->id;
            $indikator = $subIndikator->indikator;
            $indikatorId = $indikator->id;
            $sub = $indikator->subKomponen;
            $subKomponenId = $sub->id;
            $komponen = $sub->komponen;
            $code = $subIndikator->nomor_sub_indikator;

            $folder_komponen = $cleanFn($komponen->nomor . '. ' . $komponen->nama_komponen);
            $folder_sub = $cleanFn($sub->nomor_sub . ' ' . $sub->nama_sub_komponen);
            $folder_ind = $cleanFn($indikator->nomor_indikator . ' ' . $indikator->nama_indikator);
            $folder_sub_ind = $cleanFn($subIndikator->nomor_sub_indikator . ' ' . $subIndikator->nama_sub_indikator);

            $dynamic_path = "dokumen_bukti/{$folder_komponen}/{$folder_sub}/{$folder_ind}/{$folder_sub_ind}";
        } elseif ($type === 'indikator') {
            $indikator = Indikator::with('subKomponen.komponen')->findOrFail($id);
            $indikatorId = $indikator->id;
            $sub = $indikator->subKomponen;
            $subKomponenId = $sub->id;
            $komponen = $sub->komponen;
            $code = $indikator->nomor_indikator;

            $folder_komponen = $cleanFn($komponen->nomor . '. ' . $komponen->nama_komponen);
            $folder_sub = $cleanFn($sub->nomor_sub . ' ' . $sub->nama_sub_komponen);
            $folder_ind = $cleanFn($indikator->nomor_indikator . ' ' . $indikator->nama_indikator);

            $dynamic_path = "dokumen_bukti/{$folder_komponen}/{$folder_sub}/{$folder_ind}";
        } else { // sub_komponen
            $sub = SubKomponen::with('komponen')->findOrFail($id);
            $subKomponenId = $sub->id;
            $komponen = $sub->komponen;
            $code = $sub->nomor_sub;

            $folder_komponen = $cleanFn($komponen->nomor . '. ' . $komponen->nama_komponen);
            $folder_sub = $cleanFn($sub->nomor_sub . ' ' . $sub->nama_sub_komponen);

            $dynamic_path = "dokumen_bukti/{$folder_komponen}/{$folder_sub}";
        }

        // Prepend code/prefix to filename if not already present
        if (!str_starts_with($nama_file, $code)) {
            $nama_file = $code . ' ' . $nama_file;
        }

        // Find if there is an empty slot for this target to update
        $query = DokumenBukti::query();
        if ($type === 'sub_indikator') {
            $query->where('sub_indikator_id', $subIndikatorId);
        } elseif ($type === 'indikator') {
            $query->where('indikator_id', $indikatorId);
        } else {
            $query->where('sub_komponen_id', $subKomponenId);
        }

        $emptySlot = $query->where(function($q) {
            $q->whereNull('nama_file')->orWhere('nama_file', '');
        })->first();

        try {
            DB::statement('COMMIT');
        } catch (\Exception $e) {}

        DB::beginTransaction();
        try {
            if ($emptySlot) {
                $emptySlot->update([
                    'kode_dokumen' => $code,
                    'nama_file' => $nama_file,
                    'path_file' => $path_file,
                    'tanggal_upload' => now(),
                ]);
            } else {
                DokumenBukti::create([
                    'sub_komponen_id' => $subKomponenId,
                    'indikator_id' => $indikatorId,
                    'sub_indikator_id' => $subIndikatorId,
                    'kode_dokumen' => $code,
                    'nama_file' => $nama_file,
                    'path_file' => $path_file,
                    'tanggal_upload' => now(),
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('DB save error in upload: ' . $e->getMessage());
            throw $e;
        }

        return back()->with('success', $isYoutube ? 'Link YouTube berhasil ditambahkan!' : 'Dokumen berhasil diunggah!');
    }

    public function viewDocument($id)
    {
        $dokumen = DokumenBukti::findOrFail($id);
        return view('viewer', compact('dokumen'));
    }
    public function updateDokumen(Request $request, $id)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'link' => 'nullable|url|max:2000'
        ]);

        $dokumen = DokumenBukti::findOrFail($id);
        
        try {
            DB::statement('COMMIT');
        } catch (\Exception $e) {}

        DB::beginTransaction();
        try {
            $data = ['nama_file' => $request->nama_file];
            
            if (($dokumen->is_youtube || $dokumen->is_drive) && $request->filled('link')) {
                $data['path_file'] = $request->link;
            }
            
            $dokumen->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('DB save error in updateDokumen: ' . $e->getMessage());
            throw $e;
        }

        return back()->with('success', 'Dokumen berhasil diperbarui!');
    }

    public function deleteDokumen($id)
    {
        $dokumen = DokumenBukti::findOrFail($id);
        
        // Soft delete: Do NOT delete physical file here.
        // if ($dokumen->path_file && Storage::disk('public')->exists($dokumen->path_file)) {
        //     Storage::disk('public')->delete($dokumen->path_file);
        // }
        
        try {
            DB::statement('COMMIT');
        } catch (\Exception $e) {}

        DB::beginTransaction();
        try {
            $dokumen->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('DB delete error in deleteDokumen: ' . $e->getMessage());
            throw $e;
        }
        
        return back()->with('success', 'Dokumen berhasil dihapus dari sistem dan database!');
    }

    public function tambahSlot(Request $request)
    {
        $request->validate([
            'type'       => 'required|in:sub_komponen,indikator,sub_indikator',
            'id'         => 'required|integer',
            'nomor_slot' => 'nullable|string|max:50',
            'nama_slot'  => 'nullable|string|max:255',
        ]);

        $type = $request->type;
        $id   = $request->id;
        $customNomor = trim($request->input('nomor_slot', ''));
        $customNama  = trim($request->input('nama_slot', ''));

        try { DB::statement('COMMIT'); } catch (\Exception $e) {}

        DB::beginTransaction();
        try {
            if ($type === 'sub_indikator' || $type === 'indikator') {
                if ($type === 'sub_indikator') {
                    $subInd = SubIndikator::with('indikator')->findOrFail($id);
                    $indikator = $subInd->indikator;
                } else {
                    $indikator = Indikator::with('subIndikators')->findOrFail($id);
                }

                if (!empty($customNomor)) {
                    $newCode = $customNomor;
                } else {
                    $existing = SubIndikator::where('indikator_id', $indikator->id)->get();
                    $existingNums = [];
                    foreach ($existing as $item) {
                        if (preg_match('/-(\d+)$/', $item->nomor_sub_indikator, $matches)) {
                            $existingNums[] = (int)$matches[1];
                        }
                    }
                    $nextSuffix = 1;
                    if (!empty($existingNums)) {
                        sort($existingNums);
                        $foundGap = false;
                        for ($i = 1; $i <= max($existingNums); $i++) {
                            if (!in_array($i, $existingNums)) {
                                $nextSuffix = $i;
                                $foundGap = true;
                                break;
                            }
                        }
                        if (!$foundGap) {
                            $nextSuffix = max($existingNums) + 1;
                        }
                    }
                    $newCode = $indikator->nomor_indikator . '-' . $nextSuffix;
                }

                $namaSlot = !empty($customNama) ? $customNama : 'Slot ' . $newCode;

                SubIndikator::create([
                    'indikator_id'        => $indikator->id,
                    'nomor_sub_indikator' => $newCode,
                    'nama_sub_indikator'  => $namaSlot,
                ]);

            } else { // type === 'sub_komponen'
                $subKomponen = SubKomponen::with('indikators')->findOrFail($id);
                
                if (!empty($customNomor)) {
                    $newCode = $customNomor;
                } else {
                    $existing = Indikator::where('sub_komponen_id', $subKomponen->id)->get();
                    $maxNum = 0;
                    foreach ($existing as $item) {
                        $parts = explode('.', $item->nomor_indikator);
                        $lastPart = end($parts);
                        if (is_numeric($lastPart)) {
                            $num = (int)$lastPart;
                            if ($num > $maxNum) {
                                $maxNum = $num;
                            }
                        }
                    }
                    if ($maxNum === 0 && $existing->count() > 0) {
                        $maxNum = $existing->count();
                    }
                    $nextNum = $maxNum + 1;
                    $newCode = $subKomponen->nomor_sub . '.' . $nextNum;
                }

                $namaSlot = !empty($customNama) ? $customNama : 'Slot ' . $newCode;

                Indikator::create([
                    'sub_komponen_id' => $subKomponen->id,
                    'nomor_indikator' => $newCode,
                    'nama_indikator'  => $namaSlot,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('DB error in tambahSlot: ' . $e->getMessage());
            throw $e;
        }

        return back()->with('success', 'Slot baru berhasil ditambahkan!');
    }

    public function updateSlot(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:sub_komponen,indikator,sub_indikator',
            'nama_slot' => 'required|string|max:255',
        ]);

        $type = $request->type;
        $namaSlot = $request->nama_slot;

        try { DB::statement('COMMIT'); } catch (\Exception $e) {}

        DB::beginTransaction();
        try {
            if ($type === 'sub_indikator') {
                $slot = SubIndikator::findOrFail($id);
                $slot->update(['nama_sub_indikator' => $namaSlot]);
            } elseif ($type === 'indikator') {
                $slot = Indikator::findOrFail($id);
                $slot->update(['nama_indikator' => $namaSlot]);
            } else {
                $slot = SubKomponen::findOrFail($id);
                $slot->update(['nama_sub_komponen' => $namaSlot]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('DB error in updateSlot: ' . $e->getMessage());
            throw $e;
        }

        return back()->with('success', 'Nama slot berhasil diubah!');
    }

    public function hapusSlot(Request $request, $id)
    {
        $type = $request->input('type', 'sub_indikator');

        try { DB::statement('COMMIT'); } catch (\Exception $e) {}

        DB::beginTransaction();
        try {
            if ($type === 'sub_indikator') {
                $subIndikator = SubIndikator::with('dokumenBuktis')->findOrFail($id);
                // Soft delete only
                DokumenBukti::where('sub_indikator_id', $id)->delete();
                $subIndikator->delete();
            } elseif ($type === 'indikator') {
                $indikator = Indikator::with(['dokumenBuktis', 'subIndikators.dokumenBuktis'])->findOrFail($id);
                foreach ($indikator->subIndikators as $si) {
                    DokumenBukti::where('sub_indikator_id', $si->id)->delete();
                    $si->delete();
                }
                DokumenBukti::where('indikator_id', $id)->delete();
                $indikator->delete();
            } else {
                $subKomponen = SubKomponen::with(['dokumenBuktis', 'indikators.dokumenBuktis'])->findOrFail($id);
                // For sub_komponen, we only delete its own documents and itself based on previous logic
                DokumenBukti::where('sub_komponen_id', $id)->delete();
                $subKomponen->delete();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('DB error in hapusSlot: ' . $e->getMessage());
            throw $e;
        }

        return back()->with('success', 'Slot beserta seluruh isinya berhasil dimasukkan ke Tempat Sampah!');
    }

    public function trash()
    {
        $trashedDokumen = DokumenBukti::onlyTrashed()->get();
        $trashedSubIndikator = SubIndikator::onlyTrashed()->get();
        $trashedIndikator = Indikator::onlyTrashed()->get();
        $trashedSubKomponen = SubKomponen::onlyTrashed()->get();

        return view('admin.trash', compact('trashedDokumen', 'trashedSubIndikator', 'trashedIndikator', 'trashedSubKomponen'));
    }

    public function restoreSlot(Request $request, $id)
    {
        $type = $request->input('type');

        if ($type === 'dokumen') {
            DokumenBukti::onlyTrashed()->where('id', $id)->restore();
        } elseif ($type === 'sub_indikator') {
            SubIndikator::onlyTrashed()->where('id', $id)->restore();
            DokumenBukti::onlyTrashed()->where('sub_indikator_id', $id)->restore();
        } elseif ($type === 'indikator') {
            Indikator::onlyTrashed()->where('id', $id)->restore();
            $subIndikators = SubIndikator::onlyTrashed()->where('indikator_id', $id)->get();
            foreach ($subIndikators as $si) {
                $si->restore();
                DokumenBukti::onlyTrashed()->where('sub_indikator_id', $si->id)->restore();
            }
            DokumenBukti::onlyTrashed()->where('indikator_id', $id)->restore();
        } elseif ($type === 'sub_komponen') {
            SubKomponen::onlyTrashed()->where('id', $id)->restore();
            DokumenBukti::onlyTrashed()->where('sub_komponen_id', $id)->restore();
        }

        return back()->with('success', 'Data berhasil dipulihkan!');
    }

    public function forceDeleteSlot(Request $request, $id)
    {
        $type = $request->input('type');

        if ($type === 'dokumen') {
            $doc = DokumenBukti::onlyTrashed()->where('id', $id)->firstOrFail();
            if ($doc->path_file && Storage::disk('public')->exists($doc->path_file)) {
                Storage::disk('public')->delete($doc->path_file);
            }
            $doc->forceDelete();
        } elseif ($type === 'sub_indikator') {
            $subInd = SubIndikator::onlyTrashed()->with(['dokumenBuktis' => function($q) { $q->onlyTrashed(); }])->where('id', $id)->firstOrFail();
            $docs = DokumenBukti::onlyTrashed()->where('sub_indikator_id', $id)->get();
            foreach ($docs as $doc) {
                if ($doc->path_file && Storage::disk('public')->exists($doc->path_file)) {
                    Storage::disk('public')->delete($doc->path_file);
                }
                $doc->forceDelete();
            }
            $subInd->forceDelete();
        } elseif ($type === 'indikator') {
            $indikator = Indikator::onlyTrashed()->where('id', $id)->firstOrFail();
            $docs = DokumenBukti::onlyTrashed()->where('indikator_id', $id)->get();
            foreach ($docs as $doc) {
                if ($doc->path_file && Storage::disk('public')->exists($doc->path_file)) {
                    Storage::disk('public')->delete($doc->path_file);
                }
                $doc->forceDelete();
            }
            
            $subIndikators = SubIndikator::onlyTrashed()->where('indikator_id', $id)->get();
            foreach ($subIndikators as $si) {
                $siDocs = DokumenBukti::onlyTrashed()->where('sub_indikator_id', $si->id)->get();
                foreach ($siDocs as $doc) {
                    if ($doc->path_file && Storage::disk('public')->exists($doc->path_file)) {
                        Storage::disk('public')->delete($doc->path_file);
                    }
                    $doc->forceDelete();
                }
                $si->forceDelete();
            }
            $indikator->forceDelete();
        } elseif ($type === 'sub_komponen') {
            $subKomponen = SubKomponen::onlyTrashed()->where('id', $id)->firstOrFail();
            $docs = DokumenBukti::onlyTrashed()->where('sub_komponen_id', $id)->get();
            foreach ($docs as $doc) {
                if ($doc->path_file && Storage::disk('public')->exists($doc->path_file)) {
                    Storage::disk('public')->delete($doc->path_file);
                }
                $doc->forceDelete();
            }
            $subKomponen->forceDelete();
        }

        return back()->with('success', 'Data berhasil dihapus permanen!');
    }
}
