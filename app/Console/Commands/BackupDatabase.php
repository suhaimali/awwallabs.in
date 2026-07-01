<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a secure daily backup of the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $disk = Storage::disk('local');
            if (!$disk->exists('backups')) {
                $disk->makeDirectory('backups');
            }

            $filename = 'backup-' . date('Y-m-d-H-i-s') . '.sql';
            $path = $disk->path('backups/' . $filename);

            // Use the pure PHP Database Dumper to avoid mysqldump path issues
            \App\Services\DatabaseDumper::dump($path);

            // Row Limit System: Keep only the latest 10 backups to save space
            $files = $disk->files('backups');
            $sqlFiles = array_filter($files, fn($f) => pathinfo($f, PATHINFO_EXTENSION) === 'sql');
            
            usort($sqlFiles, function($a, $b) use ($disk) {
                return $disk->lastModified($b) - $disk->lastModified($a); // Newest first
            });
            
            $limit = 10;
            if (count($sqlFiles) > $limit) {
                $filesToDelete = array_slice($sqlFiles, $limit);
                foreach ($filesToDelete as $oldFile) {
                    $disk->delete($oldFile);
                    $this->info("Deleted old backup: {$oldFile}");
                }
            }

            $this->info("Database backup created successfully: {$filename}");
            Log::info("Database backup created successfully: {$filename}");

            return Command::SUCCESS;
        } catch (\Exception $e) {
            Log::error('Backup exception: ' . $e->getMessage());
            $this->error('Backup exception: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
