<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::query()
            ->select(['id','name','created_at','updated_at'])
            ->orderByDesc('id')
            ->paginate(20);

        return view('surveys.index', compact('surveys'));
    }

    public function create()
    {
        $questions = Question::orderBy('name')->get(['id', 'name', 'question_type']);
        return view('surveys.create', compact('questions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'question_ids' => 'nullable|array',
            'question_ids.*' => 'integer|exists:questions,id',
            'new_questions' => 'nullable|array',
            'new_questions.*.name' => 'nullable|string|max:150',
            'new_questions.*.question_text' => 'nullable|string',
            'new_questions.*.question_type' => 'nullable|string|in:rating,comment-only,multiple-choice',
        ]);

        $survey = Survey::create(['name' => $data['name']]);

        // Attach existing questions
        if (!empty($data['question_ids'])) {
            $survey->questions()->attach($data['question_ids']);
        }

        // Create and attach new questions
        if (!empty($data['new_questions'])) {
            foreach ($data['new_questions'] as $q) {
                if (!empty($q['name']) && !empty($q['question_text']) && !empty($q['question_type'])) {
                    $newQ = Question::create($q);
                    $survey->questions()->attach($newQ->id);
                }
            }
        }

        return redirect()->route('surveys.show', $survey)->with('ok', 'Survey created');
    }

    public function show(Survey $survey)
    {
        $survey->load(['questions:id,name,question_text,question_type']);
        return view('surveys.show', compact('survey'));
    }

    public function edit(Survey $survey)
    {
        $questions = Question::orderBy('name')->get();
        return view('surveys.edit', compact('survey', 'questions'));
    }

    public function update(Request $request, Survey $survey)
    {
        $data = $request->validate(['name' => 'required|string|max:150']);
        $survey->update($data);
        return redirect()->route('surveys.show', $survey)->with('ok', 'Survey updated');
    }

    public function destroy(Survey $survey)
    {
        $survey->delete();
        return redirect()->route('surveys.index')->with('ok', 'Survey deleted');
    }
}
