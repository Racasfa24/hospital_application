<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Prescription::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $validated = $request->validate([
            'medical_record_id' => 'required',
            'notes' => 'required|string',
            'date' => 'required|date_format:Y-m-d',
            'medicines' => 'required|array',
            'medicines.*.medicine_id' => 'required|exists:medicines,id',
            'medicines.*.indications' => 'required|string',
        ]);

        $prescription = Prescription::create([
            'medical_record_id' => $validated['medical_record_id'],
            'notes' => $validated['notes'],
            'date' => $validated['date'],
        ]);

        $medicines = collect($validated['medicines'])->mapWithKeys(function ($medicine) {
            return [ 
                $medicine['medicine_id'] => ['indications' => $medicine['indications']]
            ];
        });

        $prescription->medicines()->attach($medicines);

        $prescription->load('medicines');

        return $prescription;
    }

    /**
     * Display the specified resource.
     */
    public function show(Prescription $prescription)
    {
        return $prescription->load('medicines');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prescription $prescription)
    {
        $validated = $request->validate([
            'medical_record_id' => 'required',
            'notes' => 'required|string',
            'date' => 'required|date_format:Y-m-d',
            'medicines' => 'required|array',
            'medicines.*.medicine_id' => 'required|exists:medicines,id',
            'medicines.*.indications' => 'required|string',
        ]);

        $prescription->update([
            'medical_record_id' => $validated['medical_record_id'],
            'notes' => $validated['notes'],
            'date' => $validated['date'],
        ]);

        $prescription->medicines()->detach();

        $medicines = collect($validated['medicines'])->mapWithKeys(function ($medicine) {
            return [ 
                $medicine['medicine_id'] => ['indications' => $medicine['indications']]
            ];
        });

        $prescription->medicines()->attach($medicines);

        $prescription->load('medicines');

        return $prescription;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prescription $prescription)
    {
        $prescription->delete();

        return response()->noContent();
    }
}
