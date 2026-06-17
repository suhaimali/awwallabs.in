<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportTemplateItem extends Model
{
    protected $fillable = [
        'report_template_id',
        'lab_test_id',
        'category',
        'subcategory',
        'name',
        'unit',
        'normal_value',
        'biological_reference',
        'sort_order'
    ];

    public function template()
    {
        return $this->belongsTo(ReportTemplate::class, 'report_template_id');
    }

    public function labTest()
    {
        return $this->belongsTo(LabTest::class, 'lab_test_id');
    }
}
