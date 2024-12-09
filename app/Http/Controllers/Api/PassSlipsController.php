<?php

namespace App\Http\Controllers\Api;

use App\Models\PassSlips;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PassSlipsRequest;
use Illuminate\Support\Facades\Storage;

class PassSlipsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PassSlips::all(); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PassSlipsRequest $request)
    {
        // Validate the incoming request (this is done by the PassSlipsRequest)
        $validated = $request->validated();

        // Handle the image upload
        $imagePath = $request->file('pass_slip_image')->storePublicly('pass_slips', 'public');

         // Set a default value for status if it's not provided
        if (empty($validated['status'])) {
            $validated['status'] = 'pending';  // Default status
        }

        // Create the pass slip
        $passSlip = PassSlips::create([
            'user_id' => $validated['user_id'],
            'reason' => $validated['reason'],
            'time_out' => $validated['time_out'],
            'time_in' => $validated['time_in'],
            'pass_slip_image' => $imagePath,  // Save the image path
            'status' => $validated['status'],
        ]);

        // Return response
        return response()->json([
            'message' => 'Pass slip created successfully!',
            'pass_slip' => $passSlip
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $passSlip = PassSlips::findOrFail($id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(PassSlipsRequest $request, string $id)
    {
        // Find the pass slip by its ID
        $passSlip = PassSlips::findOrFail($id);

        // Get the validated data from the request
        $validated = $request->validated();

        // Check if the 'time_in' field is provided and not null (since 'time_in' is nullable)
        if (isset($validated['time_in'])) {
            // Only update the 'time_in' field if provided
            $passSlip->time_in = $validated['time_in'];
        }

        // If a new image is uploaded, handle it
        if ($request->hasFile('pass_slip_image')) {
            // Delete the old image if it exists
            if ($passSlip->pass_slip_image) {
                Storage::disk('public')->delete($passSlip->pass_slip_image);
            }

            // Store the new image
            $imagePath = $request->file('pass_slip_image')->storePublicly('pass_slips', 'public');
            $passSlip->pass_slip_image = $imagePath;
        }

        // Save the changes
        $passSlip->save();

        // Return the response
        return response()->json([
            'message' => 'Pass slip updated successfully!',
            'pass_slip' => $passSlip
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $passSlip = PassSlips::findOrFail($id);

        // Check if the pass slip has an image and if the file exists in storage
        if ($passSlip->pass_slip_image && Storage::disk('public')->exists($passSlip->pass_slip_image)) {
            // Delete the image from the storage
            Storage::disk('public')->delete($passSlip->pass_slip_image);
        }

        $passSlip->delete();

        return $passSlip;
    }

    public function approvePass(string $id)
    {
        // Find the leave record by ID
        $pass = PassSlips::findOrFail($id);

        // Update the status to approved
        $pass->update(['status' => 'approved']);

        return response()->json([
            'message' => 'Pass Slip status updated to approved successfully!',
            'leave'   => $pass->fresh(), // Ensure updated data is returned
        ]);
    }

    public function rejectPass(string $id)
    {
        // Find the leave record by ID
        $pass= PassSlips::findOrFail($id);

        // Update the status to rejected
        $pass->update(['status' => 'rejected']);

        return response()->json([
            'message' => 'Pass Slip status updated to rejected successfully!',
            'leave'   => $pass->fresh(), // Ensure updated data is returned
        ]);
    }
}
