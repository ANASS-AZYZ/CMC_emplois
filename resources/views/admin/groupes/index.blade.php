<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Gestion des Groupes</h2>
            <a href="{{ route('groupes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">+ Ajouter un Groupe</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-3">Code Unique</th>
                            <th class="border p-3">Filière</th>
                            <th class="border p-3">Année</th>
                            <th class="border p-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groupes as $groupe)
                        <tr class="hover:bg-gray-50">
                            <td class="border p-3 font-bold text-gray-700">{{ $groupe->code }}</td>
                            <td class="border p-3">{{ $groupe->filiere->nom ?? 'N/A' }}</td>
                            <td class="border p-3">{{ $groupe->annee }}</td>
                            <td class="border p-3 text-center space-x-2">
                                <a href="{{ route('groupes.edit', $groupe) }}" class="text-blue-600 hover:text-blue-900 font-bold">Modifier</a>
                                
                                <form action="{{ route('groupes.destroy', $groupe) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-bold">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>