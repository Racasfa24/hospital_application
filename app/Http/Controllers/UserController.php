<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'lastname' => 'required|string|min:2|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'phone_number' => 'required|string|unique:users,phone_number',
            'role' => 'required|string|in:administrator,receptionist' ,
        ]);

        $validated['password'] = Hash::make($validated['password']);

        return User::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'lastname' => 'required|string|min:2|max:255',
            'email' => 'required|email|unique:users,email,' .$user ->id,
            'password' => 'required|string',
            'phone_number' => 'required|string|unique:users,phone_number,' .$user ->id,
            'role' => 'required|string|in:administrator,receptionist' ,
        ]);

        $user->update($validated);

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->noContent();
    }
}

