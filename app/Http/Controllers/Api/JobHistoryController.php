<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JobHistory;

class JobHistoryController extends Controller
{
  public function getAllJobHistory() {
    $job_history = JobHistory::orderBy('end_date', 'desc')->get()->toJson(JSON_PRETTY_PRINT);
    return response($job_history, 200);
  }

  public function getJobHistory($id) {
    if (JobHistory::where('job_history_id', $id)->exists()) {
      $job_history = JobHistory::where('job_history_id', $id)->get()->toJson(JSON_PRETTY_PRINT);
      return response($job_history, 200);
    } else {
      return response()->json([
        "message" => "Job History not found"
      ], 404);
    }
  }

  public function createJobHistory(Request $request) {
    $job_history = new JobHistory;
    $job_history->start_date = $request->start_date;
    $job_history->end_date = $request->end_date;
    $job_history->employee_id = $request->employee_id;
    $job_history->department_id = $request->department_id;
    $job_history->job_id = $request->job_id;
    $job_history->save();

    return response()->json([
      "message" => "Job History created"
    ], 201);
  }

  public function updateJobHistory(Request $request, $id) {
    if (JobHistory::where('job_history_id', $id)->exists()) {
      $job_history = JobHistory::find($id);

      $job_history->start_date  = is_null($request->start_date)  ? $job_history->start_date : $request->start_date;
      $job_history->end_date = is_null($request->end_date) ? $job_history->end_date : $request->end_date;
      $job_history->employee_id = is_null($request->employee_id) ? $job_history->employee_id : $request->employee_id;
      $job_history->department_id = is_null($request->department_id) ? $job_history->department_id : $request->department_id;
      $job_history->job_id = is_null($request->job_id) ? $job_history->job_id : $request->job_id;
      $job_history->save();

      return response()->json([
        "message" => "Job History updated successfully"
      ], 200);
    } else {
      return response()->json([
        "message" => "Job History not found"
      ], 404);
    }
  }

  public function deleteJobHistory ($id) {
    if(JobHistory::where('job_history_id', $id)->exists()) {
      $job_history = JobHistory::find($id);
      $job_history->delete();

      return response()->json([
        "message" => "Job History deleted"
      ], 202);
    } else {
      return response()->json([
        "message" => "Job History not found"
      ], 404);
    }
  }
}
