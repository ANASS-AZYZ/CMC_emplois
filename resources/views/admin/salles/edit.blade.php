<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            <span data-i18n-app="editRoomTitle">Modifier la Salle :</span> {{ $salle->code }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-lg shadow-sm border border-slate-700/40">
                <form action="{{ route('salles.update', $salle->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block font-bold mb-2 text-gray-700" data-i18n-app="typeLabel">Type</label>
                            <select id="room-type" name="type" class="w-full border-slate-400 rounded-md bg-white text-slate-900 font-semibold focus:ring-blue-500" required>
                                <option value="SC" {{ old('type', $salle->type) == 'SC' ? 'selected' : '' }} data-i18n-app="roomTypeCourseLabel">Salle de cours (SC)</option>
                                <option value="SM" {{ old('type', $salle->type) == 'SM' ? 'selected' : '' }} data-i18n-app="roomTypeMultimediaLabel">Salle Multimédia (SM)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-gray-700" data-i18n-app="codeLabel">Code</label>
                            <input id="room-code" type="text" name="code" value="{{ old('code', $salle->code) }}" class="w-full border-slate-400 rounded-md bg-white text-slate-900 font-semibold focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-gray-700" data-i18n-app="capacityLabel">Capacité</label>
                            <input type="number" name="capacite" value="{{ old('capacite', $salle->capacite) }}" 
                                   class="w-full border-gray-300 rounded-md focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-8 py-2 rounded-lg font-bold transition shadow-md" data-i18n-app="saveChangesBtn">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var typeSelect = document.getElementById('room-type');
            var codeInput = document.getElementById('room-code');
            if (!typeSelect || !codeInput) return;

            function ensurePrefix() {
                var prefix = (typeSelect.value || 'SC') + '-';
                var value = (codeInput.value || '').trim();

                if (value === '' || value === 'SC-' || value === 'SM-') {
                    codeInput.value = prefix;
                    return;
                }

                if (/^(SC|SM)-/i.test(value)) {
                    codeInput.value = value.replace(/^(SC|SM)-/i, prefix);
                    return;
                }

                codeInput.value = prefix + value.replace(/^[-\s]+/, '');
            }

            typeSelect.addEventListener('change', ensurePrefix);
        });
    </script>
</x-app-layout>