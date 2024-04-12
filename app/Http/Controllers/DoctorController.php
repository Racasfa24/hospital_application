<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Doctor::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'lastname' => 'required|string|min:2|max:255',
            'speciality' => 'required|string',
            'admission_date' => 'required|date_format:Y-m-d,before:tomorrow',
            'professional_id' => 'required|string|unique:doctors,professional_id',
            'phone_number' => 'required|string',
            'email' => 'required|email|unique:doctors,email',
        ]);

        return Doctor::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        return $doctor;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'lastname' => 'required|string|min:2|max:255',
            'speciality' => 'required|string',
            'admission_date' => 'required|date_format:Y-m-d,before:tomorrow',
            'professional_id' => 'required|string|unique:doctors,professional_id,' . $doctor->id,
            'phone_number' => 'required|string',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
        ]);

        $doctor->update($validated);

        return $doctor;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return response()->noContent();
    }
}
