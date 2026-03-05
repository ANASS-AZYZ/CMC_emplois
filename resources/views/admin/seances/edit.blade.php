<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight" data-i18n-app="editSessionTitle">Modifier la Séance</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                
                <form action="{{ route('seances.update', $seance) }}" method="POST">
                    @csrf
                    @method('PUT') 

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div>
                            <label class="block font-bold mb-2 text-gray-700" data-i18n-app="groupeLabel">Groupe</label>
                            <select name="groupe_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach($groupes as $g)
                                    <option value="{{ $g->id }}" {{ $seance->groupe_id == $g->id ? 'selected' : '' }}>
                                        {{ $g->code }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-gray-700" data-i18n-app="formateurLabel">Formateur</label>
                            <select name="formateur_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach($formateurs as $f)
                                    <option value="{{ $f->id }}" {{ $seance->formateur_id == $f->id ? 'selected' : '' }}>
                                        {{ $f->nom }} {{ $f->prenom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-gray-700" data-i18n-app="salleLabel">Salle</label>
                            <select name="salle_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach($salles as $s)
                                    <option value="{{ $s->id }}" {{ $seance->salle_id == $s->id ? 'selected' : '' }}>
                                        {{ $s->code }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-gray-700" data-i18n-app="dayLabel">Jour</label>
                            <select name="jour" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach($jours as $j)
                                    @php
                                        $dayMap = [
                                            'Lundi' => 'dayMonday',
                                            'Mardi' => 'dayTuesday',
                                            'Mercredi' => 'dayWednesday',
                                            'Jeudi' => 'dayThursday',
                                            'Vendredi' => 'dayFriday',
                                            'Samedi' => 'daySaturday',
                                        ];
                                        $dayKey = $dayMap[$j] ?? null;
                                    @endphp
                                    <option value="{{ $j }}" {{ $seance->jour == $j ? 'selected' : '' }} @if($dayKey) data-i18n-app="{{ $dayKey }}" @endif>{{ $j }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-gray-700" data-i18n-app="slotLabel">Créneau</label>
                            <select name="creneau" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach($creneaux as $c)
                                    <option value="{{ $c }}" {{ $seance->creneau == $c ? 'selected' : '' }}>{{ $c }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-8 flex items-center gap-4">
                        <button type="submit" class="bg-blue-600 text-white px-10 py-2.5 rounded-lg font-bold transition shadow-md" data-i18n-app="saveChangesBtn">
                            Enregistrer les modifications
                        </button>
                        <a href="{{ route('seances.index') }}" class="text-gray-600" data-i18n-app="cancelBtn">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>