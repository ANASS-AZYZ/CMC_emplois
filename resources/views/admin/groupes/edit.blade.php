<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"><span data-i18n-app="editGroupTitle">Modifier le Groupe :</span> {{ $groupe->code }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg border border-gray-200">
                <form action="{{ route('groupes.update', $groupe) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block font-bold mb-2" data-i18n-app="groupCodeExampleLabel">Code du Groupe (ex: DEVOWFS202)</label>
                            <input type="text" name="code" value="{{ $groupe->code }}" class="w-full border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label class="block font-bold mb-2" data-i18n-app="filiereLabel">Filière</label>
                            <select name="filiere_id" class="w-full border-gray-300 rounded-md">
                                @foreach($filieres as $filiere)
                                    <option value="{{ $filiere->id }}" {{ $groupe->filiere_id == $filiere->id ? 'selected' : '' }}>
                                        {{ $filiere->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold mb-2" data-i18n-app="yearLabel">Année</label>
                            <select name="annee" class="w-full border-gray-300 rounded-md">
                                <option value="1ère" {{ in_array((string) old('annee', $groupe->annee), ['1', '1ère'], true) ? 'selected' : '' }} data-i18n-app="firstYearLabel">1ère Année</option>
                                <option value="2ème" {{ in_array((string) old('annee', $groupe->annee), ['2', '2ème'], true) ? 'selected' : '' }} data-i18n-app="secondYearLabel">2ème Année</option>
                            </select>
                        </div>

                        <div class="flex items-center space-x-4 mt-4">
                            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md font-bold" data-i18n-app="saveBtn">
                                Enregistrer
                            </button>
                            <a href="{{ route('groupes.index') }}" class="text-gray-600" data-i18n-app="cancelBtn">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>