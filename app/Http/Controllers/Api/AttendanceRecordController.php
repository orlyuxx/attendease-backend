<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AttendanceRecords;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRecordsRequest;

class AttendanceRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AttendanceRecords::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceRecordsRequest $request)
    {
        $validated = $request->validated();

        $attendance = AttendanceRecords::create($validated);

        return $attendance;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $attendance = AttendanceRecords::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttendanceRecordsRequest $request, string $id)
    {
        $validated = $request->validated();

        $attendance = AttendanceRecords::findOrFail($id);

        $attendance->update($validated);

        return $attendance;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
