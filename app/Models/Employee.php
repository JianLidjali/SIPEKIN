<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Ramsey\Uuid\Uuid;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
        'name',
        'staffIdentityCardNo',
        'department',
        'position',
        'dateJoined',
        'dateInThePresentPosition',
    ];
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'employee_id', 'uuid');
    }
    public function performanceAppraisal(): HasMany
    {
        return $this->hasMany(PerformanceAppraisal::class);
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
    
}
