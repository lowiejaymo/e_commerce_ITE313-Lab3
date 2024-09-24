<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            <strong>{{ __('Update Profile Picture') }}</strong>
        </h2>
    </header>

    <div class="d-flex justify-content-center align-items-center p-4">
        <img src="{{ asset('storage/user_profile_pictures/' . $user->profile_picture) }}"
            alt="Profile Picture of {{ $user->name }}" class="img-fluid rounded-circle shadow-lg"
            style="width: 200px; height: 200px; object-fit: cover;">
    </div>

    <form method="POST" action="{{ route('profile-picture.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="profile_picture" class="form-label">{{ __('Choose a new profile picture') }}</label>
            <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/*" required>
        </div>

        <div class="flex items-center gap-4 mt-4">
            <button type="submit" class="btn btn-dark">{{ __('Update Picture') }}</button>
        </div>
    </form>
</section>
