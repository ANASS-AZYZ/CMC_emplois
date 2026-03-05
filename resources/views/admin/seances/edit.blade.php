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
                            <select name="groupe_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-slate-900 bg-white">
                                @foreach($groupes as $g)
                                    <option value="{{ $g->id }}" {{ old('groupe_id', $seance->groupe_id) == $g->id ? 'selected' : '' }}>
                                        {{ $g->code }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-gray-700" data-i18n-app="formateurLabel">Formateur</label>
                            <select name="formateur_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-slate-900 bg-white">
                                @foreach($formateurs as $f)
                                    <option value="{{ $f->id }}" {{ old('formateur_id', $seance->formateur_id) == $f->id ? 'selected' : '' }}>
                                        {{ $f->nom }} {{ $f->prenom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-gray-700" data-i18n-app="salleLabel">Salle</label>
                            <select id="salle_id" name="salle_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-slate-900 bg-white">
                                <option value="">-- Aucune salle (A distance) --</option>
                                @foreach($salles as $s)
                                    <option value="{{ $s->id }}" {{ old('salle_id', $seance->salle_id) == $s->id ? 'selected' : '' }}>
                                        {{ $s->code }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-gray-700" data-i18n-app="dayLabel">Jour</label>
                            <select name="jour" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-slate-900 bg-white">
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
                                    <option value="{{ $j }}" {{ old('jour', $seance->jour) == $j ? 'selected' : '' }} @if($dayKey) data-i18n-app="{{ $dayKey }}" @endif>{{ $j }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-gray-700" data-i18n-app="slotLabel">Créneau</label>
                            <select name="creneau" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-slate-900 bg-white">
                                @foreach($creneaux as $c)
                                    <option value="{{ $c }}" {{ old('creneau', $seance->creneau) == $c ? 'selected' : '' }}>{{ $c }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-gray-700" data-i18n-app="modeLabel">Mode</label>
                            <select id="mode" name="mode" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-slate-900 bg-white">
                                <option value="presentiel" {{ old('mode', ($seance->mode ?? 'presentiel')) === 'presentiel' ? 'selected' : '' }} data-i18n-app="presentielLabel">Presentiel</option>
                                <option value="distance" {{ old('mode', ($seance->mode ?? 'presentiel')) === 'distance' ? 'selected' : '' }} data-i18n-app="distanceLabel">A distance</option>
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

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const modeEl = document.getElementById('mode');
                        const salleEl = document.getElementById('salle_id');
                        if (!modeEl || !salleEl) return;

                        const syncSalleState = () => {
                            const distance = modeEl.value === 'distance';
                            salleEl.required = !distance;
                            if (distance) {
                                salleEl.value = '';
                            }
                        };

                        modeEl.addEventListener('change', syncSalleState);
                        syncSalleState();
                    });
                </script>
            </div>
        </div>
    </div>
</x-app-layout>