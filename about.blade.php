@extends('layouts.app')

@auth
    {{ Auth::user()->name }}
@endauth

@section('content')
    <h2>About Page</h2>
    <p>About us text</p>
@endsection