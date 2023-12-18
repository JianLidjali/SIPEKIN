<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $table = 'promotions';
    protected $fillable = [
        'performance_appraisal_id',
        'new_position',
        'level',
        'present_salary',
        'proposed_salary',
        'date_of_promotion',
        'additional_comments',

    ];
    public function performanceAppraisal()
    {
        return $this->belongsTo(PerformanceAppraisal::class, 'performance_appraisal_id');
    }
}
