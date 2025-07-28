<?php

namespace App\Repositories;

use App\Models\Submission;

class SubmissionRepository
{
    public function create(array $data): Submission
    {
        return Submission::create($data);
    }

    public function update(Submission $submission, array $data): bool
    {
        return $submission->update($data);
    }
}
