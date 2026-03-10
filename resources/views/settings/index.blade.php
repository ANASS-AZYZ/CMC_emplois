@extends('settings.layout')

@section('settings-content')
    <div class="rounded-2xl bg-white dark:bg-[var(--app-surface)] border border-gray-100 dark:border-[var(--app-border)] shadow-lg overflow-hidden max-w-2xl">
        <div class="h-1.5 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
        <div class="p-8">
            <h1 class="text-xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">Paramètres</h1>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Choisissez une option dans le menu à gauche pour modifier le thème, le mot de passe ou la langue de l'interface.</p>
        </div>
    </div>
@endsection
