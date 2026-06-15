<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ReportSignature extends Model
{
    protected $fillable = [
        'name',
        'image_data',
        'pin_hash',
    ];

    protected $hidden = [
        'pin_hash',
    ];

    public function reports()
    {
        return $this->hasMany(TestReport::class);
    }
}
