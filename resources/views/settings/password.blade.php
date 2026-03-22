@extends('settings.layout')

@section('settings-content')
<div class="w-full max-w-md mx-auto bg-white rounded-xl shadow-md p-4 sm:p-6 md:p-8 border border-[var(--app-border)]">
    <h1 class="text-xl sm:text-2xl font-bold mb-6 sm:mb-8 text-gray-900 text-center" data-i18n-app="profilePasswordTitle">Changer le mot de passe</h1>

    <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="group">
            <label class="block text-xs font-bold text-gray-700 mb-1 ml-1 uppercase" data-i18n-app="profileCurrentPasswordLabel">Mot de passe actuel</label>
            <div class="relative">
                <input type="password" id="current_password" name="current_password" placeholder="••••••••"
                       class="px-4 pr-12 py-3 border border-[var(--app-border)] rounded-xl w-full text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                <button type="button" onclick="togglePassword('current_password', this)"
                        class="absolute inset-y-0 right-0 px-4 text-gray-600 hover:text-gray-900 transition-colors"
                        aria-label="Afficher ou masquer le mot de passe">
                    <svg class="h-5 w-5 eye-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12S5.25 6.75 12 6.75 21.75 12 21.75 12 18.75 17.25 12 17.25 2.25 12 2.25 12Z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    <svg class="h-5 w-5 eye-closed hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.58 10.58a2 2 0 1 0 2.84 2.84" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 5.09A10.94 10.94 0 0 1 12 4.88c6.75 0 9.75 5.25 9.75 5.25a16.7 16.7 0 0 1-3.23 3.98M6.6 6.6A16.3 16.3 0 0 0 2.25 12s3 5.25 9.75 5.25c1.86 0 3.43-.4 4.75-1" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="group">
            <label class="block text-xs font-bold text-gray-700 mb-1 ml-1 uppercase" data-i18n-app="profileNewPasswordLabel">Nouveau mot de passe</label>
            <div class="relative">
                <input type="password" id="new_password" name="new_password" placeholder="••••••••"
                       class="px-4 pr-12 py-3 border border-[var(--app-border)] rounded-xl w-full text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                <button type="button" onclick="togglePassword('new_password', this)"
                        class="absolute inset-y-0 right-0 px-4 text-gray-600 hover:text-gray-900 transition-colors"
                        aria-label="Afficher ou masquer le mot de passe">
                    <svg class="h-5 w-5 eye-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12S5.25 6.75 12 6.75 21.75 12 21.75 12 18.75 17.25 12 17.25 2.25 12 2.25 12Z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    <svg class="h-5 w-5 eye-closed hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.58 10.58a2 2 0 1 0 2.84 2.84" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 5.09A10.94 10.94 0 0 1 12 4.88c6.75 0 9.75 5.25 9.75 5.25a16.7 16.7 0 0 1-3.23 3.98M6.6 6.6A16.3 16.3 0 0 0 2.25 12s3 5.25 9.75 5.25c1.86 0 3.43-.4 4.75-1" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="group">
            <label class="block text-xs font-bold text-gray-700 mb-1 ml-1 uppercase" data-i18n-app="profileConfirmPasswordLabel">Confirmer le nouveau</label>
            <div class="relative">
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="••••••••"
                       class="px-4 pr-12 py-3 border border-[var(--app-border)] rounded-xl w-full text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                <button type="button" onclick="togglePassword('new_password_confirmation', this)"
                        class="absolute inset-y-0 right-0 px-4 text-gray-600 hover:text-gray-900 transition-colors"
                        aria-label="Afficher ou masquer le mot de passe">
                    <svg class="h-5 w-5 eye-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12S5.25 6.75 12 6.75 21.75 12 21.75 12 18.75 17.25 12 17.25 2.25 12 2.25 12Z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    <svg class="h-5 w-5 eye-closed hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.58 10.58a2 2 0 1 0 2.84 2.84" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 5.09A10.94 10.94 0 0 1 12 4.88c6.75 0 9.75 5.25 9.75 5.25a16.7 16.7 0 0 1-3.23 3.98M6.6 6.6A16.3 16.3 0 0 0 2.25 12s3 5.25 9.75 5.25c1.86 0 3.43-.4 4.75-1" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="pt-4">
            <button type="submit"
                    class="px-6 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow-lg shadow-blue-100 text-sm font-bold w-full transition-all active:scale-[0.98]" data-i18n-app="saveChangesBtn">
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>

<script>
    function togglePassword(inputId, btn) {
        var input = document.getElementById(inputId);
        if (!input) return;

        var openIcon = btn.querySelector('.eye-open');
        var closedIcon = btn.querySelector('.eye-closed');

        if (input.type === 'password') {
            input.type = 'text';
            if (openIcon) openIcon.classList.add('hidden');
            if (closedIcon) closedIcon.classList.remove('hidden');
        } else {
            input.type = 'password';
            if (openIcon) openIcon.classList.remove('hidden');
            if (closedIcon) closedIcon.classList.add('hidden');
        }
    }
</script>
@endsection