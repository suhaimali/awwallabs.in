<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ReportSignature extends Model
{
    protected $fillable = [
        'name',
        'image_data',
        'image_path',
        'pin_hash',
    ];

    protected $hidden = [
        'pin_hash',
    ];

    public function getImageDataAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }
        return $this->attributes['image_path'] ?? null;
    }

    public function reports()
    {
        return $this->hasMany(TestReport::class);
    }
}
