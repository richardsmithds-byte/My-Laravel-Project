@extends('layouts.app')

@section('content')

<div class="container mt-4">

<form method="GET" action="{{ route('tasks.index') }}" class="d-flex gap-2 mb-4">

    <input type="text"
           name="search"
           class="form-control w-25 me-2"
           placeholder="Search..."
           value="{{ request('search') }}">

    <select name="status" class="form-select w-25 me-2 d-inline-block">
        <option value="">All</option>
        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
            Completed
        </option>
        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
            Pending
        </option>
    </select>

    <button type="submit" class="btn btn-primary">Filter</button>

</form>


<h2 class="mb-3">Task List</h2>


<form action="{{ route('tasks.store') }}" method="POST" class="mb-4 d-flex gap-2">
    @csrf

    <input type="text"
           name="name"
           value="{{ old('name') }}"
           class="form-control w-25"
           placeholder="Enter task">

    @error('name')
        <span style="color:red">{{ $message }}</span>
    @enderror

    <button class="btn btn-primary">Add Task</button>
</form>

<!-- @foreach($tasks as $task)
    <div class="mb-2">
        {{ $task->name }}
    </div>
@endforeach -->



<ul class="list-group">

@foreach($tasks as $task)

<li class="list-group-item d-flex justify-content-between align-items-center form-control w-75">

    @if($task->completed)
        <span class="text-success text-decoration-line-through">
            {{ $task->name }}
        </span>
    @else
        <span>{{ $task->name }}</span>
    @endif


    <div class="d-flex">

        <a href="{{ route('tasks.edit', $task->id) }}"
           class="btn btn-warning btn-sm me-2">
            Edit
        </a>


        <form action="{{ route('tasks.done', $task->id) }}" method="POST" class="me-2">
            @csrf
            <button type="button" class="btn btn-success btn-sm done-btn" data-id="{{ $task->id }}">Done</button>
        </form>


        <form action="{{ route('tasks.destroy', $task->id) }}"
              method="POST"
              class="me-2">
            @csrf
            @method('DELETE')

            <button class="btn btn-danger btn-sm">
                Delete
            </button>
        </form>


        <form action="{{ route('tasks.archiveTask', $task->id) }}"
              method="POST">
            @csrf

            <button type="submit" class="btn btn-secondary btn-sm">
                Archive
            </button>
        </form>

    </div>

</li>

@endforeach

</ul>

<div class="mt-3">
    {{ $tasks->links() }}
</div>

@endsection