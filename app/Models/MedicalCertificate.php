<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalCertificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'age',
        'height',
        'weight',
        'systolic_pressure',
        'diastolic_pressure',
        'heart_rate',
        'respiratory_rate',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
