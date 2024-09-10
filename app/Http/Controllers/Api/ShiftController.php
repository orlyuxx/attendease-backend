<?php

namespace App\Http\Controllers\Api;

use App\Models\Shifts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShiftsRequest;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Shifts::all(); 
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ShiftsRequest $request)
    {
        $validated = $request->validated();

        $shift= Shifts::create($validated);

        return $shift;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $shift = Shifts::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShiftsRequest $request, string $id)
    {
        $validated = $request->validated();

        $shift = Shifts::findOrFail($id);

        $shift->update($validated);

        return $shift;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shift = Shifts::findOrFail($id);
        
        $shift->delete();

        return $shift;
    }
}
