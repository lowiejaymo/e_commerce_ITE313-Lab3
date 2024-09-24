@extends('layouts.app')

@section('content')
<div class="container">

    @if (session('added_success'))
        <script>
            Swal.fire({
                title: 'Success!',
                html: '<strong>{{ session("added_success") }}</strong> has been successfully registered.',
                icon: 'success'
            });
        </script>
    @endif

    @if (session('update_success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'User information updated successfully',
                icon: 'success'
            });
        </script>
    @endif

    @if (session('delete_success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'User deleted successfully',
                icon: 'success'
            });
        </script>
    @endif

    <!-- Mobile Toggle for Search -->
    <div class="d-md-none mb-3">
        <button class="btn btn-light w-100" type="button" data-bs-toggle="collapse" data-bs-target="#mobileSearch"
            aria-expanded="false" aria-controls="mobileSearch">
            <i class="bi bi-search-heart"></i> Show Search
        </button>
    </div>

    <!-- Search Form in Desktop View -->
    <div class="d-none d-md-flex justify-content-center mb-4">
        <form action="{{ route('admin.manageUsers') }}" method="GET" class="w-50">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search users..."
                    value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search-heart"></i></button>
            </div>
        </form>
    </div>

    <!-- Collapsible Mobile Search -->
    <div class="collapse mb-4" id="mobileSearch">
        <form action="{{ route('admin.manageUsers') }}" method="GET" class="w-100">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search users..."
                    value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search-heart"></i></button>
            </div>
        </form>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Users</h1>
        <a href="{{ route('admin.addNewUser') }}" class="btn btn-dark">
            <i class="bi bi-plus-square"></i>
            <span class="d-none d-sm-inline"> Create New User</span> <!-- Hidden on small screens -->
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @if (auth()->id() !== $user->id)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('F j, Y g:ia') }}</td>
                            <td>
                                <a href="{{ route('admin.userInformation', $user->id) }}" class="btn btn-success btn-sm"><i class="bi bi-hand-index-thumb"></i>
                                    Select
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>

        </table>

    </div>

</div>

@endsection