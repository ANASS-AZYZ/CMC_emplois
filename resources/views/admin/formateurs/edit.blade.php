<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            <span data-i18n-app="editTrainerTitle">Modifier Formateur :</span> {{ $formateur->nom }} {{ $formateur->prenom }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                @if ($errors->any())
                    <div class="mb-6 rounded-md border border-red-200 bg-red-50 p-4 text-red-700">
                        <p class="font-bold mb-2" data-i18n-app="formErrorsTitle">Des erreurs existent dans le formulaire :</p>
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('formateurs.update', $formateur) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-bold mb-2" data-i18n-app="matriculeLabel">Matricule</label>
                            <input type="text" name="matricule" value="{{ old('matricule', $formateur->matricule) }}" class="w-full border-gray-300 rounded-md text-slate-900 placeholder-slate-500" placeholder="Ex: SC-01" required>
                        </div>

                        <div>
                            <label class="block font-bold mb-2" data-i18n-app="proEmailLabel">Email Professionnel</label>
                            <input type="email" name="email_professionnel" value="{{ old('email_professionnel', $formateur->email_professionnel) }}" class="w-full border-gray-300 rounded-md text-slate-900 placeholder-slate-500" placeholder="Ex: formateur@cmc.ma" required>
                        </div>

                        <div>
                            <label class="block font-bold mb-2" data-i18n-app="nomLabel">Nom</label>
                            <input type="text" name="nom" value="{{ old('nom', $formateur->nom) }}" class="w-full border-gray-300 rounded-md text-slate-900 placeholder-slate-500" placeholder="Ex: EL OMARI" required>
                        </div>

                        <div>
                            <label class="block font-bold mb-2" data-i18n-app="prenomLabel">Prénom</label>
                            <input type="text" name="prenom" value="{{ old('prenom', $formateur->prenom) }}" class="w-full border-gray-300 rounded-md text-slate-900 placeholder-slate-500" placeholder="Ex: Salma" required>
                        </div>

                        <div>
                            <label class="block font-bold mb-2" data-i18n-app="phoneLabel">Telephone</label>
                            <input type="text" name="telephone" value="{{ old('telephone', $formateur->telephone) }}" class="w-full border-gray-300 rounded-md text-slate-900 placeholder-slate-500" placeholder="Ex: 0600000000" required>
                        </div>

                        <div>
                            <label class="block font-bold mb-2" data-i18n-app="specialityLabel">Spécialité</label>
                            <input type="text" name="specialite" value="{{ old('specialite', $formateur->specialite) }}" class="w-full border-gray-300 rounded-md text-slate-900 placeholder-slate-500" placeholder="Ex: Développement Web" required>
                        </div>

                        <div class="p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded">
                            <label class="block text-sm font-bold text-yellow-800 mb-2" data-i18n-app="changePasswordOptionalLabel">Changer le Mot de passe (Optionnel) :</label>
                            <input type="password" name="password" class="w-full border-gray-300 rounded-md shadow-sm text-slate-900 placeholder-slate-500" placeholder="Laisser vide pour ne pas changer" data-i18n-app-placeholder="keepPasswordPlaceholder">
                        </div>

                    </div>

                    <div class="mt-8">
                        <button type="submit" class="bg-blue-600 text-white px-8 py-2 rounded-lg font-bold transition shadow-md" data-i18n-app="saveChangesBtn">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>