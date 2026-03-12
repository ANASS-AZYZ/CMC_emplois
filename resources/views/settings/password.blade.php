@extends('settings.layout')

@section('settings-content')
<div class="mx-auto bg-white rounded-xl shadow-md p-4 md:p-8 border border-[var(--app-border)]" style="width: 400px; max-width: 95%;">
    <h1 class="text-2xl font-bold mb-8 text-gray-900 text-center">Changer le mot de passe</h1>

    <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="group">
            <label class="block text-xs font-bold text-gray-700 mb-1 ml-1 uppercase">Mot de passe actuel</label>
            <div class="flex items-center">
                <input type="password" id="current_password" name="current_password" placeholder="••••••••"
                       class="px-4 py-3 border border-[var(--app-border)] rounded-xl w-full text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                <button type="button" onclick="togglePassword('current_password', this)" 
                        class="ml-3 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-bold transition-all whitespace-nowrap">
                    Afficher
                </button>
            </div>
        </div>

        <div class="group">
            <label class="block text-xs font-bold text-gray-700 mb-1 ml-1 uppercase">Nouveau mot de passe</label>
            <div class="flex items-center">
                <input type="password" id="new_password" name="new_password" placeholder="••••••••"
                       class="px-4 py-3 border border-[var(--app-border)] rounded-xl w-full text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                <button type="button" onclick="togglePassword('new_password', this)" 
                        class="ml-3 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-bold transition-all whitespace-nowrap">
                    Afficher
                </button>
            </div>
        </div>

        <div class="group">
            <label class="block text-xs font-bold text-gray-700 mb-1 ml-1 uppercase">Confirmer le nouveau</label>
            <div class="flex items-center">
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="••••••••"
                       class="px-4 py-3 border border-[var(--app-border)] rounded-xl w-full text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                <button type="button" onclick="togglePassword('new_password_confirmation', this)" 
                        class="ml-3 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-bold transition-all whitespace-nowrap">
                    Afficher
                </button>
            </div>
        </div>

        <div class="pt-4">
            <button type="submit"
                    class="px-6 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow-lg shadow-blue-100 text-sm font-bold w-full transition-all active:scale-[0.98]">
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>

<script>
    function togglePassword(inputId, btn) {
        var input = document.getElementById(inputId);
        if (input.type === 'password') {
            input.type = 'text';
            btn.textContent = 'Masquer';
        } else {
            input.type = 'password';
            btn.textContent = 'Afficher';
        }
    }
</script>
@endsection