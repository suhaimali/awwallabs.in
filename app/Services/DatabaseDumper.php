<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DatabaseDumper
{
    public static function dump(string $path)
    {
        $tables = DB::select('SHOW TABLES');
        $dbName = env('DB_DATABASE', 'awwal_lab');
        $property = 'Tables_in_' . $dbName;

        $sql = "-- Database Backup generated securely via pure PHP\n";
        $sql .= "-- Generation Time: " . date('Y-m-d H:i:s') . "\n\n";

        $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

        foreach ($tables as $table) {
            // Some environments use different property names depending on DB case sensitivity
            // Let's dynamically find the property that contains the table name
            $tableName = null;
            foreach ($table as $key => $value) {
                if (str_starts_with($key, 'Tables_in_')) {
                    $tableName = $value;
                    break;
                }
            }
            if (!$tableName) {
                $tableName = array_values((array)$table)[0];
            }

            // Get Create Table syntax
            $createStmt = DB::select("SHOW CREATE TABLE `{$tableName}`");
            $createTableProperty = 'Create Table';
            $sql .= "-- Table structure for {$tableName} --\n";
            $sql .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
            $sql .= $createStmt[0]->$createTableProperty . ";\n\n";

            // Get Data
            $rows = DB::table($tableName)->get();
            if ($rows->count() > 0) {
                $sql .= "-- Data for {$tableName} --\n";
                foreach ($rows as $row) {
                    $rowArray = (array)$row;
                    $columns = array_keys($rowArray);
                    $values = array_values($rowArray);
                    
                    $escapedValues = array_map(function ($val) {
                        if (is_null($val)) return 'NULL';
                        // Very basic escaping for SQL
                        $val = addslashes($val);
                        // Convert newlines
                        $val = str_replace(["\r\n", "\r", "\n"], ["\\r\\n", "\\r", "\\n"], $val);
                        return "'" . $val . "'";
                    }, $values);

                    $sql .= "INSERT INTO `{$tableName}` (`" . implode("`, `", $columns) . "`) VALUES (" . implode(", ", $escapedValues) . ");\n";
                }
                $sql .= "\n";
            }
        }

        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

        // Ensure the directory exists before saving
        $directory = dirname($path);
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        File::put($path, $sql);
    }

    public static function restore(string $path)
    {
        // Disable foreign key checks for restore
        DB::unprepared("SET FOREIGN_KEY_CHECKS=0;");
        
        $sql = '';
        $handle = fopen($path, 'r');
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                // Skip empty lines and comments
                $trimmed = trim($line);
                if ($trimmed === '' || str_starts_with($trimmed, '--')) {
                    continue;
                }
                
                $sql .= $line;
                
                // If the line ends with a semicolon, it's the end of a statement
                if (str_ends_with(rtrim($line), ';')) {
                    DB::unprepared($sql);
                    $sql = '';
                }
            }
            fclose($handle);
        }

        // Execute any remaining statements
        if (trim($sql) !== '') {
            DB::unprepared($sql);
        }

        DB::unprepared("SET FOREIGN_KEY_CHECKS=1;");
    }
}
