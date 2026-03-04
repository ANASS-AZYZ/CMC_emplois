<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800">Planning Global</h2>
            <a href="{{ route('seances.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg font-bold">
                + Planifier une séance
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border">
                <table class="w-full border-collapse">
                    <thead class="bg-gray-50 text-xs font-bold uppercase text-gray-600">
                        <tr>
                            <th class="border p-4">Jour</th>
                            <th class="border p-4">Créneau</th>
                            <th class="border p-4">Groupe</th>
                            <th class="border p-4">Formateur</th>
                            <th class="border p-4">Salle</th>
                            <th class="border p-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($seances as $seance)
                        <tr class="hover:bg-gray-50 transition text-sm">
                            <td class="border p-4">{{ $seance->jour }}</td>
                            <td class="border p-4 font-bold text-blue-600">{{ $seance->creneau }}</td>
                            <td class="border p-4">{{ $seance->groupe->code }}</td>
                            <td class="border p-4">{{ $seance->formateur->nom }}</td>
                            <td class="border p-4 font-bold text-gray-700">{{ $seance->salle->code }}</td>
                            <td class="border p-4 text-center space-x-4">
                                <a href="{{ route('seances.edit', $seance) }}" class="text-indigo-600 hover:underline font-bold">Modifier</a>
                                
                                <form action="{{ route('seances.destroy', $seance) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline font-bold" onclick="return confirm('Annuler ?')">Annuler</button>
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