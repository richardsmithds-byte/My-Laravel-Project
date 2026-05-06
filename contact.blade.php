@extends('layouts.app')

@section('content')
    <h2>Contact Page</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/contact" method="POST">
    @csrf
    

    <div class="mb-3">
        <input type="text" name="name" class="form-control w-25" placeholder="Your Name" value="{{ old('name') }}">
    </div>
    
    <div class="mb-3">
        <input type="email" name="email" class="form-control w-25" placeholder="Your Email" value="{{ old('email') }}">
    </div>

    <button type="submit" class="btn btn-primary">Send</button>

</form>

@endsection