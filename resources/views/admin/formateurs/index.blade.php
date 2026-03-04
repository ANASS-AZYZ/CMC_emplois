<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl">Gestion des Formateurs</h2>
            <a href="{{ route('formateurs.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg font-bold">
                + Nouveau Formateur
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 uppercase text-xs font-bold text-gray-600">
                        <tr>
                            <th class="p-4 border">Matricule</th>
                            <th class="p-4 border">Nom Complet</th>
                            <th class="p-4 border">Email</th>
                            <th class="p-4 border">Spécialité</th>
                            <th class="p-4 border text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($formateurs as $formateur)
                        <tr class="hover:bg-gray-50 transition text-sm">
                            <td class="p-4 border font-bold">{{ $formateur->matricule }}</td>
                            <td class="p-4 border uppercase">{{ $formateur->nom }} {{ $formateur->prenom }}</td>
                            <td class="p-4 border">{{ $formateur->email_professionnel }}</td>
                            <td class="p-4 border">{{ $formateur->specialite }}</td>
                            <td class="p-4 border text-center space-x-3">
                                <a href="{{ route('formateurs.edit', $formateur) }}" class="text-indigo-600 font-bold">Modifier</a>
                                <form action="{{ route('formateurs.destroy', $formateur) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 font-bold" onclick="return confirm('Supprimer?')">Supprimer</button>
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