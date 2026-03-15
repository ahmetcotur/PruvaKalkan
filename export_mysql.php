<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

// Ensure we read from SQLite
config([
    'database.default' => 'sqlite',
    'database.connections.sqlite.database' => database_path('database.sqlite')
]);

$tables = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");

$sql = "SET FOREIGN_KEY_CHECKS=0;\n\n";

foreach ($tables as $table) {
    $tableName = $table->name;
    
    // Skip migrations table
    if ($tableName === 'migrations') continue;

    $rows = DB::table($tableName)->get();
    
    if ($rows->count() > 0) {
        // Option to empty table before insert
        $sql .= "TRUNCATE TABLE `$tableName`;\n";

        foreach ($rows as $row) {
            $rowArr = (array) $row;
            $keys = array_keys($rowArr);
            $values = array_values($rowArr);
            
            $keysStr = implode('`, `', $keys);
            
            $valuesStr = implode(', ', array_map(function($val) {
                if (is_null($val)) return 'NULL';
                // Very simple MySQL escape
                $val = str_replace(['\\', "\0", "\n", "\r", "'", '"', "\x1a"], ['\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'], $val);
                return "'" . $val . "'";
            }, $values));
            
            $sql .= "INSERT INTO `$tableName` (`$keysStr`) VALUES ($valuesStr);\n";
        }
        $sql .= "\n";
    }
}

$sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

file_put_contents(__DIR__.'/database_dump.sql', $sql);
echo "Dump has been successfully created at /database_dump.sql!\n";
