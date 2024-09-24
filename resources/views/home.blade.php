@extends('layouts.app')

@section('content')

@if (session('welcome'))
    <script>
        Swal.fire({
            title: "Welcome back to LuxeLine!",
            text: "We’re so glad to see you again! Enjoy exploring our latest arrivals and exclusive offers crafted just for our loyal customers!",
            imageUrl: "{{ asset('images/ll.png') }}",
            imageWidth: 100,
            imageHeight: 100,
            imageAlt: "Custom image"
        });
    </script>
@endif

@if (session('new_user'))
    <script>
        Swal.fire({
            title: "Welcome to LuxeLine!",
            text: "We’re thrilled to have you join our community. Discover the elegance and luxury of our curated collections—your stylish journey starts here!",
            imageUrl: "{{ asset('images/ll.png') }}",
            imageWidth: 100,
            imageHeight: 100,
            imageAlt: "Custom image"
        });
    </script>
@endif



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection