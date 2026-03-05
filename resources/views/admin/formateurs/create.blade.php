<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight" data-i18n-app="addTrainerTitle">Ajouter un Nouveau Formateur</h2>
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

                <form action="{{ route('formateurs.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-bold mb-2" data-i18n-app="matriculeLabel">Matricule</label>
                            <input type="text" name="matricule" value="{{ old('matricule') }}" class="w-full border-gray-300 rounded-md text-slate-900 placeholder-slate-500" placeholder="Ex: SC-01" required>
                        </div>
                        <div>
                            <label class="block font-bold mb-2" data-i18n-app="specialityLabel">Spécialité</label>
                            <input type="text" name="specialite" value="{{ old('specialite') }}" class="w-full border-gray-300 rounded-md text-slate-900 placeholder-slate-500" placeholder="Ex: Développement Web" required>
                        </div>
                        <div>
                            <label class="block font-bold mb-2" data-i18n-app="nomLabel">Nom</label>
                            <input type="text" name="nom" value="{{ old('nom') }}" class="w-full border-gray-300 rounded-md text-slate-900 placeholder-slate-500" placeholder="Ex: EL OMARI" required>
                        </div>
                        <div>
                            <label class="block font-bold mb-2" data-i18n-app="prenomLabel">Prénom</label>
                            <input type="text" name="prenom" value="{{ old('prenom') }}" class="w-full border-gray-300 rounded-md text-slate-900 placeholder-slate-500" placeholder="Ex: Salma" required>
                        </div>
                        <div>
                            <label class="block font-bold mb-2" data-i18n-app="proEmailLabel">Email Professionnel</label>
                            <input type="email" name="email_professionnel" value="{{ old('email_professionnel') }}" class="w-full border-gray-300 rounded-md text-slate-900 placeholder-slate-500" placeholder="Ex: formateur@cmc.ma" required>
                        </div>
                        <div>
                            <label class="block font-bold mb-2" data-i18n-app="phoneLabel">Téléphone</label>
                            <input type="text" name="telephone" value="{{ old('telephone') }}" class="w-full border-gray-300 rounded-md text-slate-900 placeholder-slate-500" placeholder="Ex: 0600000000" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2" data-i18n-app="accountPasswordLabel">Mot de passe du compte :</label>
                            <input type="password" name="password" class="w-full border-gray-300 rounded-md shadow-sm text-slate-900 placeholder-slate-500" placeholder="Definir un mot de passe" data-i18n-app-placeholder="passwordPlaceholder" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2" data-i18n-app="passwordConfirmLabel">Confirmation mot de passe :</label>
                            <input type="password" name="password_confirmation" class="w-full border-gray-300 rounded-md shadow-sm text-slate-900 placeholder-slate-500" placeholder="Confirmer le mot de passe" data-i18n-app-placeholder="passwordConfirmPlaceholder" required>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-8 py-2 rounded-lg font-bold shadow-md" data-i18n-app="saveTrainerBtn">
                            Enregistrer le Formateur
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>