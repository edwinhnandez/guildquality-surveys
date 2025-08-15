@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Questions</h1>
    <a href="{{ route('questions.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> New Question
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('questions.bulk.assign') }}" method="POST">
            @csrf
            <fieldset>
                <legend class="h6 mb-3">Assign selected questions to surveys</legend>
                <div class="input-group mb-3">
                    <input type="text" 
                           class="form-control" 
                           name="survey_ids[]" 
                           placeholder="Survey IDs comma-separated" 
                           oninput="this.value=this.value.replace(/[^0-9,]/g,'')"
                           aria-label="Survey IDs">
                    <button class="btn btn-outline-secondary" type="submit">Assign</button>
                </div>
            </fieldset>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="form-check-input" onclick="toggleAll(this)"></th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $q)
                        <tr>
                            <td>
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       name="question_ids[]" 
                                       value="{{ $q->id }}">
                            </td>
                            <td>{{ $q->id }}</td>
                            <td>{{ $q->name }}</td>
                            <td><span class="badge bg-secondary">{{ $q->question_type }}</span></td>
                            <td>
                                <a href="{{ route('questions.edit', $q) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $questions->links() }}
            </div>
        </form>
    </div>
</div>

<form action="{{ route('questions.bulk.destroy') }}" 
      method="POST" 
      onsubmit="return confirm('Are you sure you want to delete the selected questions?')">
    @csrf 
    @method('DELETE')
    <input type="hidden" name="question_ids" id="del_ids">
    <button type="submit" 
            class="btn btn-danger" 
            onclick="collectIds()">
        <i class="bi bi-trash"></i> Delete Selected
    </button>
</form>

<script>
function collectIds() {
    const ids = Array.from(document.querySelectorAll('input[name="question_ids[]"]:checked')).map(i => i.value);
    const hidden = document.getElementById('del_ids');
    hidden.name = 'question_ids[]';
    hidden.value = '';
    ids.forEach(id => {
        const h = document.createElement('input');
        h.type = 'hidden';
        h.name = 'question_ids[]';
        h.value = id;
        hidden.parentNode.appendChild(h);
    });
}

function toggleAll(source) {
    const checkboxes = document.querySelectorAll('input[name="question_ids[]"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = source.checked;
    });
}
</script>
@endsection