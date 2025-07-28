<?php

namespace App\Http\Controllers;

use App\Services\SubmissionService;
use App\Services\EmailService;
use App\Http\Requests\StoreSubmissionRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

class SubmissionsController extends Controller
{
    public function __construct(
        private SubmissionService $submissionService,
        private EmailService $emailService
    ) {}

    public function store(StoreSubmissionRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            $submission = $this->submissionService->createSubmission($validated);

            $this->emailService->sendSubmissionEmail($submission);

            return response()->json($submission, 201);
        } catch (\Exception $e) {
            Log::error('Error submitting form: ' . $e->getMessage());

            return response()->json(['error' => 'Failed to submit form'], 500);
        }
    }
}
