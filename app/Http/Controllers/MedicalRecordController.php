<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MedicalRecord::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'datetime' => 'required|date_format:Y-m-d H:i'
        ]);

        return MedicalRecord::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalRecord $medicalRecord)
    {
        return $medicalRecord;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'datetime' => 'required|date_format:Y-m-d H:i'
        ]);

        $medicalRecord->update($validated);

        return $medicalRecord;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();

        return response()->noContent();
    }
}
