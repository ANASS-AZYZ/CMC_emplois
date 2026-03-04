<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMC Planning</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-900 text-white flex-shrink-0 shadow-xl">
            <div class="p-6 text-xl font-bold border-b border-slate-800 text-blue-400">
                CMC Planning
            </div>
            <nav class="mt-6 px-4 space-y-4">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 rounded hover:bg-slate-800 transition">
                    Dashboard
                </a>

                <div class="text-xs font-semibold text-gray-500 uppercase px-2 mt-4">Ressources</div>
                <a href="{{ route('groupes.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800">Groupes</a>
                <a href="{{ route('salles.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800">Salles</a>
                <a href="{{ route('formateurs.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800">Formateurs</a>

                <div class="text-xs font-semibold text-gray-500 uppercase px-2 mt-4">Planning</div>
                <a href="{{ route('seances.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800">Gestion Séances</a>
                
                <a href="{{ route('seances.create') }}" class="flex items-center justify-center px-4 py-3 bg-blue-600 rounded-lg font-bold hover:bg-blue-700 transition shadow-lg mt-2">
                    + Ajouter Séance
                </a>
                
                <a href="{{ route('seances.emploi') }}" class="block px-4 py-2 rounded hover:bg-slate-800">Consulter l'Emploi</a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="p-8">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>