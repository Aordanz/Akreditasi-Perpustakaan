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
        \DB::beginTransaction();
        
        $jsonPath = database_path('seeders/hierarchy.json');
        if (!File::exists($jsonPath)) {
            $this->command->error("JSON file not found at: {$jsonPath}");
            \DB::rollBack();
            return;
        }

        $jsonData = json_decode(File::get($jsonPath), true);
        if (!$jsonData) {
            $this->command->error("Invalid JSON data");
            \DB::rollBack();
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
            $komponen = Komponen::where('nomor', (string)$compData['nomor'])->first();
            $compName = $toTitleCase($compData['nama']);
            if (!$komponen) {
                // Create if it doesn't exist
                $komponen = Komponen::create([
                    'nomor' => (string)$compData['nomor'],
                    'nama_komponen' => $compName
                ]);
            } else {
                // Update name to match spreadsheet in Title Case
                $komponen->update(['nama_komponen' => $compName]);
            }

            foreach ($compData['sub_komponens'] as $subData) {
                $nomorSub = trim((string)$subData['nomor_sub']);
                $sub = SubKomponen::where('nomor_sub', $nomorSub)
                                  ->where('komponen_id', $komponen->id)
                                  ->first();
                if (!$sub) {
                    $sub = SubKomponen::create([
                        'komponen_id' => $komponen->id,
                        'nomor_sub' => $nomorSub,
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
            $this->command->info("Finished looping sub komponen for: " . $compData['nomor'] . " - Total indicators so far: " . Indikator::count());
        }

        $this->command->info("Seeded components, subcomponents, indicators, and sub-indicators.");

        // Migrate existing documents based on filename prefixes and folder paths
        $documents = DokumenBukti::all();
        $migratedCount = 0;

        $allSubIndikators = SubIndikator::with('indikator')->get();
        $allIndikators = Indikator::all();
        $allSubKomponens = SubKomponen::all();

        foreach ($documents as $doc) {
            $path = $doc->path_file;
            $name = $doc->nama_file;
            $matched = false;

            // 1. Try matching SubIndikator code in path or filename
            foreach ($allSubIndikators as $subInd) {
                $code = $subInd->nomor_sub_indikator;
                if (str_contains($path, $code) || str_contains($name, $code)) {
                    $doc->sub_indikator_id = $subInd->id;
                    $doc->indikator_id = $subInd->indikator_id;
                    if ($subInd->indikator) {
                        $doc->sub_komponen_id = $subInd->indikator->sub_komponen_id;
                    }
                    $doc->save();
                    $matched = true;
                    $migratedCount++;
                    break;
                }
            }

            // 2. Try matching Indikator code in path or filename
            if (!$matched) {
                foreach ($allIndikators as $ind) {
                    $code = $ind->nomor_indikator;
                    if (str_contains($path, $code) || str_contains($name, $code)) {
                        $doc->indikator_id = $ind->id;
                        $doc->sub_komponen_id = $ind->sub_komponen_id;
                        $doc->save();
                        $matched = true;
                        $migratedCount++;
                        break;
                    }
                }
            }

            // 3. Fallback: match SubKomponen code in path or filename
            if (!$matched) {
                foreach ($allSubKomponens as $sub) {
                    $code = $sub->nomor_sub;
                    if (str_contains($path, '/' . $code . ' ') || str_contains($path, '/' . $code . '/') || str_starts_with($name, $code)) {
                        $doc->sub_komponen_id = $sub->id;
                        $doc->save();
                        $matched = true;
                        $migratedCount++;
                        break;
                    }
                }
            }

            if (!$matched) {
                $this->command->warn("Could not auto-migrate document: {$name}");
            }
        }

        $this->command->info("Successfully migrated {$migratedCount} out of {$documents->count()} documents.");
        
        \DB::commit();
    }
}
