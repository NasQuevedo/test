<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::orderBy('created_at', 'desc')->take(50)->get();

        return response()->json([
            'status' => true,
            'employees' => $employees
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $created = Employee::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Employee Created Succesfully',
            'employee' => $created
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return response()->json([
            "status" => true,
            "employee" => $employee
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $updated = $employee->update($request->all());

        return response()->json([
            "status" => true,
            "message" => 'Employee updated Succesfully',
            "employee" => $employee
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $deleted = $employee->delete();

        return response()->json([
            "status" => true,
            "message" => 'Employee Deleted Succesfully'
        ], 200);
    }
}
