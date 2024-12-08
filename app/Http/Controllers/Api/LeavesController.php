<?php

namespace App\Http\Controllers\Api;

use App\Models\Leaves;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LeavesRequest;

class LeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Leaves::all(); 
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(LeavesRequest $request)
    {
        $validated = $request->validated();

        $leave= Leaves::create($validated);

        return $leave;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $leave = Leaves::findOrFail($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeavesRequest $request, string $id)
    {
        $validated = $request->validated();
    
        // Find the leave record
        $leave = Leaves::findOrFail($id);
    
        // Update only the fields present in the request
        $leave->update($request->only([
            'user_id',
            'leave_start',
            'leave_end',
            'reason',
            'number_of_days',
            'leave_type_id',
            'status',
        ]));
    
        return response()->json([
            'message' => 'Leave record updated successfully!',
            'leave'   => $leave,
        ]);
    }
    
    public function updateStatus(LeavesRequest $request, string $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected', // Ensure only valid statuses are allowed
        ]);

        // Find the leave record by ID
        $leave = Leaves::findOrFail($id);

        // Update only the status
        $leave->update(['status' => $validated['status']]);

        return response()->json([
            'message' => 'Leave status updated successfully!',
            'leave'   => $leave->fresh(), // Ensure updated data is returned
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leave = Leaves::findOrFail($id);
        
        $leave->delete();

        return $leave;
    }
}
