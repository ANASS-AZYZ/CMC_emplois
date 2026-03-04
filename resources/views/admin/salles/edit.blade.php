<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            Modifier la Salle : {{ $salle->code }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <form action="{{ route('salles.update', $salle->id) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block font-bold mb-2 text-gray-700">Code</label>
                            <input type="text" name="code" value="{{ old('code', $salle->code) }}" 
                                   class="w-full border-gray-300 rounded-md focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-gray-700">Type</label>
                            <select name="type" class="w-full border-gray-300 rounded-md focus:ring-blue-500">
                                <option value="SC" {{ $salle->type == 'SC' ? 'selected' : '' }}>Salle de cours (SC)</option>
                                <option value="SM" {{ $salle->type == 'SM' ? 'selected' : '' }}>Salle Multimédia (SM)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-gray-700">Capacité</label>
                            <input type="number" name="capacite" value="{{ old('capacite', $salle->capacite) }}" 
                                   class="w-full border-gray-300 rounded-md focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-8 py-2 rounded-lg font-bold hover:bg-blue-700 transition shadow-md">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>