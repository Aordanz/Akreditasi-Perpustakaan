<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    $count = DB::table('sessions')->count();
    echo "Total sessions in DB: $count\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
