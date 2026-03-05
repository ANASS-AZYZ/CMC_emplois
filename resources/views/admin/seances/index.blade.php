<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800" data-i18n-app="globalPlanningTitle">Planning Global</h2>
            <a href="{{ route('seances.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg font-bold">
                <span data-i18n-app="scheduleSessionBtn">+ Planifier une séance</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-green-800 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded-lg shadow-sm border">
                <table class="w-full border-collapse">
                    <thead class="bg-gray-50 text-xs font-bold uppercase text-gray-600">
                        <tr>
                            <th class="border p-4" data-i18n-app="dayLabel">Jour</th>
                            <th class="border p-4" data-i18n-app="slotLabel">Créneau</th>
                            <th class="border p-4" data-i18n-app="groupeLabel">Groupe</th>
                            <th class="border p-4" data-i18n-app="formateurLabel">Formateur</th>
                            <th class="border p-4" data-i18n-app="salleLabel">Salle</th>
                            <th class="border p-4 text-center" data-i18n-app="actionsLabel">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($seances as $seance)
                        <tr class="text-sm">
                            <td class="border p-4">{{ $seance->jour }}</td>
                            <td class="border p-4 font-bold text-blue-600">{{ $seance->creneau }}</td>
                            <td class="border p-4">{{ $seance->groupe->code }}</td>
                            <td class="border p-4">{{ $seance->formateur->nom }}</td>
                            <td class="border p-4 font-bold text-gray-700">{{ $seance->salle->code }}</td>
                            <td class="border p-4 text-center">
                                <div class="flex flex-row items-center justify-center gap-2">
                                <a href="{{ route('seances.edit', $seance) }}" class="text-indigo-600 px-3 py-1 rounded-md border border-indigo-600 inline-flex items-center justify-center" aria-label="Modifier" title="Modifier">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.1 2.1 0 1 1 2.97 2.97L8.25 18.04l-4.5 1.125 1.125-4.5 11.987-11.178Z" />
                                    </svg>
                                </a>
                                
                                <form action="{{ route('seances.destroy', $seance) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 px-3 py-1 rounded-md border border-red-600 inline-flex items-center justify-center" data-i18n-confirm="confirmCancelSession" onclick="return confirm(this.dataset.confirmMsg || 'Annuler ?')" aria-label="Annuler" title="Annuler">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0V4.5A2.25 2.25 0 0 0 13.5 2.25h-3A2.25 2.25 0 0 0 8.25 4.5v.893m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>