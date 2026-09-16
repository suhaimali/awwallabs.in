<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Exception;

class DatabaseDumper
{
    /**
     * Dump database tables and data into a SQL backup file.
     */
    public static function dump(string $path)
    {
        $pdo = DB::getPdo();
        $tables = DB::select('SHOW TABLES');

        // Ensure target directory exists
        $directory = dirname($path);
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $handle = fopen($path, 'w');
        if (!$handle) {
            throw new Exception("Unable to open backup file for writing: {$path}");
        }

        fwrite($handle, "-- Database Backup generated securely via pure PHP DatabaseDumper\n");
        fwrite($handle, "-- Generation Time: " . date('Y-m-d H:i:s') . "\n\n");
        fwrite($handle, "SET NAMES utf8mb4;\n");
        fwrite($handle, "SET FOREIGN_KEY_CHECKS=0;\n\n");

        foreach ($tables as $table) {
            // Dynamically determine table name from object
            $tableName = null;
            foreach ((array)$table as $key => $value) {
                if (str_starts_with($key, 'Tables_in_') || $key === 'table_name') {
                    $tableName = $value;
                    break;
                }
            }
            if (!$tableName) {
                $tableName = array_values((array)$table)[0];
            }

            // Get Create Table syntax
            $createStmt = DB::select("SHOW CREATE TABLE `{$tableName}`");
            if (empty($createStmt)) {
                continue;
            }

            $createTableSql = null;
            foreach ((array)$createStmt[0] as $k => $v) {
                if (stripos($k, 'Create Table') !== false || stripos($k, 'Create View') !== false) {
                    $createTableSql = $v;
                    break;
                }
            }
            if (!$createTableSql) {
                $createTableSql = array_values((array)$createStmt[0])[1] ?? null;
            }

            if ($createTableSql) {
                fwrite($handle, "-- Table structure for `{$tableName}` --\n");
                fwrite($handle, "DROP TABLE IF EXISTS `{$tableName}`;\n");
                fwrite($handle, $createTableSql . ";\n\n");
            }

            // Dump Table Data in manageable chunks
            $count = DB::table($tableName)->count();
            if ($count > 0) {
                fwrite($handle, "-- Data for `{$tableName}` --\n");

                foreach (DB::table($tableName)->cursor() as $row) {
                    $rowArray = (array)$row;
                    $columns = array_keys($rowArray);
                    $escapedValues = [];

                    foreach ($rowArray as $val) {
                        if (is_null($val)) {
                            $escapedValues[] = 'NULL';
                        } elseif (is_int($val) || is_float($val)) {
                            $escapedValues[] = $val;
                        } else {
                            $escapedValues[] = $pdo->quote((string)$val);
                        }
                    }

                    $colSql = '`' . implode('`, `', $columns) . '`';
                    $valSql = implode(', ', $escapedValues);
                    fwrite($handle, "INSERT INTO `{$tableName}` ({$colSql}) VALUES ({$valSql});\n");
                }

                fwrite($handle, "\n");
            }
        }

        fwrite($handle, "SET FOREIGN_KEY_CHECKS=1;\n");
        fclose($handle);
    }

    /**
     * Restore database from a SQL backup file safely.
     */
    public static function restore(string $path)
    {
        if (!File::exists($path)) {
            throw new Exception("Backup file does not exist: {$path}");
        }

        $handle = fopen($path, 'r');
        if (!$handle) {
            throw new Exception("Unable to open backup file for reading: {$path}");
        }

        DB::unprepared("SET FOREIGN_KEY_CHECKS=0;");

        $sql = '';
        $inSingleQuote = false;
        $inDoubleQuote = false;
        $isEscaped = false;

        try {
            while (($line = fgets($handle)) !== false) {
                // Check for comment line when not in middle of quotes
                $trimmed = trim($line);
                if (!$inSingleQuote && !$inDoubleQuote && ($trimmed === '' || str_starts_with($trimmed, '--') || str_starts_with($trimmed, '/*'))) {
                    continue;
                }

                $len = strlen($line);
                for ($i = 0; $i < $len; $i++) {
                    $char = $line[$i];

                    if ($isEscaped) {
                        $isEscaped = false;
                        continue;
                    }

                    if ($char === '\\') {
                        $isEscaped = true;
                        continue;
                    }

                    if ($char === "'" && !$inDoubleQuote) {
                        $inSingleQuote = !$inSingleQuote;
                    } elseif ($char === '"' && !$inSingleQuote) {
                        $inDoubleQuote = !$inDoubleQuote;
                    } elseif ($char === ';' && !$inSingleQuote && !$inDoubleQuote) {
                        // Complete statement identified
                        $sql .= substr($line, 0, $i + 1);
                        $stmt = trim($sql);
                        if (!empty($stmt)) {
                            DB::unprepared($stmt);
                        }
                        $sql = '';
                        $line = substr($line, $i + 1);
                        $len = strlen($line);
                        $i = -1; // Reset loop for remaining portion of line
                    }
                }

                $sql .= $line;
            }

            $remaining = trim($sql);
            if (!empty($remaining)) {
                DB::unprepared($remaining);
            }
        } finally {
            fclose($handle);
            DB::unprepared("SET FOREIGN_KEY_CHECKS=1;");
        }
    }
}
