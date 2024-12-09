<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AttendanceRecords;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRecordsRequest;

class AttendanceRecordsController extends Controller
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

        // Determine the attendance status
        $status = $request->time_in <= '09:00:00' ? 'On Time' : 'Late';

        // Create a new attendance record
        $attendance = AttendanceRecords::create([
            'user_id' => $request->user_id,
            'date' => $request->date,
            'time_in' => $request->time_in,
            'status' => $status,
        ]);

        return response()->json([
            'message' => 'Attendance record stored successfully!',
            'attendance' => $attendance,
        ]);
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
        // Find the existing attendance record
        $attendance = AttendanceRecords::findOrFail($id);

        // Initialize values for break_in, break_out, time_out, etc.
        $break_in = $request->break_in ? date('H:i:s', strtotime($request->break_in)) : $attendance->break_in;
        $break_out = $request->break_out ? date('H:i:s', strtotime($request->break_out)) : $attendance->break_out;
        $time_out = $request->time_out ? date('H:i:s', strtotime($request->time_out)) : $attendance->time_out;
        $time_in = $request->time_in ? date('H:i:s', strtotime($request->time_in)) : $attendance->time_in;

        // Determine the break-in status based on break_in (same logic as store)
        $break_in_status = $attendance->break_in_status;
        if ($request->has('break_in') && $break_in) {
            $break_in_status = $break_in <= '12:00:00' ? 'On Time' : 'Late';
        }

        // Determine the break-out status based on break_out (same logic as break_in)
        $break_out_status = $attendance->break_out_status;
        if ($request->has('break_out') && $break_out) {
            $break_out_status = $break_out <= '13:00:00' ? 'On Time' : 'Late';
        }

        // Determine the time-out status based on time_out
        $time_out_status = $attendance->time_out_status;
        if ($request->has('time_out') && $time_out) {
            $time_out_status = $time_out <= '17:00:00' ? 'On Time' : 'Late';
        }

        // Calculate total_hours (excluding breaks)
        $total_hours = $attendance->total_hours;
        if ($time_in && $time_out) {
            // Convert times to timestamps for calculation only
            $time_in_stamp = strtotime("2000-01-01 " . $time_in);
            $time_out_stamp = strtotime("2000-01-01 " . $time_out);

            // Calculate break duration if break_in and break_out are set
            $break_duration = 0;
            if ($break_in && $break_out) {
                $break_in_stamp = strtotime("2000-01-01 " . $break_in);
                $break_out_stamp = strtotime("2000-01-01 " . $break_out);
                $break_duration = $break_out_stamp - $break_in_stamp;
            }

            // Calculate total hours in decimal form
            $total_hours = ($time_out_stamp - $time_in_stamp) / 3600; // - $break_duration

            // Uncomment the following lines to include break duration in total hours calculation
            /*
            if ($break_in && $break_out) {
                $break_in_stamp = strtotime("2000-01-01 " . $break_in);
                $break_out_stamp = strtotime("2000-01-01 " . $break_out);
                $break_duration = $break_out_stamp - $break_in_stamp;
                $total_hours = ($time_out_stamp - $time_in_stamp - $break_duration) / 3600;
            }
            */
        }

        // Update the fields with the formatted time strings
        $attendance->update([
            'time_in' => $time_in,
            'break_in' => $break_in,
            'break_out' => $break_out,
            'time_out' => $time_out,
            'break_in_status' => $break_in_status,
            'break_out_status' => $break_out_status,
            'time_out_status' => $time_out_status,
            'total_hours' => $total_hours !== null ? round($total_hours, 2) : $attendance->total_hours,
        ]);

        return response()->json([
            'message' => 'Attendance record updated successfully!',
            'attendance' => $attendance,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = AttendanceRecords::findOrFail($id);
        
        $record->delete();

        return $record;
    }
}
