<?php

use App\Http\Controllers\SurveyController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionBulkController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('surveys.index'));

Route::resource('surveys', SurveyController::class);
Route::resource('questions', QuestionController::class);

// Mass actions
Route::post('/questions/bulk/assign', [QuestionBulkController::class, 'assign'])->name('questions.bulk.assign');
Route::delete('/questions/bulk/destroy', [QuestionBulkController::class, 'destroy'])->name('questions.bulk.destroy');
