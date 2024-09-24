@extends('layouts.app')

@section('content')


<div class="mt-2">
    <a href="{{ route('admin.manageUsers') }}" class="btn btn-secondary">Back to User List</a>
</div>
<div class="container my-2">
    <div class="card shadow-lg">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><strong>User Information</strong></h3>
            <div>
                <a href="{{ route('admin.editUser', $user->id) }}" class="btn btn-dark">Edit</a>
                <!-- Delete Button -->
                <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" class="d-inline"
                    id="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger" id="delete-button">Delete</button>
                </form>
            </div>
        </div>
        <div class="row g-0">
            <!-- Profile Picture Column -->
            <div class="col-md-4 d-flex justify-content-center align-items-center p-4">
                <img src="{{ asset('storage/user_profile_pictures/' . $user->profile_picture) }}"
                    alt="Profile Picture of {{ $user->name }}" class="img-fluid rounded-circle shadow-lg"
                    style="width: 200px; height: 200px; object-fit: cover;">
            </div>

            <!-- User Information Column -->
            <div class="col-md-8">
                <div class="card-body p-5">
                    <h1 class="card-title"><strong>{{ $user->name }}</strong></h1>
                    <div class="mt-3"><strong>ID:</strong> {{ $user->id }}</div>
                    <div class="mt-2"><strong>Email:</strong> {{ $user->email }}</div>
                    <div class="mt-2"><strong>Created At:</strong> {{ $user->created_at->format('F j, Y g:ia') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('delete-button').addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure you want to delete this user?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form').submit();
                }
            });
        });
    });

</script>

@endsection