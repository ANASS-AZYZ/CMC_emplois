<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight tracking-tight" data-i18n-app="profilePageTitle">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-[calc(100vh-8rem)] flex flex-col items-center justify-center">
        <div class="max-w-lg w-full mx-auto sm:px-6 px-4">
            @if(auth()->user()->role !== 'admin')
                <div class="rounded-2xl bg-white dark:bg-[var(--app-surface)] shadow-xl border border-gray-100 dark:border-[var(--app-border)] overflow-hidden">
                    @php
                        $user = auth()->user();
                        $avatarUrl = $user->avatar_url;
                        $firstLetter = $user->name ? mb_strtoupper(mb_substr(trim($user->name), 0, 1)) : 'U';
                    @endphp

                    <div class="h-1.5 bg-gradient-to-r from-blue-500 to-indigo-600"></div>

                    <div class="p-6 sm:p-10">
                        <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data" id="profile-form">
                            @csrf
                            @method('patch')

                            <div class="flex flex-col items-center text-center">
                                <label for="avatar" class="cursor-pointer block relative group focus-within:outline-none">
                                    <div class="relative w-32 h-32 sm:w-36 sm:h-36 rounded-full overflow-hidden ring-4 ring-blue-100 dark:ring-blue-900/40 ring-offset-4 ring-offset-white shadow-inner transition-shadow group-hover:ring-blue-200">
                                        @if ($avatarUrl)
                                            <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" class="absolute inset-0 w-full h-full object-cover" id="avatar-preview-img" onerror="this.classList.add('hidden'); var letter = document.getElementById('avatar-preview-letter'); if (letter) { letter.classList.remove('hidden'); }" />
                                            <span class="absolute inset-0 flex h-full w-full items-center justify-center rounded-full bg-gradient-to-br from-blue-50 to-indigo-50 text-blue-700 text-4xl font-bold hidden" id="avatar-preview-letter">{{ $firstLetter }}</span>
                                        @else
                                            <span class="absolute inset-0 flex h-full w-full items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-white text-4xl font-bold" id="avatar-preview-letter">{{ $firstLetter }}</span>
                                            <img src="" class="absolute inset-0 w-full h-full object-cover hidden" id="avatar-preview-img" />
                                        @endif
                                    </div>
                                    <span class="absolute bottom-0 right-0 flex h-10 w-10 items-center justify-center rounded-full bg-white text-gray-700 shadow-md border-2 border-gray-100 ring-2 ring-white">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </span>
                                    <input type="file" name="avatar" id="avatar" accept="image/*" class="sr-only" />
                                </label>
                                <p class="mt-3 text-sm text-gray-500 font-medium" data-i18n-app="profilePhotoHelp">Cliquez pour modifier la photo</p>
                                @error('avatar')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-5">
                                @if($user->role === 'formateur')
                                    <p class="text-sm text-amber-700 bg-amber-50 border border-amber-200 rounded-lg px-3 py-2" data-i18n-app="profileLockedInfo">
                                        Le nom et l'email sont verrouilles pour le compte formateur.
                                    </p>
                                @endif
                                <div>
                                    <x-input-label for="name" :value="__('Nom')" data-i18n-app="profileNameLabel" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" :readonly="$user->role === 'formateur'" required />
                                </div>
                                <div>
                                    <x-input-label for="email" :value="__('Email')" data-i18n-app="profileEmailLabel" />
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" :readonly="$user->role === 'formateur'" required />
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button data-i18n-app="profileSaveBtn">{{ __('Enregistrer') }}</x-primary-button>
                                @if (session('status') === 'profile-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600">✓ Enregistré.</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.getElementById('avatar').addEventListener('change', function () {
            var file = this.files && this.files[0] ? this.files[0] : null;
            if (!file) return;

            var img = document.getElementById('avatar-preview-img');
            var letter = document.getElementById('avatar-preview-letter');

            if (img) {
                var localUrl = URL.createObjectURL(file);
                img.src = localUrl;
                img.classList.remove('hidden');
            }

            if (letter) {
                letter.classList.add('hidden');
            }

            document.getElementById('profile-form').submit();
        });
    </script>
</x-app-layout>