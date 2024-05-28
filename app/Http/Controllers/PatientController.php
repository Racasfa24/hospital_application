<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Patient::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'lastname' => 'required|string|min:2|max:255',
            'birth_date' => 'required|date_format:Y-m-d,before:affiliation_date',
            'affiliation_date' => 'required|date_format:Y-m-d,after:birth_date',
            'phone_number' => 'required|string|unique:patients,phone_number',
            'blood_type' => 'required|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'curp' => 'required|string|size:18|regex:/^[A-Z0-9]{18}$/|unique:patients,curp',
        ]);

        return Patient::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return $patient;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'lastname' => 'required|string|min:2|max:255',
            'birth_date' => 'required|date_format:Y-m-d,before:affiliation_date',
            'affiliation_date' => 'required|date_format:Y-m-d,after:birth_date',
            'phone_number' => 'required|string|unique:patients,phone_number,' . $patient->id,
            'blood_type' => 'required|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'curp' => 'required|string|size:18|regex:/^[A-Z0-9]{18}$/|unique:patients,curp,' . $patient->curp,
        ]);

        $patient->update($validated);

        return $patient;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Patient $patient)
    {
        $patient->delete();

        return response()->noContent();
    }
}
