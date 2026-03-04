<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
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
                            <label class="block font-medium text-sm text-gray-700 mb-1">Groupe</label>
                            <select name="groupe_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500" required>
                                @foreach($groupes as $g)
                                    <option value="{{ $g->id }}">{{ $g->code }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-1">Formateur</label>
                            <select name="formateur_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500" required>
                                @foreach($formateurs as $f)
                                    <option value="{{ $f->id }}">{{ $f->nom }} {{ $f->prenom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-1">Salle</label>
                            <select name="salle_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500" required>
                                @foreach($salles as $s)
                                    <option value="{{ $s->id }}">{{ $s->code }} ({{ $s->type }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-1">Jour</label>
                            <select name="jour" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500" required>
                                <option value="Lundi">Lundi</option>
                                <option value="Mardi">Mardi</option>
                                <option value="Mercredi">Mercredi</option>
                                <option value="Jeudi">Jeudi</option>
                                <option value="Vendredi">Vendredi</option>
                                <option value="Samedi">Samedi</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-1">Créneau Horaire (2h30)</label>
                            <select name="creneau" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500" required>
                                <option value="S1">08:30 - 11:00</option>
                                <option value="S2">11:00 - 13:30</option>
                                <option value="S3">13:30 - 16:00</option>
                                <option value="S4">16:00 - 18:30</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-10 flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-md shadow-lg transition duration-200">
                            Enregistrer la Planification
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>