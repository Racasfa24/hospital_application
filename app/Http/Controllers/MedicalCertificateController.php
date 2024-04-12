<?php

namespace App\Http\Controllers;

use App\Models\MedicalCertificate;
use Illuminate\Http\Request;

class MedicalCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MedicalCertificate::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date_format:Y-m-d',
            'age' => 'required|integer|min:1',
            'height' => 'required|numeric|min:1',
            'weight' => 'required|numeric|min:1',
            'systolic_pressure' => 'required|integer|min:1',
            'diastolic_pressure' => 'required|integer|min:1',
            'heart_rate' => 'required|integer|min:1',
            'respiratory_rate' => 'required|integer|min:1',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
        ]);
    
        return MedicalCertificate::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalCertificate $medicalCertificate)
    {
        return $medicalCertificate;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalCertificate $medicalC)
    {
        $validated = $request->validate([
            'date' => 'required|date_format:Y-m-d',
            'age' => 'required|integer|min:1',
            'height' => 'required|numeric|min:1',
            'weight' => 'required|numeric|min:1',
            'systolic_pressure' => 'required|integer|min:1',
            'diastolic_pressure' => 'required|integer|min:1',
            'heart_rate' => 'required|integer|min:1',
            'respiratory_rate' => 'required|integer|min:1',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
        ]);

        $medicalC->update($validated);

        return $medicalC;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalCertificate $medicalC)
    {
        $medicalC->delete();

        return response()->noContent();

    }
}
