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
        
        // Delete the physical file if it exists
        if ($dokumen->path_file && Storage::disk('public')->exists($dokumen->path_file)) {
            Storage::disk('public')->delete($dokumen->path_file);
        }
        
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
}
