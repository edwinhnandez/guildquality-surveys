<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionBulkController extends Controller
{
    /**
     * Assign multiple questions to multiple surveys.
     */
    public function assign(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'question_ids' => 'required|array',
            'question_ids.*' => 'integer|exists:questions,id',
            'survey_ids'   => 'required|array',
            'survey_ids.*' => 'integer|exists:surveys,id',
        ]);

        // Efficient many-to-many attach without duplicates
        $surveys = Survey::whereIn('id', $validated['survey_ids'])->get(['id']);
        foreach ($surveys as $survey) {
            $survey->questions()->syncWithoutDetaching($validated['question_ids']);
        }

        return back()->with('ok', 'Questions assigned to selected surveys');
    }

    /**
     * Delete multiple questions.
     * This will cascade delete from the pivot table as well.
     */
    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'question_ids' => 'required|array',
            'question_ids.*' => 'integer|exists:questions,id',
        ]);

        // Cascade will clean pivot rows
        Question::whereIn('id', $validated['question_ids'])->delete();

        return back()->with('ok', 'Selected questions deleted');
    }
}
