<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">Ajouter un Nouveau Formateur</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <form action="{{ route('formateurs.store') }}" method="POST">
                    @csrf <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-bold mb-2">Matricule</label>
                            <input type="text" name="matricule" class="w-full border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label class="block font-bold mb-2">Spécialité</label>
                            <input type="text" name="specialite" class="w-full border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label class="block font-bold mb-2">Nom</label>
                            <input type="text" name="nom" class="w-full border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label class="block font-bold mb-2">Prénom</label>
                            <input type="text" name="prenom" class="w-full border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label class="block font-bold mb-2">Email Professionnel</label>
                            <input type="email" name="email_professionnel" class="w-full border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label class="block font-bold mb-2">Téléphone</label>
                            <input type="text" name="telephone" class="w-full border-gray-300 rounded-md" required>
                        </div>
                    </div>
                    <div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2">Mot de passe du compte :</label>
    <input type="password" name="password" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Définir un mot de passe" required>
</div>

                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-8 py-2 rounded-lg font-bold hover:bg-blue-700 shadow-md">
                            Enregistrer le Formateur
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>