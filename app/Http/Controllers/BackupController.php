<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Exception;

class BackupController extends Controller
{
    /**
     * Display a listing of the backups.
     */
    public function index()
    {
        $disk = Storage::disk('local');
        $files = $disk->files('backups');
        $backups = [];

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'sql') {
                $backups[] = [
                    'name' => basename($file),
                    'size' => $this->formatSizeUnits($disk->size($file)),
                    'date' => date('Y-m-d H:i:s', $disk->lastModified($file)),
                    'path' => $file
                ];
            }
        }

        // Sort backups by date descending
        usort($backups, function ($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        return view('backups', compact('backups'));
    }

    /**
     * Create a new backup.
     */
    public function create()
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
                }
            }

            return response()->json(['success' => true, 'message' => 'Backup created successfully!']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Restore the specified backup.
     */
    public function restore($file)
    {
        try {
            $path = 'backups/' . $file;
            $disk = Storage::disk('local');

            if (!$disk->exists($path)) {
                return response()->json(['success' => false, 'message' => 'Backup file not found.']);
            }

            $fullPath = $disk->path($path);
            \App\Services\DatabaseDumper::restore($fullPath);

            return response()->json(['success' => true, 'message' => 'System restored successfully!']);
        } catch (Exception $e) {
            $msg = $e->getMessage();
            if (strpos($msg, '(Connection:') !== false) {
                $msg = substr($msg, 0, strpos($msg, '(Connection:'));
            } elseif (strpos($msg, '(SQL:') !== false) {
                $msg = substr($msg, 0, strpos($msg, '(SQL:'));
            }
            return response()->json(['success' => false, 'message' => 'Restore failed: ' . trim($msg)]);
        }
    }

    /**
     * Upload and restore a backup file.
     */
    public function uploadRestore(Request $request)
    {
        if (!$request->hasFile('backup_file')) {
            return response()->json(['success' => false, 'message' => 'No file uploaded.']);
        }

        $file = $request->file('backup_file');
        
        if ($file->getClientOriginalExtension() !== 'sql') {
            return response()->json(['success' => false, 'message' => 'Only .sql files are allowed.']);
        }

        try {
            $filename = 'uploaded-backup-' . time() . '.sql';
            $disk = Storage::disk('local');
            
            if (!$disk->exists('backups')) {
                $disk->makeDirectory('backups');
            }
            
            $path = $file->storeAs('backups', $filename, 'local');
            
            $fullPath = $disk->path($path);
            \App\Services\DatabaseDumper::restore($fullPath);
            
            return response()->json(['success' => true, 'message' => 'System restored successfully from uploaded file!']);
        } catch (Exception $e) {
            $msg = $e->getMessage();
            if (strpos($msg, '(Connection:') !== false) {
                $msg = substr($msg, 0, strpos($msg, '(Connection:'));
            } elseif (strpos($msg, '(SQL:') !== false) {
                $msg = substr($msg, 0, strpos($msg, '(SQL:'));
            }
            return response()->json(['success' => false, 'message' => 'Restore failed: ' . trim($msg)]);
        }
    }

    /**
     * Download the specified backup.
     */
    public function download($file)
    {
        $path = 'backups/' . $file;
        $disk = Storage::disk('local');

        if ($disk->exists($path)) {
            return response()->download($disk->path($path));
        }

        return redirect()->back()->with('error', 'Backup file not found.');
    }

    /**
     * Remove the specified backup from storage.
     */
    public function destroy($file)
    {
        $path = 'backups/' . $file;
        $disk = Storage::disk('local');

        if ($disk->exists($path)) {
            $disk->delete($path);
            return response()->json(['success' => true, 'message' => 'Backup deleted successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Backup file not found.']);
    }

    private function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }
        return $bytes;
    }
}
