<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'active_ingredients',
        'dosage_strength',
        'dosage_unit',
        'prescription_info',
        'presentation',
        'price',
        'quantity_in_stock',
        'supplier_name',
        'supplier_contact',
        'supplier_cost',
        'description',
    ];

    public function prescriptions()
    {
        return $this->belongsToMany(Prescription::class)
            ->withTimestamps()
            ->withPivot('indications');
    }
}
