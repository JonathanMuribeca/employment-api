<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employees;

class EmployeesController extends Controller
{
  public function getAllEmployees() {
    $employees = Employees::orderBy('first_name', 'asc')->get()->toJson(JSON_PRETTY_PRINT);
    return response($employees, 200);
  }

  public function getEmployee($id) {
    if (Employees::where('employee_id', $id)->exists()) {
      $employee = Employees::where('employee_id', $id)->get()->toJson(JSON_PRETTY_PRINT);
      return response($employee, 200);
    } else {
      return response()->json([
        "message" => "Employee not found"
      ], 404);
    }
  }

  public function createEmployee(Request $request) {
    $employee = new Employees;
    $employee->first_name = $request->first_name;
    $employee->last_name = $request->last_name;
    $employee->email = $request->email;
    $employee->phone_number = $request->phone_number;
    $employee->hire_date = $request->hire_date;
    $employee->salary = $request->salary;
    $employee->commission_pct = $request->commission_pct;
    $employee->manager_id = $request->manager_id;
    $employee->job_id = $request->job_id;
    $employee->department_id = $request->department_id;
    $employee->save();

    return response()->json([
      "message" => "Employee record created"
    ], 201);
  }

  public function updateEmployee(Request $request, $id) {
    if (Employees::where('employee_id', $id)->exists()) {
      $employee = Employees::find($id);

      $employee->first_name  = is_null($request->first_name)  ? $employee->first_name : $request->first_name;
      $employee->last_name = is_null($request->last_name) ? $employee->last_name : $request->last_name;
      $employee->email = is_null($request->email) ? $employee->email : $request->email;
      $employee->save();

      return response()->json([
        "message" => "Employee updated successfully"
      ], 200);
    } else {
      return response()->json([
        "message" => "Employee not found"
      ], 404);
    }
  }

  public function deleteEmployee ($id) {
    if(Employees::where('employee_id', $id)->exists()) {
      $employee = Employees::find($id);
      $employee->delete();

      return response()->json([
        "message" => "Employee deleted"
      ], 202);
    } else {
      return response()->json([
        "message" => "Employee not found"
      ], 404);
    }
  }
}
