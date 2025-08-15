@extends('layout')

@section('content')
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h1 class="mb-2">Survey #{{ $survey->id }} — {{ $survey->name }}</h1>
            <p class="text-muted">
                Created: {{ $survey->created_at->format('M d, Y H:i') }} · 
                Updated: {{ $survey->updated_at->format('M d, Y H:i') }}
            </p>
        </div>
        <div>
            <a href="{{ route('surveys.edit', $survey) }}" class="btn btn-primary">
                <i class="bi bi-pencil"></i> Edit Survey
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title mb-0">Questions</h3>
    </div>
    <div class="card-body">
        @if($survey->questions->isEmpty())
            <p class="text-muted mb-0">
                <i class="bi bi-info-circle"></i> No questions yet.
            </p>
        @else
            <div class="list-group">
                @foreach($survey->questions as $q)
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between mb-1">
                            <h5 class="mb-1">{{ $q->name }}</h5>
                            <span class="badge bg-secondary">{{ $q->question_type }}</span>
                        </div>
                        <p class="mb-0 text-muted">{{ $q->question_text }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection