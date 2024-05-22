<?php

namespace App\Http\Controllers;

use App\Models\MedicalCertificate;
use Illuminate\Http\Request;
use function Spatie\LaravelPdf\Support\pdf;

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
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
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
    public function update(Request $request, MedicalCertificate $medicalCertificate)
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
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
        ]);

        $medicalCertificate->update($validated);

        return $medicalCertificate;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalCertificate $medicalCertificate)
    {
        $medicalCertificate->delete();

        return response()->noContent();
    }

    /**
     * Generate a PDF for the specified resource.
     */
    public function generatePdf(MedicalCertificate $medicalCertificate)
    {
        // Generate a PDF for the medicine
        return pdf()
            ->view('pdf.invoice', ['medicalCertificate' => $medicalCertificate])
            ->name('invoice-2023-04-10.pdf');
    }
}
