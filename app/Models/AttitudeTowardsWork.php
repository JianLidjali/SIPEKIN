<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttitudeTowardsWork extends Model
{
    use HasFactory;
    protected $table = 'AttitudeTowardsWorks';
    protected $fillable = [
        'performance_appraisal_id',
        'attitude_to_supervisor',
        'attitude_to_colleagues',
        'initiative',
        'attendance',
        'punctuality'
    ];
    public function performanceAppraisal()
    {
        return $this->belongsTo(PerformanceAppraisal::class);
    }
}
