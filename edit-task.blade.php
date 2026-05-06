@extends('layouts.app')

@section('content')

<h2>Edit Task</h2>

<form action="{{ route('tasks.update', $task->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <input type="text" name="name" value="{{ old('name', $task->name) }}" class="form-control mb-3">
        @error('name')
            <div style="color:red">{{ $message }}</div>
        @enderror
    <button class="btn btn-success">Update Task</button>

</form>
@endsection