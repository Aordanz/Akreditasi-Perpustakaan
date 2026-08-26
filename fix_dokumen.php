<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\DokumenBukti;
use App\Models\SubIndikator;
use App\Models\Indikator;
use App\Models\SubKomponen;

$dokumens = DokumenBukti::all();
$updated = 0;

foreach ($dokumens as $dok) {
    if (!$dok->kode_dokumen) continue;
    
    $code = $dok->kode_dokumen;
    
    // Check if it's a sub_indikator (has a dash)
    if (strpos($code, '-') !== false) {
        $sub = SubIndikator::withTrashed()->where('nomor_sub_indikator', $code)->first();
        if ($sub) {
            $dok->sub_indikator_id = $sub->id;
            $dok->indikator_id = $sub->indikator_id;
            $indikator = Indikator::withTrashed()->find($sub->indikator_id);
            if ($indikator) {
                $dok->sub_komponen_id = $indikator->sub_komponen_id;
            }
            $dok->save();
            $updated++;
        }
    } 
    // Check if it's an indikator (e.g. 1.5.8)
    else if (substr_count($code, '.') === 2) {
        $ind = Indikator::withTrashed()->where('nomor_indikator', $code)->first();
        if ($ind) {
            $dok->sub_indikator_id = null;
            $dok->indikator_id = $ind->id;
            $dok->sub_komponen_id = $ind->sub_komponen_id;
            $dok->save();
            $updated++;
        }
    }
    // Check if it's a sub_komponen (e.g. 1.5)
    else if (substr_count($code, '.') === 1) {
        $subKomp = SubKomponen::withTrashed()->where('nomor_sub', $code)->first();
        if ($subKomp) {
            $dok->sub_indikator_id = null;
            $dok->indikator_id = null;
            $dok->sub_komponen_id = $subKomp->id;
            $dok->save();
            $updated++;
        }
    }
}
echo "Updated $updated dokumen.\n";
