<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" data-i18n-app="scheduleSessionTitle">
            Planifier une Séance
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm sm:rounded-lg">
                
                @if($errors->has('conflit'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        {{ $errors->first('conflit') }}
                    </div>
                @endif

                <form action="{{ route('seances.store') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-1" data-i18n-app="groupeLabel">Groupe</label>
                            <select name="groupe_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 text-slate-900 bg-white" required>
                                @foreach($groupes as $g)
                                    <option value="{{ $g->id }}" {{ old('groupe_id') == $g->id ? 'selected' : '' }}>{{ $g->code }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-1" data-i18n-app="formateurLabel">Formateur</label>
                            <select name="formateur_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 text-slate-900 bg-white" required>
                                @foreach($formateurs as $f)
                                    <option value="{{ $f->id }}" {{ old('formateur_id') == $f->id ? 'selected' : '' }}>{{ $f->nom }} {{ $f->prenom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-1" data-i18n-app="salleLabel">Salle</label>
                            <select id="salle_id" name="salle_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 text-slate-900 bg-white">
                                <option value="">-- Aucune salle (A distance) --</option>
                                @foreach($salles as $s)
                                    <option value="{{ $s->id }}" {{ old('salle_id') == $s->id ? 'selected' : '' }}>{{ $s->code }} ({{ $s->type }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-1" data-i18n-app="dayLabel">Jour</label>
                            <select name="jour" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 text-slate-900 bg-white" required>
                                <option value="Lundi" {{ old('jour') === 'Lundi' ? 'selected' : '' }} data-i18n-app="dayMonday">Lundi</option>
                                <option value="Mardi" {{ old('jour') === 'Mardi' ? 'selected' : '' }} data-i18n-app="dayTuesday">Mardi</option>
                                <option value="Mercredi" {{ old('jour') === 'Mercredi' ? 'selected' : '' }} data-i18n-app="dayWednesday">Mercredi</option>
                                <option value="Jeudi" {{ old('jour') === 'Jeudi' ? 'selected' : '' }} data-i18n-app="dayThursday">Jeudi</option>
                                <option value="Vendredi" {{ old('jour') === 'Vendredi' ? 'selected' : '' }} data-i18n-app="dayFriday">Vendredi</option>
                                <option value="Samedi" {{ old('jour') === 'Samedi' ? 'selected' : '' }} data-i18n-app="daySaturday">Samedi</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-1" data-i18n-app="slotDurationLabel">Créneau Horaire (2h30)</label>
                            <select name="creneau" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 text-slate-900 bg-white" required>
                                <option value="S1" {{ old('creneau') === 'S1' ? 'selected' : '' }}>08:30 - 11:00</option>
                                <option value="S2" {{ old('creneau') === 'S2' ? 'selected' : '' }}>11:00 - 13:30</option>
                                <option value="S3" {{ old('creneau') === 'S3' ? 'selected' : '' }}>13:30 - 16:00</option>
                                <option value="S4" {{ old('creneau') === 'S4' ? 'selected' : '' }}>16:00 - 18:30</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-1" data-i18n-app="modeLabel">Mode</label>
                            <select id="mode" name="mode" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 text-slate-900 bg-white" required>
                                <option value="presentiel" {{ old('mode', 'presentiel') === 'presentiel' ? 'selected' : '' }} data-i18n-app="presentielLabel">Presentiel</option>
                                <option value="distance" {{ old('mode') === 'distance' ? 'selected' : '' }} data-i18n-app="distanceLabel">A distance</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-10 flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white font-bold py-3 px-8 rounded-md shadow-lg transition duration-200" data-i18n-app="savePlanningBtn">
                            Enregistrer la Planification
                        </button>
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