<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncDokumen extends Command
{
    protected $signature = 'akreditasi:sync-dokumen';

    protected $description = 'Sync uploaded documents from storage to database';

    public function handle()
    {
        $basePath = storage_path('app/public/dokumen_bukti');
        if (!file_exists($basePath)) {
            $this->error("Folder tidak ditemukan: $basePath");
            return;
        }

        $folders = glob($basePath . '/*', GLOB_ONLYDIR);
        $count = 0;

        foreach ($folders as $komponenFolder) {
            $subFolders = glob($komponenFolder . '/*', GLOB_ONLYDIR);
            foreach ($subFolders as $subFolder) {
                $subFolderName = basename($subFolder);
                preg_match('/^([0-9\.]+)/', $subFolderName, $matches);
                if (isset($matches[1])) {
                    $nomor_sub = rtrim($matches[1], '.');
                    
                    $subKomponen = \App\Models\SubKomponen::where('nomor_sub', $nomor_sub)->first();
                    if ($subKomponen) {
                        $files = glob($subFolder . '/*.*');
                        foreach ($files as $file) {
                            $nama_file = basename($file);
                            $kompName = basename($komponenFolder);
                            $subName = basename($subFolder);
                            $path_file = "dokumen_bukti/{$kompName}/{$subName}/{$nama_file}";
                            
                            $exists = \App\Models\DokumenBukti::where('sub_komponen_id', $subKomponen->id)
                                        ->where('nama_file', $nama_file)
                                        ->exists();
                            
                            if (!$exists) {
                                \App\Models\DokumenBukti::create([
                                    'sub_komponen_id' => $subKomponen->id,
                                    'nama_file' => $nama_file,
                                    'path_file' => $path_file,
                                    'tanggal_upload' => now(),
                                ]);
                                $count++;
                                $this->info("Menambahkan: $nama_file");
                            }
                        }
                    }
                }
            }
        }
        $this->info("Berhasil sinkronisasi $count file baru!");
    }
}
