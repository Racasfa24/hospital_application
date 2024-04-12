<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'lastname',
        'birth_date',
        'affiliation_date',
        'phone_number',
        'blood_type'
    ];
    
    public const bloodA = 'A+';
    public const bloodAN = 'A-';
    public const bloodB = 'B+';
    public const bloodBN = 'B-';
    public const bloodAB = 'AB+';
    public const bloodABN = 'AB-';
    public const bloodO = 'O+';
    public const bloodON = 'O-';
}
