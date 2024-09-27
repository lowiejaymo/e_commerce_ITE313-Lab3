@extends('layouts.app')

@section('content')
<div class="container d-flex flex-column justify-content-center align-items-center" style="height: 60vh;">
    <div class="text-center">
        <img src="{{ asset('images/luxeline-404-error.png') }}" alt="404 Not Found" class="img-fluid" style="max-width: 50%; height: auto;">
        <p>The page you are looking for could not be found.</p>
        <a href="{{ url('/') }}" class="btn btn-dark">Go to Home</a>
    </div>
</div>
@endsection
