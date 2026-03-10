@extends('settings.layout')

@section('settings-content')
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md p-8 border border-[var(--app-border)]">
        <h1 class="text-2xl font-bold mb-6 text-gray-900">Changer la langue</h1>
        <select id="lang-select" class="px-4 py-3 border border-[var(--app-border)] rounded-xl w-full text-sm" onchange="changeLang(this.value)">
            <option value="fr">Français</option>
            <option value="ar">العربية</option>
            <option value="en">English</option>
        </select>
        <p class="mt-4 text-gray-500">La langue sera appliquée automatiquement.</p>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var lang = localStorage.getItem('cmc_lang') || 'fr';
            document.getElementById('lang-select').value = lang;
        });
        function changeLang(lang) {
            localStorage.setItem('cmc_lang', lang);
            location.reload();
        }
    </script>
@endsection
