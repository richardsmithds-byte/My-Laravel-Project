<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <title>Task App</title>

</head>
<body>
<nav class="mb-3 d-flex justify-content-between align-items-center">

    <div>
        <a href="/" class="btn btn-outline-primary">Home</a>
        <a href="/about" class="btn btn-outline-success">About</a>
        <a href="/contact" class="btn btn-outline-dark">Contact</a>
        <a href="/tasks" class="btn btn-outline-dark">Tasks</a>
        <a href="/archive" class="btn btn-secondary">Archive</a>
    </div>

    <div>
        @auth
            <span class="me-2"> {{ Auth::user()->name }}</span>

            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-danger btn-sm">Logout</button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-success btn-sm">Register</a>
        @endguest
    </div>

</nav>

<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        
    @endif

@yield('content')

<hr>

<footer class="text-muted">© 2026 My Laravel Site</footer>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('app.js') }}"></script>
</html>