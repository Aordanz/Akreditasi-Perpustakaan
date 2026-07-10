<?php
use App\Models\SubKomponen;
use App\Models\DokumenBukti;

$basePath = storage_path('app/public/dokumen_bukti');
$folders = glob($basePath . '/*', GLOB_ONLYDIR);
$count = 0;

foreach ($folders as $komponenFolder) {
    $subFolders = glob($komponenFolder . '/*', GLOB_ONLYDIR);
    foreach ($subFolders as $subFolder) {
        $subFolderName = basename($subFolder);
        // E.g., "1.1 Tata Kelola Koleksi"
        preg_match('/^([0-9\.]+)/', $subFolderName, $matches);
        if (isset($matches[1])) {
            $nomor_sub = rtrim($matches[1], '.');
            
            $subKomponen = SubKomponen::where('nomor_sub', $nomor_sub)->first();
            if ($subKomponen) {
                $files = glob($subFolder . '/*.*');
                foreach ($files as $file) {
                    $nama_file = basename($file);
                    
                    $kompName = basename($komponenFolder);
                    $subName = basename($subFolder);
                    $path_file = "dokumen_bukti/{$kompName}/{$subName}/{$nama_file}";
                    
                    $exists = DokumenBukti::where('sub_komponen_id', $subKomponen->id)
                                ->where('nama_file', $nama_file)
                                ->exists();
                    
                    if (!$exists) {
                        DokumenBukti::create([
                            'sub_komponen_id' => $subKomponen->id,
                            'nama_file' => $nama_file,
                            'path_file' => $path_file,
                            'tanggal_upload' => now(),
                        ]);
                        $count++;
                    }
                }
            }
        }
    }
}
echo "Berhasil sinkronisasi $count file baru!\n";
