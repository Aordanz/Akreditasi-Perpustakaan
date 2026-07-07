<?php

namespace App\Http\Controllers;

use App\Models\Komponen;
use App\Models\DokumenBukti;
use Illuminate\Http\Request;

class AkreditasiController extends Controller
{
    public function index()
    {
        // Fetch all komponen with their related data
        $komponens = Komponen::with(['subKomponens.indikators.subIndikators', 'subKomponens.dokumenBuktis'])->get();
        return view('akreditasi', compact('komponens'));
    }

    public function upload(Request $request, $subKomponenId)
    {
        $request->validate([
            'dokumen' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $file = $request->file('dokumen');
        $nama_file = $file->getClientOriginalName();
        $path_file = $file->store('dokumen_bukti', 'public');

        DokumenBukti::create([
            'sub_komponen_id' => $subKomponenId,
            'nama_file' => $nama_file,
            'path_file' => $path_file,
            'tanggal_upload' => now(),
        ]);

        return back()->with('success', 'Dokumen berhasil diunggah!');
    }
}
