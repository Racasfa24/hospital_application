<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'birth_date',
        'affiliation_date',
        'phone_number',
        'specialty',
    ];

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}
