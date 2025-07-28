<?php

namespace App\Services;

use App\Models\Submission;
use App\Repositories\SubmissionRepository;
use Illuminate\Http\UploadedFile;
use Exception;

class SubmissionService
{
    public function __construct(
        private SubmissionRepository $submissionRepository
    ) {}

    public function createSubmission(array $validatedData): Submission
    {
        $submission = $this->submissionRepository->create($validatedData);

        if (isset($validatedData['file']) && $validatedData['file'] instanceof UploadedFile) {
            try {
                $fileName = $this->handleFileUpload($validatedData['file'], $submission->id);
                $this->submissionRepository->update($submission, ['file_name' => $fileName]);
            } catch (Exception $e) {
                throw new Exception('Failed to upload file: ' . $e->getMessage());
            }
        }

        return $submission;
    }

    private function handleFileUpload(UploadedFile $file, int $submissionId): string
    {
        $fileName = $file->getClientOriginalName();
        $directory = storage_path('app/submissions/' . $submissionId . '/uploads');

        $file->move($directory, $fileName);

        return $fileName;
    }
}
