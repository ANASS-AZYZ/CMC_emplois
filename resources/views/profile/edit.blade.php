<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight tracking-tight" data-i18n-app="profilePageTitle">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-[calc(100vh-8rem)] flex flex-col items-center justify-center">
        <div class="max-w-lg w-full mx-auto sm:px-6 px-4">
            @if(auth()->user()->role !== 'admin')
                {{-- Carte profil : style professionnel --}}
                <div class="rounded-2xl bg-white dark:bg-[var(--app-surface)] shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-[var(--app-border)] overflow-hidden">
                    @php
                        $user = auth()->user();
                        $avatarUrl = $user->avatar_url;
                        $firstLetter = $user->name ? mb_strtoupper(mb_substr(trim($user->name), 0, 1)) : 'U';
                    @endphp

                    {{-- Bandeau discret en haut de la carte --}}
                    <div class="h-1.5 bg-gradient-to-r from-blue-500 to-indigo-600"></div>

                    <div class="p-6 sm:p-10">
                    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data" id="profile-form">
                        @csrf
                        @method('patch')

                        {{-- Photo de profil --}}
                        <div class="flex flex-col items-center text-center">
                            <label for="avatar" class="cursor-pointer block relative group focus-within:outline-none">
                                <div class="relative w-32 h-32 sm:w-36 sm:h-36 rounded-full overflow-hidden ring-4 ring-blue-100 dark:ring-blue-900/40 ring-offset-4 ring-offset-white dark:ring-offset-[var(--app-surface)] shadow-inner transition-shadow group-hover:ring-blue-200 dark:group-hover:ring-blue-800/50">
                                    @if ($avatarUrl)
                                        <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" class="absolute inset-0 w-full h-full object-cover object-center max-w-full max-h-full" id="avatar-preview-img" />
                                        <span class="absolute inset-0 flex h-full w-full items-center justify-center rounded-full bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/30 dark:to-indigo-900/30 text-blue-700 dark:text-blue-300 text-4xl font-bold hidden" id="avatar-preview-letter">{{ $firstLetter }}</span>
                                    @else
                                        <span class="absolute inset-0 flex h-full w-full items-center justify-center rounded-full bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/30 dark:to-indigo-900/30 text-blue-700 dark:text-blue-300 text-4xl font-bold" id="avatar-preview-letter">{{ $firstLetter }}</span>
                                        <img src="" alt="" class="absolute inset-0 w-full h-full object-cover object-center max-w-full max-h-full hidden" id="avatar-preview-img" />
                                    @endif
                                </div>
                                <span class="absolute bottom-0 right-0 flex h-10 w-10 items-center justify-center rounded-full bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 shadow-md border-2 border-gray-100 dark:border-gray-700 ring-2 ring-white dark:ring-gray-700" aria-hidden="true">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 13v4a2 2 0 01-2 2H7a2 2 0 01-2-2v-4M14 9v2m0 0v2m0-2v-2m0 2V9" />
                                    </svg>
                                </span>
                                <input type="file" name="avatar" id="avatar" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" class="sr-only" />
                            </label>
                            <p class="mt-3 text-sm text-gray-500 dark:text-gray-400 font-medium" data-i18n-app="profilePhotoHelp">Cliquez pour ajouter ou modifier la photo</p>
                            @if ($avatarUrl)
                                <label class="mt-2 inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 cursor-pointer hover:text-gray-700 dark:hover:text-gray-300 transition-colors">
                                    <input type="checkbox" name="remove_avatar" value="1" class="rounded border-gray-300 text-indigo-600 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-0" />
                                    <span data-i18n-app="profileRemovePhoto">Supprimer la photo</span>
                                </label>
                            @endif
                            @error('avatar')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nom & Email --}}
                        <div class="space-y-5">
                            <div>
                                <x-input-label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5"><span data-i18n-app="profileNameLabel">{{ __('Nom') }}</span></x-input-label>
                                <x-text-input id="name" name="name" type="text" class="mt-0 block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" :value="old('name', $user->name)" required autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <x-input-label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5"><span data-i18n-app="profileEmailLabel">{{ __('Email') }}</span></x-input-label>
                                <x-text-input id="email" name="email" type="email" class="mt-0 block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" :value="old('email', $user->email)" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-1">
                            <x-primary-button class="rounded-lg px-6 py-2.5 font-semibold shadow-sm"><span data-i18n-app="profileSaveBtn">{{ __('Enregistrer') }}</span></x-primary-button>
                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="inline-flex items-center gap-1.5 text-sm font-medium text-green-700 dark:text-green-400 bg-green-50 dark:bg-green-900/20 px-3 py-1.5 rounded-lg">✓ Enregistré.</p>
                            @endif
                        </div>
                    </form>

                    {{-- Mot de passe --}}
                    <div class="mt-10 pt-8 border-t border-gray-200 dark:border-[var(--app-border)]">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 tracking-tight" data-i18n-app="profilePasswordTitle">{{ __('Mot de passe') }}</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400" data-i18n-app="profilePasswordHelp">Modifiez votre mot de passe.</p>
                        <form method="post" action="{{ route('password.update') }}" class="mt-5 space-y-4">
                            @csrf
                            @method('put')
                            <div>
                                <x-input-label for="update_password_current_password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5"><span data-i18n-app="profileCurrentPasswordLabel">{{ __('Mot de passe actuel') }}</span></x-input-label>
                                <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-0 block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:ring-2 focus:ring-indigo-500" autocomplete="current-password" />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="update_password_password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5"><span data-i18n-app="profileNewPasswordLabel">{{ __('Nouveau mot de passe') }}</span></x-input-label>
                                <x-text-input id="update_password_password" name="new_password" type="password" class="mt-0 block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:ring-2 focus:ring-indigo-500" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('new_password')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="update_password_password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5"><span data-i18n-app="profileConfirmPasswordLabel">{{ __('Confirmer le mot de passe') }}</span></x-input-label>
                                <x-text-input id="update_password_password_confirmation" name="new_password_confirmation" type="password" class="mt-0 block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:ring-2 focus:ring-indigo-500" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('new_password_confirmation')" class="mt-2" />
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button class="rounded-lg px-6 py-2.5 font-semibold shadow-sm"><span data-i18n-app="profileSavePasswordBtn">{{ __('Enregistrer le mot de passe') }}</span></x-primary-button>
                                @if (session('status') === 'password-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="inline-flex items-center gap-1.5 text-sm font-medium text-green-700 dark:text-green-400 bg-green-50 dark:bg-green-900/20 px-3 py-1.5 rounded-lg">✓ Mot de passe enregistré.</p>
                                @endif
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            @else
                {{-- Admin : seulement mot de passe --}}
                <div class="rounded-2xl bg-white dark:bg-[var(--app-surface)] shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-[var(--app-border)] overflow-hidden">
                    <div class="h-1.5 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                    <div class="p-6 sm:p-10">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 tracking-tight" data-i18n-app="profilePasswordTitle">{{ __('Mot de passe') }}</h3>
                        <form method="post" action="{{ route('password.update') }}" class="mt-5 space-y-4">
                            @csrf
                            @method('put')
                            <div>
                                <x-input-label for="update_password_current_password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5"><span data-i18n-app="profileCurrentPasswordLabel">{{ __('Mot de passe actuel') }}</span></x-input-label>
                                <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-0 block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:ring-2 focus:ring-indigo-500" autocomplete="current-password" />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="update_password_password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5"><span data-i18n-app="profileNewPasswordLabel">{{ __('Nouveau mot de passe') }}</span></x-input-label>
                                <x-text-input id="update_password_password" name="new_password" type="password" class="mt-0 block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:ring-2 focus:ring-indigo-500" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('new_password')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="update_password_password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5"><span data-i18n-app="profileConfirmPasswordLabel">{{ __('Confirmer le mot de passe') }}</span></x-input-label>
                                <x-text-input id="update_password_password_confirmation" name="new_password_confirmation" type="password" class="mt-0 block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:ring-2 focus:ring-indigo-500" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('new_password_confirmation')" class="mt-2" />
                            </div>
                            <x-primary-button class="rounded-lg px-6 py-2.5 font-semibold shadow-sm"><span data-i18n-app="profileSavePasswordBtn">{{ __('Enregistrer le mot de passe') }}</span></x-primary-button>
                        </form>
                    </div>
                </div>
            @endif

            @if(auth()->user()->role !== 'formateur' && auth()->user()->role !== 'admin')
                <div class="mt-6 rounded-2xl bg-white dark:bg-[var(--app-surface)] shadow-lg border border-gray-100 dark:border-[var(--app-border)] overflow-hidden">
                    @include('profile.partials.delete-user-form')
                </div>
            @endif
        </div>
    </div>

    <script>
        (function () {
            var avatarInput = document.getElementById('avatar');
            var avatarPreviewImg = document.getElementById('avatar-preview-img');
            var avatarPreviewLetter = document.getElementById('avatar-preview-letter');
            var profileForm = document.getElementById('profile-form');

            if (!avatarInput || !avatarPreviewImg || !avatarPreviewLetter) return;

            avatarInput.addEventListener('change', function (e) {
                var file = e.target.files && e.target.files[0];
                if (!file) return;

                var url = URL.createObjectURL(file);
                avatarPreviewImg.src = url;
                avatarPreviewImg.classList.remove('hidden');
                avatarPreviewLetter.classList.add('hidden');

                if (profileForm) {
                    profileForm.submit();
                }
            });
        })();
    </script>
</x-app-layout>
