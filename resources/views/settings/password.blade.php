@extends('settings.layout')

@section('settings-content')
<div class="w-full max-w-md mx-auto bg-white rounded-xl shadow-md p-4 sm:p-6 md:p-8 border border-[var(--app-border)]">
    <h1 class="text-xl sm:text-2xl font-bold mb-6 sm:mb-8 text-gray-900 text-center" data-i18n-app="profilePasswordTitle">Changer le mot de passe</h1>

    <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="group">
            <label class="block text-xs font-bold text-gray-700 mb-1 ml-1 uppercase" data-i18n-app="profileCurrentPasswordLabel">Mot de passe actuel</label>
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">
                <input type="password" id="current_password" name="current_password" placeholder="••••••••"
                       class="px-4 py-3 border border-[var(--app-border)] rounded-xl w-full text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                <button type="button" onclick="togglePassword('current_password', this)" 
                        class="w-full sm:w-auto sm:min-w-[96px] px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-bold transition-all whitespace-nowrap" data-i18n-app="showPasswordBtn" data-show-text="Afficher" data-hide-text="Masquer">
                    Afficher
                </button>
            </div>
        </div>

        <div class="group">
            <label class="block text-xs font-bold text-gray-700 mb-1 ml-1 uppercase" data-i18n-app="profileNewPasswordLabel">Nouveau mot de passe</label>
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">
                <input type="password" id="new_password" name="new_password" placeholder="••••••••"
                       class="px-4 py-3 border border-[var(--app-border)] rounded-xl w-full text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                <button type="button" onclick="togglePassword('new_password', this)" 
                        class="w-full sm:w-auto sm:min-w-[96px] px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-bold transition-all whitespace-nowrap" data-i18n-app="showPasswordBtn" data-show-text="Afficher" data-hide-text="Masquer">
                    Afficher
                </button>
            </div>
        </div>

        <div class="group">
            <label class="block text-xs font-bold text-gray-700 mb-1 ml-1 uppercase" data-i18n-app="profileConfirmPasswordLabel">Confirmer le nouveau</label>
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="••••••••"
                       class="px-4 py-3 border border-[var(--app-border)] rounded-xl w-full text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                <button type="button" onclick="togglePassword('new_password_confirmation', this)" 
                        class="w-full sm:w-auto sm:min-w-[96px] px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-bold transition-all whitespace-nowrap" data-i18n-app="showPasswordBtn" data-show-text="Afficher" data-hide-text="Masquer">
                    Afficher
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
    function getToggleLabels() {
        var lang = localStorage.getItem('cmc_lang') || 'fr';
        if (lang === 'ar') {
            return { show: 'اظهار', hide: 'اخفاء' };
        }
        if (lang === 'en') {
            return { show: 'Show', hide: 'Hide' };
        }
        return { show: 'Afficher', hide: 'Masquer' };
    }

    function togglePassword(inputId, btn) {
        var input = document.getElementById(inputId);
        var labels = getToggleLabels();
        if (input.type === 'password') {
            input.type = 'text';
            btn.textContent = labels.hide;
        } else {
            input.type = 'password';
            btn.textContent = labels.show;
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        var labels = getToggleLabels();
        document.querySelectorAll('button[data-i18n-app="showPasswordBtn"]').forEach(function (btn) {
            btn.textContent = labels.show;
        });
    });
</script>
@endsection