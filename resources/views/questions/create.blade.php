@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Create New Question</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('questions.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}"
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="question_text" class="form-label">Question Text</label>
                    <textarea class="form-control @error('question_text') is-invalid @enderror" 
                              id="question_text" 
                              name="question_text" 
                              rows="3" 
                              required>{{ old('question_text') }}</textarea>
                    @error('question_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="question_type" class="form-label">Question Type</label>
                    <select class="form-select @error('question_type') is-invalid @enderror" 
                            id="question_type" 
                            name="question_type" 
                            required>
                        <option value="">Select a type...</option>
                        <option value="rating" {{ old('question_type') == 'rating' ? 'selected' : '' }}>Rating</option>
                        <option value="comment-only" {{ old('question_type') == 'comment-only' ? 'selected' : '' }}>Comment Only</option>
                        <option value="multiple-choice" {{ old('question_type') == 'multiple-choice' ? 'selected' : '' }}>Multiple Choice</option>
                    </select>
                    @error('question_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('questions.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create Question</button>
                </div>
            </form>
        </div>
    </div>
@endsection