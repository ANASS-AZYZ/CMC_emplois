<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">Modifier la Séance</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                
                <form action="{{ route('seances.update', $seance) }}" method="POST">
                    @csrf
                    @method('PUT') 

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div>
                            <label class="block font-bold mb-2 text-gray-700">Groupe</label>
                            <select name="groupe_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach($groupes as $g)
                                    <option value="{{ $g->id }}" {{ $seance->groupe_id == $g->id ? 'selected' : '' }}>
                                        {{ $g->code }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-gray-700">Formateur</label>
                            <select name="formateur_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach($formateurs as $f)
                                    <option value="{{ $f->id }}" {{ $seance->formateur_id == $f->id ? 'selected' : '' }}>
                                        {{ $f->nom }} {{ $f->prenom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-gray-700">Salle</label>
                            <select name="salle_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach($salles as $s)
                                    <option value="{{ $s->id }}" {{ $seance->salle_id == $s->id ? 'selected' : '' }}>
                                        {{ $s->code }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-gray-700">Jour</label>
                            <select name="jour" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach($jours as $j)
                                    <option value="{{ $j }}" {{ $seance->jour == $j ? 'selected' : '' }}>{{ $j }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-gray-700">Créneau</label>
                            <select name="creneau" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach($creneaux as $c)
                                    <option value="{{ $c }}" {{ $seance->creneau == $c ? 'selected' : '' }}>{{ $c }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-8 flex items-center gap-4">
                        <button type="submit" class="bg-blue-600 text-white px-10 py-2.5 rounded-lg font-bold hover:bg-blue-700 transition shadow-md">
                            Enregistrer les modifications
                        </button>
                        <a href="{{ route('seances.index') }}" class="text-gray-600 hover:underline">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>