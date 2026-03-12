<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        $cars = \App\Models\Car::latest()->get();
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'model' => 'nullable|string',
            'car_type' => 'nullable|string',
            'seats' => 'required|integer',
            'price_per_day' => 'required|numeric',
            'other_charges' => 'required|numeric',
            'image' => 'nullable|string',
        ]);

        \App\Models\Car::create($validated + [
                'has_ac' => $request->has('has_ac'),
                'is_available' => $request->has('is_available'),
                'rating' => 4.0,
                'ratings_count' => 0,
            ]);

        return redirect()->route('admin.cars.index')->with('success', 'Car added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
