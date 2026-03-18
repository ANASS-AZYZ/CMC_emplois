@extends('settings.layout')

@section('settings-content')
    <div class="w-full max-w-md mx-auto bg-white rounded-xl shadow-md p-5 sm:p-8 border border-[var(--app-border)]">
        <h1 class="text-xl sm:text-2xl font-bold mb-6 text-gray-900" data-i18n-app="settingsThemeTitle">Choisir le mode du thème</h1>
        <select id="theme-select" class="px-4 py-3 border border-[var(--app-border)] rounded-xl w-full text-sm" onchange="changeTheme(this.value)">
            <option value="system" data-i18n-app="themeOptionSystem">Système (auto)</option>
            <option value="light" data-i18n-app="themeOptionLight">Clair</option>
            <option value="dark" data-i18n-app="themeOptionDark">Sombre</option>
        </select>
        <p class="mt-4 text-gray-500" data-i18n-app="settingsThemeHelp">Le thème sera appliqué automatiquement selon le système de l'appareil.</p>
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
