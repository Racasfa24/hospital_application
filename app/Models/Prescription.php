<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_id',
        'notes',
        'date',
    ];

    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }

    public function doctor()
    {
        return $this->hasOneThrough(Doctor::class, MedicalRecord::class);
    }

    public function patient()
    {
        return $this->hasOneThrough(Patient::class, MedicalRecord::class);
    }

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class)
            ->withTimestamps()
            ->withPivot('indications');
    }
}
