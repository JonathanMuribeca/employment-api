<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Departments;

class DepartmentsController extends Controller
{
  public function getAllDepartments() {
    $departments = Departments::orderBy('department_name', 'asc')->get()->toJson(JSON_PRETTY_PRINT);
    return response($departments, 200);
  }

  public function getDepartment($id) {
    if (Departments::where('departments_id', $id)->exists()) {
      $department = Departments::where('departments_id', $id)->get()->toJson(JSON_PRETTY_PRINT);
      return response($department, 200);
    } else {
      return response()->json([
        "message" => "Department not found"
      ], 404);
    }
  }

  public function createDepartment(Request $request) {
    $department = new Departments;
    $department->department_name = $request->department_name;
    $department->manager_id = $request->manager_id;
    $department->save();

    return response()->json([
      "message" => "Department record created"
    ], 201);
  }

  public function updateDepartment(Request $request, $id) {
    if (Departments::where('department_id', $id)->exists()) {
      $department = Departments::find($id);

      $department->department_name = is_null($request->department_name) ? $department->department_name : $request->department_name;
      $department->manager_id = is_null($request->manager_id) ? $department->manager_id : $request->manager_id;
      $department->save();

      return response()->json([
        "message" => "Department updated successfully"
      ], 200);
    } else {
      return response()->json([
        "message" => "Department not found"
      ], 404);
    }
  }

  public function deleteDepartment ($id) {
    if(Departments::where('department_id', $id)->exists()) {
      $department = Departments::find($id);
      $department->delete();

      return response()->json([
        "message" => "Department deleted"
      ], 202);
    } else {
      return response()->json([
        "message" => "Department not found"
      ], 404);
    }
  }
}
