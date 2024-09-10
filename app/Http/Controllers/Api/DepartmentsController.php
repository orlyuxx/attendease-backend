<?php

namespace App\Http\Controllers\Api;

use App\Models\Departments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentsRequest;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Departments::all(); 
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentsRequest $request)
    {
        $validated = $request->validated();

        $department = Departments::create($validated);

        return $department;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $department = Departments::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentsRequest $request, string $id)
    {
        $validated = $request->validated();

        $department = Departments::findOrFail($id);

        $department->update($validated);

        return $department;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Departments::findOrFail($id);
        
        $department->delete();

        return $department;
    }
}
