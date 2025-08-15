<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::query()
            ->select(['id','name','question_type','updated_at'])
            ->latest('id')
            ->paginate(20);

        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'question_text' => 'required|string',
            'question_type' => 'required|string|in:rating,comment-only,multiple-choice'
        ]);
        $question = Question::create($data);
        return redirect()->route('questions.index')->with('ok', 'Question created');
    }

    public function edit(Question $question)
    {
        return view('questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'question_text' => 'required|string',
            'question_type' => 'required|string|in:rating,comment-only,multiple-choice'
        ]);
        $question->update($data);
        return redirect()->route('questions.index')->with('ok', 'Question updated');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index')->with('ok', 'Question deleted');
    }
}
