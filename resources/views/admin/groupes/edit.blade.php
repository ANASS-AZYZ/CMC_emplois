<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Modifier le Groupe: {{ $groupe->code }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg border border-gray-200">
                <form action="{{ route('groupes.update', $groupe) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block font-bold mb-2">Code du Groupe (ex: DEVOWFS202)</label>
                            <input type="text" name="code" value="{{ $groupe->code }}" class="w-full border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label class="block font-bold mb-2">Filière</label>
                            <select name="filiere_id" class="w-full border-gray-300 rounded-md">
                                @foreach($filieres as $filiere)
                                    <option value="{{ $filiere->id }}" {{ $groupe->filiere_id == $filiere->id ? 'selected' : '' }}>
                                        {{ $filiere->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold mb-2">Année</label>
                            <select name="annee" class="w-full border-gray-300 rounded-md">
                                <option value="1" {{ $groupe->annee == 1 ? 'selected' : '' }}>1ère Année</option>
                                <option value="2" {{ $groupe->annee == 2 ? 'selected' : '' }}>2ème Année</option>
                            </select>
                        </div>

                        <div class="flex items-center space-x-4 mt-4">
                            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 font-bold">
                                Enregistrer
                            </button>
                            <a href="{{ route('groupes.index') }}" class="text-gray-600 hover:underline">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>