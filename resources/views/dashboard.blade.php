<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            Tableau de Bord - CMC SportBooking
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 border-l-4 border-blue-600">
                    <p class="text-xs font-bold text-gray-500 uppercase">Formateurs</p>
                    <p class="text-3xl font-black text-gray-900">{{ $stats['formateurs'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 border-l-4 border-green-600">
                    <p class="text-xs font-bold text-gray-500 uppercase">Salles</p>
                    <p class="text-3xl font-black text-gray-900">{{ $stats['salles'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 border-l-4 border-purple-600">
                    <p class="text-xs font-bold text-gray-500 uppercase">Groupes</p>
                    <p class="text-3xl font-black text-gray-900">{{ $stats['groupes'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 border-l-4 border-orange-600">
                    <p class="text-xs font-bold text-gray-500 uppercase">Séances</p>
                    <p class="text-3xl font-black text-gray-900">{{ $stats['seances'] }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-8 text-gray-900">
                    <h3 class="text-lg font-bold mb-2">Bienvenue, {{ Auth::user()->name }} !</h3>
                    <p class="text-gray-600 text-sm">Vous êtes dans l'espace d'administration du planning CMC.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>