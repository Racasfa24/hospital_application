<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Medicine::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'active_ingredients' => 'required|string',
            'dosage_strength' => 'required|string',
            'dosage_unit' => 'required|string',
            'prescription_info' => 'required|string',
            'presentation' => 'required|in:capsule,pill,syrup',
            'price' => 'required|numeric',
            'quantity_in_stock' => 'required|integer',
            'supplier_name' => 'required|string',
            'supplier_contact' => 'required|string',
            'supplier_cost' => 'required|numeric',
            'description' => 'required|string',
        ]);

        return Medicine::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicine $medicine)
    {
        return $medicine;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicine $medicine)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'active_ingredients' => 'required|string',
            'dosage_strength' => 'required|string',
            'dosage_unit' => 'required|string',
            'prescription_info' => 'required|string',
            'presentation' => 'required|in:capsule,pill,syrup',
            'price' => 'required|numeric',
            'quantity_in_stock' => 'required|integer',
            'supplier_name' => 'required|string',
            'supplier_contact' => 'required|string',
            'supplier_cost' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $medicine->update($validated);

        return $medicine;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicine $medicine)
    {
        $medicine->delete();

        return response()->noContent();
    }
}
