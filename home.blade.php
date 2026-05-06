@extends('layouts.app')

@auth
    {{ Auth::user()->name }}
@endauth

@section('content')
    <h2>Home Page</h2> 
    <p>This is home page.</p>
@endsection