<?php

namespace App\Services;

use App\Models\Submission;
use App\Mail\FormSubmitted;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendSubmissionEmail(Submission $submission): void
    {
        Mail::to($submission->email)->send(new FormSubmitted($submission));
    }
}
