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
                            <th class="border p-4" data-i18n-app="modeLabel">Mode</th>
                            <th class="border p-4" data-i18n-app="presenceLabel">Presence</th>
                            <th class="border p-4 text-center" data-i18n-app="actionsLabel">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($seances as $seance)
                        <tr class="text-sm">
                            <td class="border p-4">{{ $seance->jour }}</td>
                            <td class="border p-4 font-bold text-blue-600">{{ $seance->creneau }}</td>
                            <td class="border p-4">{{ $seance->groupe->code ?? ($groupCodesById[$seance->groupe_id] ?? 'N/A') }}</td>
                            <td class="border p-4">{{ $seance->formateur->nom }}</td>
                            <td class="border p-4 font-bold text-gray-700">{{ $seance->salle->code ?? 'N/A' }}</td>
                            <td class="border p-4">
                                @if(($seance->mode ?? 'presentiel') === 'distance')
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold bg-slate-700 text-white" data-i18n-app="distanceLabel">A distance</span>
                                @else
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold bg-emerald-600 text-white" data-i18n-app="presentielLabel">Presentiel</span>
                                @endif
                            </td>
                            <td class="border p-4">
                                @if(($seance->formateur_present ?? true))
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold bg-blue-600 text-white" data-i18n-app="presentLabel">Present</span>
                                @else
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold bg-red-600 text-white" data-i18n-app="absentLabel">Absent</span>
                                @endif
                            </td>
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

                                <form action="{{ route('seances.toggle-absence', $seance) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="px-3 py-1 rounded-md border inline-flex items-center justify-center {{ ($seance->formateur_present ?? true) ? 'text-amber-600 border-amber-600' : 'text-green-600 border-green-600' }}"
                                            title="{{ ($seance->formateur_present ?? true) ? 'Notification absence' : 'Notification retour present' }}"
                                            aria-label="{{ ($seance->formateur_present ?? true) ? 'Notification absence' : 'Notification retour present' }}">
                                        @if(($seance->formateur_present ?? true))
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022 23.848 23.848 0 0 0 5.454 1.31m5.715 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0m10.607-11.675-15 15" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 1 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022 23.848 23.848 0 0 0 5.454 1.31m5.715 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0m9.607-10.675-4.5 4.5-2.25-2.25" />
                                            </svg>
                                        @endif
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