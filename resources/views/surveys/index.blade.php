@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Surveys</h1>
    <a href="{{ route('surveys.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> New Survey
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($surveys as $s)
                    <tr>
                        <td>{{ $s->id }}</td>
                        <td>
                            <a href="{{ route('surveys.show', $s) }}" class="text-decoration-none">
                                {{ $s->name }}
                            </a>
                        </td>
                        <td>{{ $s->updated_at->format('M d, Y') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('surveys.edit', $s) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('surveys.destroy', $s) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-outline-danger" 
                                            onclick="return confirm('Are you sure you want to delete this survey?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $surveys->links() }}
        </div>
    </div>
</div>
@endsection