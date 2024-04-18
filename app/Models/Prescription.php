<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->medicalRecord()->doctor();
    }

    public function patient()
    {
        return $this->medicalRecord()->patient();
    }

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class)
            ->withTimestamps()
            ->withPivot('indications');
    }
}
