@extends('settings.layout')

@section('settings-content')
    <div class="w-full max-w-lg rounded-2xl bg-white dark:bg-[var(--app-surface)] border border-gray-100 dark:border-[var(--app-border)] shadow-lg overflow-hidden">
        <div class="h-1.5 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
        <div class="p-6 sm:p-8">
            <h1 class="text-xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">Changer le mot de passe</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Modifiez votre mot de passe en toute sécurité.</p>

            <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Mot de passe actuel</label>
                    <div class="relative flex items-stretch">
                        <input type="password" id="current_password" name="current_password" placeholder="••••••••"
                               class="w-full rounded-lg rounded-r-none border border-gray-300 dark:border-gray-600 border-r-0 bg-white dark:bg-[var(--app-surface-soft)] text-gray-900 dark:text-gray-100 px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                               required autocomplete="current-password">
                        <button type="button" onclick="togglePassword('current_password', this)" class="rounded-r-lg border border-l-0 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-[var(--app-surface-soft)] text-blue-600 dark:text-blue-400 px-4 py-2.5 text-sm font-semibold whitespace-nowrap hover:bg-gray-100 dark:hover:bg-gray-700/50 transition">Afficher</button>
                    </div>
                    @if(isset($errors->updatePassword) && $errors->updatePassword->get('current_password'))
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $errors->updatePassword->first('current_password') }}</p>
                    @endif
                </div>

                <div>
                    <label for="new_password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Nouveau mot de passe</label>
                    <div class="relative flex items-stretch">
                        <input type="password" id="new_password" name="new_password" placeholder="••••••••"
                               class="w-full rounded-lg rounded-r-none border border-gray-300 dark:border-gray-600 border-r-0 bg-white dark:bg-[var(--app-surface-soft)] text-gray-900 dark:text-gray-100 px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                               required autocomplete="new-password">
                        <button type="button" onclick="togglePassword('new_password', this)" class="rounded-r-lg border border-l-0 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-[var(--app-surface-soft)] text-blue-600 dark:text-blue-400 px-4 py-2.5 text-sm font-semibold whitespace-nowrap hover:bg-gray-100 dark:hover:bg-gray-700/50 transition">Afficher</button>
                    </div>
                    @if(isset($errors->updatePassword) && $errors->updatePassword->get('new_password'))
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $errors->updatePassword->first('new_password') }}</p>
                    @endif
                </div>

                <div>
                    <label for="new_password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Confirmer le nouveau mot de passe</label>
                    <div class="relative flex items-stretch">
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="••••••••"
                               class="w-full rounded-lg rounded-r-none border border-gray-300 dark:border-gray-600 border-r-0 bg-white dark:bg-[var(--app-surface-soft)] text-gray-900 dark:text-gray-100 px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                               required autocomplete="new-password">
                        <button type="button" onclick="togglePassword('new_password_confirmation', this)" class="rounded-r-lg border border-l-0 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-[var(--app-surface-soft)] text-blue-600 dark:text-blue-400 px-4 py-2.5 text-sm font-semibold whitespace-nowrap hover:bg-gray-100 dark:hover:bg-gray-700/50 transition">Afficher</button>
                    </div>
                    @if(isset($errors->updatePassword) && $errors->updatePassword->get('new_password_confirmation'))
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $errors->updatePassword->first('new_password_confirmation') }}</p>
                    @endif
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-sm transition">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function togglePassword(inputId, btn) {
            var input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                if (btn) btn.textContent = 'Masquer';
            } else {
                input.type = 'password';
                if (btn) btn.textContent = 'Afficher';
            }
        }
    </script>
@endsection
