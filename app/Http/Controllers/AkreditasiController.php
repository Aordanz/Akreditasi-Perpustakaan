<?php

namespace App\Http\Controllers;

use App\Models\Komponen;
use App\Models\SubKomponen;
use App\Models\DokumenBukti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AkreditasiController extends Controller
{
    public function index()
    {
        // Fetch all komponen with their related data
        $komponens = Komponen::with(['subKomponens.indikators.subIndikators', 'subKomponens.dokumenBuktis'])->get();
        return view('akreditasi', compact('komponens'));
    }

    public function adminDashboard()
    {
        $komponens = Komponen::with(['subKomponens.dokumenBuktis'])->get();
        return view('admin.dashboard', compact('komponens'));
    }

    public function upload(Request $request, $subKomponenId)
    {
        $request->validate([
            'dokumen' => 'required|file|extensions:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
        ]);

        $file = $request->file('dokumen');
        $nama_file = $file->getClientOriginalName();
        
        // Dapatkan data SubKomponen dan Komponen untuk membuat struktur folder
        $subKomponen = SubKomponen::with('komponen')->findOrFail($subKomponenId);
        
        $folder_komponen = $subKomponen->komponen->nomor . '. ' . $subKomponen->komponen->nama_komponen;
        $folder_sub = $subKomponen->nomor_sub . ' ' . $subKomponen->nama_sub_komponen;
        
        // Membersihkan karakter yang tidak valid untuk folder (opsional, tapi disarankan)
        $folder_komponen = str_replace(['/', '\\', ':', '*', '?', '"', '<', '>', '|'], '-', $folder_komponen);
        $folder_sub = str_replace(['/', '\\', ':', '*', '?', '"', '<', '>', '|'], '-', $folder_sub);
        
        // Path dinamis: dokumen_bukti/1. Komponen.../1.1 Sub...
        $dynamic_path = "dokumen_bukti/{$folder_komponen}/{$folder_sub}";
        
        $path_file = $file->store($dynamic_path, 'public');

        DokumenBukti::create([
            'sub_komponen_id' => $subKomponenId,
            'nama_file' => $nama_file,
            'path_file' => $path_file,
            'tanggal_upload' => now(),
        ]);

        return back()->with('success', 'Dokumen berhasil diunggah!');
    }

    public function viewDocument($id)
    {
        $dokumen = DokumenBukti::findOrFail($id);
        return view('viewer', compact('dokumen'));
    }
}
