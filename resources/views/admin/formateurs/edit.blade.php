<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            Modifier Formateur : {{ $formateur->nom }} {{ $formateur->prenom }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <form action="{{ route('formateurs.update', $formateur) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-bold mb-2">Matricule</label>
                            <input type="text" name="matricule" value="{{ old('matricule', $formateur->matricule) }}" class="w-full border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label class="block font-bold mb-2">Email Professionnel</label>
                            <input type="email" name="email_professionnel" value="{{ old('email_professionnel', $formateur->email_professionnel) }}" class="w-full border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label class="block font-bold mb-2">Nom</label>
                            <input type="text" name="nom" value="{{ old('nom', $formateur->nom) }}" class="w-full border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label class="block font-bold mb-2">Prénom</label>
                            <input type="text" name="prenom" value="{{ old('prenom', $formateur->prenom) }}" class="w-full border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label class="block font-bold mb-2">Spécialité</label>
                            <input type="text" name="specialite" value="{{ old('specialite', $formateur->specialite) }}" class="w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mt-6 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded">
    <label class="block text-sm font-bold text-yellow-800 mb-2">Changer le Mot de passe (Optionnel) :</label>
    <input type="password" name="password" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Laisser vide pour ne pas changer">
</div>
                    </div>

                    <div class="mt-8">
                        <button type="submit" class="bg-blue-600 text-white px-8 py-2 rounded-lg font-bold hover:bg-blue-700 transition shadow-md">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>