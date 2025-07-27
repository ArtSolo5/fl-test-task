<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormSubmitted;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreSubmissionRequest;

class SubmissionsController extends Controller
{
  public function store(StoreSubmissionRequest $request)
  {
    try {
      $validated = $request->validated();

      $submission = Submission::create($validated);

      if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move(storage_path('app/submissions/' . $submission->id . '/uploads'), $fileName);
        $submission->file_name = $fileName;
        $submission->save();
      }

      Mail::to($validated['email'])->send(new FormSubmitted($submission));

      return response()->json($submission, 201);
    } catch (\Exception $e) {
      Log::error('Error submitting form: ' . $e->getMessage());

      return response()->json(['error' => 'Failed to submit form'], 500);
    }
  }
}
