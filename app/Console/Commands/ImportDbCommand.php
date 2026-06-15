<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportDbCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:import {file : The path to the SQL file to import}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Safely imports a SQL file into the database, stripping out UTF-8 BOM to prevent PDO panics.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = $this->argument('file');

        if (!File::exists($file)) {
            $this->error("The file '{$file}' does not exist.");
            return Command::FAILURE;
        }

        $this->info("Reading SQL file: {$file}");
        $content = File::get($file);

        // Strip UTF-8 BOM if present (prevents PDOException syntax errors)
        $bom = pack('H*','EFBBBF');
        $content = preg_replace("/^$bom/", '', $content);

        $this->info("Importing into the database...");
        
        try {
            DB::unprepared($content);
            $this->info("Database imported successfully.");
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Failed to import database: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
