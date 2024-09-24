<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100"><Strong> {{ __('Profile Information') }}</Strong>
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="form-label">{{__('Name')}}</label>
            <input id="name" name="name" type="text" class="form-control shadow-sm mt-1 block w-50"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <span class="text-sm text-red-600 mt-2">{{ $message }}</span>
            @enderror

        </div>

        <div>
            <label for="email" class="form-label">{{__('Email')}}</label>
            <input id="email" name="email" type="text" class="form-control shadow-sm mt-1 block w-50"
                value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <span class="text-sm text-red-600 mt-2">{{ $message }}</span>
            @enderror


            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 mt-4">
            <button type="submit" class="btn btn-dark">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <script>
                    Swal.fire({
                        title: 'Success!',
                        text: 'Profile information updated successfully',
                        icon: 'success'
                    });
                </script>
            @endif
        </div>
    </form>
</section>