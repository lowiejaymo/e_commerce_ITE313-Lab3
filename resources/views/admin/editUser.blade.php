@extends('layouts.app')

@section('content')
<div class="mt-2">
    <a href="{{ route('admin.userInformation', $user->id) }}" class="btn btn-secondary">Back to User Information</a>
</div>

<div class="container my-2">
    <div class="card shadow-lg">
        <div class="card-body">
            <h3 class="mb-0"><strong>Edit User Information</strong></h3>
        </div>
        <div class="d-flex justify-content-center align-items-center p-4">
            <img src="{{ asset('storage/user_profile_pictures/' . $user->profile_picture) }}"
                alt="Profile Picture of {{ $user->name }}" class="img-fluid rounded-circle shadow-lg"
                style="width: 200px; height: 200px; object-fit: cover;">
        </div>
        <div class="row g-0">
            <!-- User Information Form -->
            <div class="col-md-12">
                <div class="card-body p-5">
                    <!-- Form to edit user -->
                    <form action="{{ route('admin.updateUser', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Name Field -->
                        <div class="form-group mb-3">
                            <label for="name" class="form-label"><strong>Name:</strong></label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}"
                                required>
                        </div>

                        <!-- Email Field -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label"><strong>Email:</strong></label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}"
                                required>
                        </div>

                        <!-- Role Field -->
                        <div class="form-group mb-3">
                            <label for="role" class="form-label"><strong>Role:</strong></label>
                            <select name="role_id" id="role" class="form-select" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->userRole && $user->userRole->role_id == $role->id ? 'selected' : '' }}>
                                        {{ $role->role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group d-flex justify-content-center">
                            <button type="submit" class="btn btn-dark me-3">Save Changes</button>
                            <a href="{{ route('admin.userInformation', $user->id) }}"
                                class="btn btn-secondary">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection