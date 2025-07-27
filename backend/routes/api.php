<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmissionsController;

Route::post('/submissions', [SubmissionsController::class, 'store']);
