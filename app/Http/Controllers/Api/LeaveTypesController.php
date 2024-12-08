<?php

namespace App\Http\Controllers\Api;

use App\Models\LeaveTypes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LeaveTypesRequest;


class LeaveTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LeaveTypes::all(); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaveTypesRequest $request)
    {
        $validated = $request->validated();

        $leaveType = LeaveTypes::create($validated);

        return $leaveType;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $department = LeaveTypes::findOrFail($id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(LeaveTypesRequest $request, string $id)
    {
        $validated = $request->validated();

        $leaveType = LeaveTypes::findOrFail($id);

        $leaveType->update($validated);

        return $leaveType;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leaveType = LeaveTypes::findOrFail($id);
        
        $leaveType->delete();

        return $leaveType;
    }

}