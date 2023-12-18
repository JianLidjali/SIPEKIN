<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;
    protected $table = 'certifications';
    protected $fillable = [
        'performance_appraisal_id',
        'staff_suggestion',
    ];
    public function performanceAppraisal()
    {
        return $this->belongsTo(PerformanceAppraisal::class);
    }
}
