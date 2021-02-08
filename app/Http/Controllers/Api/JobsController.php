<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs;

class JobsController extends Controller
{
  public function getAllJobs() {
    $jobs = Jobs::orderBy('job_title', 'asc')->get()->toJson(JSON_PRETTY_PRINT);
    return response($jobs, 200);
  }

  public function getJob($id) {
    if (Jobs::where('job_id', $id)->exists()) {
      $job = Jobs::where('job_id', $id)->get()->toJson(JSON_PRETTY_PRINT);
      return response($job, 200);
    } else {
      return response()->json([
        "message" => "Job not found"
      ], 404);
    }
  }

  public function createJob(Request $request) {
    $job = new Jobs;
    $job->job_title = $request->job_title;
    $job->min_salary = $request->min_salary;
    $job->max_salary = $request->max_salary;
    $job->save();

    return response()->json([
      "message" => "Job record created"
    ], 201);
  }

  public function updateJob(Request $request, $id) {
    if (Jobs::where('job_id', $id)->exists()) {
      $job = Jobs::find($id);

      $job->job_title  = is_null($request->job_title)  ? $job->job_title : $request->job_title;
      $job->min_salary = is_null($request->min_salary) ? $job->min_salary : $request->min_salary;
      $job->max_salary = is_null($request->max_salary) ? $job->max_salary : $request->max_salary;
      $job->save();

      return response()->json([
        "message" => "Job updated successfully"
      ], 200);
    } else {
      return response()->json([
        "message" => "Job not found"
      ], 404);
    }
  }

  public function deleteJob ($id) {
    if(Jobs::where('job_id', $id)->exists()) {
      $job = Jobs::find($id);
      $job->delete();

      return response()->json([
        "message" => "Job deleted"
      ], 202);
    } else {
      return response()->json([
        "message" => "Job not found"
      ], 404);
    }
  }
}
