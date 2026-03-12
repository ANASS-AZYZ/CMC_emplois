<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label :value="__('Photo de profil')" />
            <div class="mt-2 flex items-center gap-4">
                @php
                    $avatarUrl = $user->avatar_url;
                    $firstLetter = $user->name ? mb_strtoupper(mb_substr(trim($user->name), 0, 1)) : 'U';
                @endphp
                @if ($avatarUrl)
                    <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" class="h-16 w-16 rounded-full object-cover border-2 border-gray-200 shadow-sm" id="avatar-preview-img" />
                    <span class="flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 border-2 border-blue-200 text-blue-800 text-xl font-bold shadow-sm hidden" id="avatar-preview-letter">{{ $firstLetter }}</span>
                @else
                    <span class="flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 border-2 border-blue-200 text-blue-800 text-xl font-bold shadow-sm" id="avatar-preview-letter">{{ $firstLetter }}</span>
                    <img src="" alt="" class="h-16 w-16 rounded-full object-cover border-2 border-gray-200 shadow-sm hidden" id="avatar-preview-img" />
                @endif
                <div class="flex flex-col gap-2">
                    <input type="file" name="avatar" id="avatar" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-md file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100" />
                    @if ($avatarUrl)
                        <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                            <input type="checkbox" name="remove_avatar" value="1" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                            {{ __('Supprimer la photo') }}
                        </label>
                    @endif
                </div>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
    <script>
        document.getElementById('avatar')?.addEventListener('change', function (e) {
            var file = e.target.files?.[0];
            var img = document.getElementById('avatar-preview-img');
            var letter = document.getElementById('avatar-preview-letter');
            if (!file || !img || !letter) return;
            var url = URL.createObjectURL(file);
            img.src = url;
            img.classList.remove('hidden');
            letter.classList.add('hidden');
        });
    </script>
</section>
