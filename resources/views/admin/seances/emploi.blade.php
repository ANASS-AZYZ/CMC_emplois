<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Consultation de l'Emploi du Temps
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="GET" action="{{ route('seances.emploi') }}" class="mb-8 flex items-end gap-4">
                    <div class="w-1/3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Choisir un Groupe :</label>
                        <select name="groupe_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach($groupes as $g)
                                <option value="{{ $g->id }}" {{ $selectedGroupe == $g->id ? 'selected' : '' }}>
                                    {{ $g->code }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition duration-200 shadow">
                        Afficher l'emploi
                    </button>
                </form>

                @if($selectedGroupe)
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300 rounded-lg">
                        <thead>
                            <tr class="bg-blue-600 text-white">
                                <th class="border border-blue-700 p-4 w-32">Jour / Séance</th>
                                <th class="border border-blue-700 p-4">S1 <br><span class="text-xs font-normal">08:30 - 11:00</span></th>
                                <th class="border border-blue-700 p-4">S2 <br><span class="text-xs font-normal">11:00 - 13:30</span></th>
                                <th class="border border-blue-700 p-4">S3 <br><span class="text-xs font-normal">13:30 - 16:00</span></th>
                                <th class="border border-blue-700 p-4">S4 <br><span class="text-xs font-normal">16:00 - 18:30</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jours as $jour)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="border border-gray-300 p-4 font-bold bg-gray-100 text-gray-700 text-center">
                                    {{ $jour }}
                                </td>

                                @foreach($creneaux as $creneau)
                                <td class="border border-gray-300 p-2 text-center align-top min-h-[100px] w-1/4">
                                    @if(isset($emploi[$jour][$creneau]))
                                        <div class="bg-blue-50 border-l-4 border-blue-500 p-3 rounded shadow-sm text-left">
                                            <p class="font-bold text-blue-900 text-sm mb-1 uppercase">
                                                {{ $emploi[$jour][$creneau]->formateur->nom }} {{ $emploi[$jour][$creneau]->formateur->prenom }}
                                            </p>
                                            <div class="flex justify-between items-center mt-2">
                                                <span class="bg-blue-200 text-blue-800 text-[10px] px-2 py-1 rounded font-bold uppercase">
                                                    {{ $emploi[$jour][$creneau]->salle->code }}
                                                </span>
                                                <span class="text-[10px] text-gray-500 italic">
                                                    {{ $emploi[$jour][$creneau]->salle->type }}
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="py-8">
                                            <span class="text-gray-200 font-light text-xl">---</span>
                                        </div>
                                    @endif
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="text-center py-10 border-2 border-dashed border-gray-200 rounded-lg">
                        <p class="text-gray-400">Veuillez sélectionner un groupe pour afficher son emploi du temps.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>