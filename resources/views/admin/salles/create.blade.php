<?php
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" data-i18n-app="addRoomTitle">
            Ajouter une Salle
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('salles.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700" data-i18n-app="codeExampleRoomLabel">Code (ex: SC-02, SM-03)</label>
                        <input type="text" name="code" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Ex: SM-03" required>
                        @error('code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700" data-i18n-app="roomTypeLabel">Type de Salle</label>
                        <select name="type" class="w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="SC" data-i18n-app="roomTypeCourseLabel">Salle de cours (SC)</option>
                            <option value="SM" data-i18n-app="roomTypeMultimediaLabel">Salle Multimedia (SM)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700" data-i18n-app="capacityOptionalLabel">Capacité (Optionnel)</label>
                        <input type="number" name="capacite" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Ex: 30">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md" data-i18n-app="saveRoomBtn">
                            Enregistrer la Salle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
