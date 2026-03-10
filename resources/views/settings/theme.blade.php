@extends('settings.layout')

@section('settings-content')
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md p-8 border border-[var(--app-border)]">
        <h1 class="text-2xl font-bold mb-6 text-gray-900">Choisir le mode du thème</h1>
        <select id="theme-select" class="px-4 py-3 border border-[var(--app-border)] rounded-xl w-full text-sm" onchange="changeTheme(this.value)">
            <option value="system">Système (auto)</option>
            <option value="light">Clair</option>
            <option value="dark">Sombre</option>
        </select>
        <p class="mt-4 text-gray-500">Le thème sera appliqué automatiquement selon le système de l'appareil.</p>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var mode = localStorage.getItem('cmc_theme_mode') || 'system';
            document.getElementById('theme-select').value = mode;
        });
        function changeTheme(mode) {
            localStorage.setItem('cmc_theme_mode', mode);
            location.reload();
        }
    </script>
@endsection
