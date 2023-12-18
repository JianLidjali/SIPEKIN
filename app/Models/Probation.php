<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Probation extends Model
{
    use HasFactory;
    protected $table = 'probations';
    protected $fillable = [
        'performance_appraisal_id',
        'confirm_date',
        'extension_from',
        'extension_reason',
        'termination_date',
        'termination_reason',
    ];

    public function performanceAppraisal()
    {
        return $this->belongsTo(PerformanceAppraisal::class);
    }
}
