<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverallRating extends Model
{
    use HasFactory;
    protected $table = 'overallRatings';
    protected $fillable = [
        'performance_appraisal_id',
        'overall_rating',
    ];
    public function performanceAppraisal()
    {
        return $this->belongsTo(PerformanceAppraisal::class);
    }
}
