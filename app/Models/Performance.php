<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Performance extends Model
{
    use HasFactory;
    protected $table = 'performances';
    protected $fillable = [
        'performance_appraisal_id',
        'job_knowledge',
        'quality_of_work',
        
        'quantity_of_work',
        
        'stability',
       
        'communication',
       
        'diplomacy',
      
        'judgement',
     
        'salesmanship',
       
        'customer_relations',
       
        'supervisory_skills',
       
    ];
    public function performanceAppraisal(): BelongsTo
    {
        return $this->belongsTo(PerformanceAppraisal::class);
    }
}
