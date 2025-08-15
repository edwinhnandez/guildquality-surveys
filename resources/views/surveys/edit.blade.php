@extends('layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Edit Survey #{{ $survey->id }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('surveys.update', $survey) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Survey Name</label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name', $survey->name) }}" 
                       required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <h6 class="mb-3">Manage Questions</h6>
                @if($questions->isEmpty())
                    <p class="text-muted"><em>No questions available.</em></p>
                @else
                    <div class="list-group mb-3">
                        @foreach($questions as $question)
                            <label class="list-group-item">
                                <input class="form-check-input me-1" 
                                       type="checkbox" 
                                       name="question_ids[]" 
                                       value="{{ $question->id }}"
                                       {{ $survey->questions->contains($question->id) ? 'checked' : '' }}>
                                {{ $question->name }}
                                <span class="badge bg-secondary">{{ $question->question_type }}</span>
                            </label>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="mb-4">
                <h6 class="mb-3">Add New Questions</h6>
                <div id="new-questions-container"></div>
                <button type="button" onclick="addQuestion()" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-plus-circle"></i> Add Question
                </button>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('surveys.show', $survey) }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Survey</button>
            </div>
        </form>
    </div>
</div>

<script>
function addQuestion() {
    const container = document.getElementById('new-questions-container');
    const index = container.children.length;

    const html = `
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>New Question</span>
            <button type="button" class="btn-close" onclick="this.closest('.card').remove()"></button>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" 
                       name="new_questions[${index}][name]" 
                       class="form-control" 
                       required>
            </div>
            <div class="mb-3">
                <label class="form-label">Question Text</label>
                <textarea name="new_questions[${index}][question_text]" 
                          class="form-control" 
                          rows="2" 
                          required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Type</label>
                <select name="new_questions[${index}][question_type]" 
                        class="form-select" 
                        required>
                    <option value="">-- select type --</option>
                    <option value="rating">Rating</option>
                    <option value="comment-only">Comment Only</option>
                    <option value="multiple-choice">Multiple Choice</option>
                </select>
            </div>
        </div>
    </div>
    `;

    container.insertAdjacentHTML('beforeend', html);
}
</script>
@endsection