<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl" data-i18n-app="manageTrainersTitle">Gestion des Formateurs</h2>
            <a href="{{ route('formateurs.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg font-bold">
                <span data-i18n-app="newTrainerBtn">+ Nouveau Formateur</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 uppercase text-xs font-bold text-gray-600">
                        <tr>
                            <th class="p-4 border" data-i18n-app="matriculeLabel">Matricule</th>
                            <th class="p-4 border" data-i18n-app="fullNameLabel">Nom Complet</th>
                            <th class="p-4 border" data-i18n-app="emailLabel">Email</th>
                            <th class="p-4 border" data-i18n-app="specialityLabel">Spécialité</th>
                            <th class="p-4 border text-center" data-i18n-app="actionsLabel">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($formateurs as $formateur)
                        <tr class="text-sm">
                            <td class="p-4 border font-bold">{{ $formateur->matricule }}</td>
                            <td class="p-4 border uppercase">{{ $formateur->nom }} {{ $formateur->prenom }}</td>
                            <td class="p-4 border">{{ $formateur->email_professionnel }}</td>
                            <td class="p-4 border">{{ $formateur->specialite }}</td>
                            <td class="p-4 border text-center">
                                <div class="flex flex-row items-center justify-center gap-2">
                                <a href="{{ route('formateurs.edit', $formateur) }}" class="text-indigo-600 px-3 py-1 rounded-md border border-indigo-600 inline-flex items-center justify-center" aria-label="Modifier" title="Modifier">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.1 2.1 0 1 1 2.97 2.97L8.25 18.04l-4.5 1.125 1.125-4.5 11.987-11.178Z" />
                                    </svg>
                                </a>
                                <form action="{{ route('formateurs.destroy', $formateur) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 px-3 py-1 rounded-md border border-red-600 inline-flex items-center justify-center" data-i18n-confirm="confirmDeleteGeneric" onclick="return confirm(this.dataset.confirmMsg || 'Supprimer?')" aria-label="Supprimer" title="Supprimer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0V4.5A2.25 2.25 0 0 0 13.5 2.25h-3A2.25 2.25 0 0 0 8.25 4.5v.893m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>