<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportTemplate extends Model
{
    protected $fillable = ['name', 'description'];

    public function items()
    {
        return $this->hasMany(ReportTemplateItem::class, 'report_template_id')->orderBy('sort_order');
    }
}
