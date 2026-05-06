@extends('layouts.app')

@section('content')

<h1>Archived Tasks</h1>

@foreach($tasks as $task)
    <p>{{ $task->name }}</p>

    <form action="/tasks/{{ $task->id }}/restore" method="POST">
        @csrf
        <button type="submit" class="btn btn-success mb-2">Restore</button>
    </form>

    <form action="/tasks/{{ $task->id }}/force-delete" method="POST" class="mb-2">
        @csrf
        <button type="submit" class="btn btn-danger">Delete Forever</button>
    </form>

@endforeach

@endsection