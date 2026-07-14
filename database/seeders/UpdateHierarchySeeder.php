<?php

namespace Database\Seeders;

use App\Models\Komponen;
use App\Models\SubKomponen;
use App\Models\Indikator;
use App\Models\SubIndikator;
use App\Models\DokumenBukti;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class UpdateHierarchySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('seeders/hierarchy.json');
        if (!File::exists($jsonPath)) {
            $this->command->error("JSON file not found at: {$jsonPath}");
            return;
        }

        $jsonData = json_decode(File::get($jsonPath), true);
        if (!$jsonData) {
            $this->command->error("Invalid JSON data");
            return;
        }

        // Disable foreign key checks to safely clear tables
        \Schema::disableForeignKeyConstraints();
        SubIndikator::truncate();
        Indikator::truncate();
        \Schema::enableForeignKeyConstraints();

        $this->command->info("Truncated indikator and sub_indikator tables.");

        $toTitleCase = function($str) {
            $title = ucwords(strtolower($str));
            $replacements = [
                ' Dan ' => ' dan ',
                ' Atau ' => ' atau ',
                ' Ke ' => ' ke ',
                ' Dari ' => ' dari ',
                ' Di ' => ' di ',
                ' Pada ' => ' pada ',
                ' Yang ' => ' yang ',
                ' Terhadap ' => ' terhadap ',
                ' Untuk ' => ' untuk ',
                ' Dalam ' => ' dalam '
            ];
            return str_replace(array_keys($replacements), array_values($replacements), $title);
        };

        // Loop through components to populate
        foreach ($jsonData as $compData) {
            $komponen = Komponen::where('nomor', $compData['nomor'])->first();
            $compName = $toTitleCase($compData['nama']);
            if (!$komponen) {
                // Create if it doesn't exist
                $komponen = Komponen::create([
                    'nomor' => $compData['nomor'],
                    'nama_komponen' => $compName
                ]);
            } else {
                // Update name to match spreadsheet in Title Case
                $komponen->update(['nama_komponen' => $compName]);
            }

            foreach ($compData['sub_komponens'] as $subData) {
                $sub = SubKomponen::where('nomor_sub', $subData['nomor_sub'])
                                  ->where('komponen_id', $komponen->id)
                                  ->first();
                if (!$sub) {
                    $sub = SubKomponen::create([
                        'komponen_id' => $komponen->id,
                        'nomor_sub' => $subData['nomor_sub'],
                        'nama_sub_komponen' => $subData['nama_sub']
                    ]);
                } else {
                    $sub->update(['nama_sub_komponen' => $subData['nama_sub']]);
                }

                foreach ($subData['indikators'] as $indData) {
                    $indikator = Indikator::create([
                        'sub_komponen_id' => $sub->id,
                        'nomor_indikator' => $indData['nomor_indikator'],
                        'nama_indikator' => $indData['nama_indikator']
                    ]);

                    foreach ($indData['sub_indikators'] as $subIndData) {
                        SubIndikator::create([
                            'indikator_id' => $indikator->id,
                            'nomor_sub_indikator' => $subIndData['nomor_sub_indikator'],
                            'nama_sub_indikator' => $subIndData['nama_sub_indikator']
                        ]);
                    }
                }
            }
        }

        $this->command->info("Seeded components, subcomponents, indicators, and sub-indicators.");

        // Migrate existing documents based on filename prefixes
        $documents = DokumenBukti::all();
        $migratedCount = 0;

        // Fetch all indicators and sub-indicators for local lookup
        $allSubIndikators = SubIndikator::all();
        $allIndikators = Indikator::all();

        foreach ($documents as $doc) {
            $filename = $doc->nama_file;
            $matched = false;

            // 1. Try to match SubIndikator first
            foreach ($allSubIndikators as $subInd) {
                // Match prefix (e.g. "1.1.1-1" prefix in "1.1.1-1 Dokumen...")
                if (str_starts_with($filename, $subInd->nomor_sub_indikator)) {
                    $doc->sub_indikator_id = $subInd->id;
                    $doc->indikator_id = $subInd->indikator_id;
                    
                    // Also make sure sub_komponen_id is correct
                    $parentIndikator = $allIndikators->firstWhere('id', $subInd->indikator_id);
                    if ($parentIndikator) {
                        $doc->sub_komponen_id = $parentIndikator->sub_komponen_id;
                    }
                    
                    $doc->save();
                    $matched = true;
                    $migratedCount++;
                    break;
                }
            }

            // 2. If no SubIndikator matches, try to match Indikator
            if (!$matched) {
                foreach ($allIndikators as $ind) {
                    if (str_starts_with($filename, $ind->nomor_indikator)) {
                        $doc->indikator_id = $ind->id;
                        $doc->sub_komponen_id = $ind->sub_komponen_id;
                        $doc->save();
                        $matched = true;
                        $migratedCount++;
                        break;
                    }
                }
            }

            if (!$matched) {
                $this->command->warn("Could not auto-migrate document: {$filename}");
            }
        }

        $this->command->info("Successfully migrated {$migratedCount} out of {$documents->count()} documents.");
    }
}
