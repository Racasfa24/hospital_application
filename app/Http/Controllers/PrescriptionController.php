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

            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'medicine_id' =>  'requires|exists:medicine,id',
            'quantity' => 'required|numeric|min:1',
            'frequency' => 'required|string',
            'duration' => 'required|string',
            'notes' => 'required|string',

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Prescription $prescription)
    {
        return $prescription;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
