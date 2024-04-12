<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'quantity',
        'presentation',
        'description',
    ];
    public const pCapsule = 'capsule';
    public const pPill = 'pill';
    public const pSyrup = 'syrup';
}
