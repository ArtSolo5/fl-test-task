<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;

class SubmissionsController extends Controller
{
  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:35',
      'email' => 'required|email|max:35',
      'phone' => 'required|string|max:15',
      'message' => 'nullable|string',
      'file' => 'nullable|file|mimes:pdf,doc,docx,txt,jpg,jpeg,png,gif,bmp,tiff|max:2048',
    ]);

    $submission = Submission::create($validated);

    if ($request->hasFile('file')) {
      $file = $request->file('file');
      $fileName = $file->getClientOriginalName();
      $file->move(public_path('uploads'), $fileName);
      $submission->file_name = $fileName;
      $submission->save();
    }

    return response()->json($submission, 201);
  }
}
