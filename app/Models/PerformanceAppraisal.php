<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Ramsey\Uuid\Uuid;

class PerformanceAppraisal extends Model
{
    use HasFactory;
    protected $table = 'performance_appraisals';
    protected $fillable = [
        'employee_uuid',
        'employee_id',
        'date',
        'type',
        'status',
    ];


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::uuid4();
        });
    }
    public function performance(): HasOne
    {
        return $this->hasOne(Performance::class);
    }

    public function attitudeTowardsWork(): HasOne
    {
        return $this->hasOne(AttitudeTowardsWork::class);
    }

    public function overallRating(): HasOne
    {
        return $this->hasOne(OverallRating::class);
    }

    public function generalRating(): HasOne
    {
        return $this->hasOne(GeneralRating::class);
    }

    public function certification(): HasOne
    {
        return $this->hasOne(Certification::class);
    }

    public function probation(): HasOne
    {
        return $this->hasOne(Probation::class);
    }

    public function promotion(): HasOne
    {
        return $this->hasOne(Promotion::class);
    }
    
}
