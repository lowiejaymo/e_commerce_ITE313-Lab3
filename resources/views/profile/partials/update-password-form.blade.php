<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100"><Strong>{{ __('Update Password') }}</Strong>
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form id="passwordUpdateForm" method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')


        <div>
            <label for="update_password_current_password" class="form-label">{{__('Current Password')}}</label>
            <input id="update_password_current_password" name="current_password" type="password"
                class="form-control shadow-sm mt-1 block w-50" autocomplete="current-password" />
            @error('current_password', 'updatePassword')
                <div class="text-danger">{{ $message}}</div>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="form-label">{{__('New Password')}}</label>
            <input id="update_password_password" name="password" type="password"
                class="form-control shadow-sm mt-1 block w-50" autocomplete="new-password" />
            @error('password', 'updatePassword')
                <div class="text-danger">{{ $message}}</div>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="form-label">{{__('Confirm Password')}}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="form-control shadow-sm mt-1 block w-50" autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword')
                <div class="text-danger">{{ $message}}</div>
            @enderror
        </div>

        <div class="flex items-center gap-4 mt-4">
            <button type="submit" id="saveButton" class="btn btn-dark">
                {{ __('Save') }}
            </button>
        </div>
    </form>

    @if (session('status') === 'password-updated')
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'Password updated successfully',
                icon: 'success'
            });
        </script>
    @endif

    <script>
        document.getElementById('saveButton').addEventListener('click', function (event) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to change your password?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('passwordUpdateForm').submit();
                }
            });
        });
    </script>
</section>