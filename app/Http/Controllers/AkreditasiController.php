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
    public function index()
    {
        // Fetch all komponen with their related data
        $komponens = Komponen::with([
            'subKomponens.indikators.subIndikators.dokumenBuktis',
            'subKomponens.indikators.dokumenBuktis',
            'subKomponens.dokumenBuktis'
        ])->get();
        return view('welcome', compact('komponens'));
    }

    public function adminDashboard()
    {
        $komponens = Komponen::with([
            'subKomponens.indikators.subIndikators.dokumenBuktis',
            'subKomponens.indikators.dokumenBuktis',
            'subKomponens.dokumenBuktis'
        ])->get();
        return view('admin.dashboard', compact('komponens'));
    }

    public function exportReport()
    {
        $komponens = Komponen::with([
            'subKomponens.indikators.subIndikators.dokumenBuktis',
            'subKomponens.indikators.dokumenBuktis',
            'subKomponens.dokumenBuktis'
        ])->get();
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
            $nama_file = $request->nama_video ?: 'Video YouTube';
        } elseif ($isDrive) {
            $request->validate([
                'drive_link' => 'required|url',
                'nama_drive' => 'nullable|string|max:255',
            ]);
            $path_file = $request->drive_link;
            $nama_file = $request->nama_drive ?: 'Dokumen Drive';
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
