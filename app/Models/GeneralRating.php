<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralRating extends Model
{
    use HasFactory;
    protected $table = 'generalRatings';
    protected $fillable = [
        'performance_appraisal_id',
        'strengths',
        'weakness',
        'suggestions',
        'promotability',
        'promotable_now_position',
        'promotable_now_successor',
        'promotable_1_2_years_position',
        'promotable_1_2_years_successor',
        'capability_limited_to_current_position'
    ];
    public function performanceAppraisal()
    {
        return $this->belongsTo(PerformanceAppraisal::class);
    }
}
