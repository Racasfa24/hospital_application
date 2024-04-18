<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'presentation',
        'description',
    ];

    public function prescriptions()
    {
        return $this->belongsToMany(Prescription::class)->withPivot('indications');
    }
}
