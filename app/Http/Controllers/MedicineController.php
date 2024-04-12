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
            'quantity' => 'required|numeric',
            'presentation' => 'required|string',
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
            'quantity' => 'required|numeric',
            'presentation' => 'required|string',
            'description' => 'required|string',
        ]);
        $medicine -> update($validated);
        return $medicine;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicine $medicine)
    {
        $medicine -> delete();

        return response()->noContent();
    }
}
