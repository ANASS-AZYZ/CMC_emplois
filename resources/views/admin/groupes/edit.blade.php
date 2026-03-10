<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"><span data-i18n-app="editGroupTitle">Modifier le Groupe :</span> {{ $groupe->code }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm sm:rounded-lg border border-slate-700/40">
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="edit-groupe-form" action="{{ route('groupes.update', $groupe) }}" method="POST" data-edit-filiere-id="{{ $groupe->filiere_id }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-semibold text-base text-gray-100 mb-2" data-i18n-app="yearLabel">Année</label>
                        <select id="group-year" name="annee" class="w-full rounded-md border border-slate-400 bg-white px-4 py-3 text-slate-900 font-semibold shadow-sm" required>
                            <option value="1ère" {{ in_array((string) old('annee', $groupe->annee), ['1', '1ère'], true) ? 'selected' : '' }} data-i18n-app="firstYearLabel">1ère année</option>
                            <option value="2ème" {{ in_array((string) old('annee', $groupe->annee), ['2', '2ème'], true) ? 'selected' : '' }} data-i18n-app="secondYearLabel">2ème année</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold text-base text-gray-100 mb-2" data-i18n-app="filiereLabel">Filière</label>
                        <select id="group-filiere" name="filiere_id" class="w-full rounded-md border border-slate-400 bg-white px-4 py-3 text-slate-900 font-semibold shadow-sm" required>
                            @foreach($filieres as $filiere)
                                <option value="{{ $filiere->id }}" data-niveau="{{ $filiere->niveau }}" data-nom="{{ $filiere->nom }}" {{ (string) old('filiere_id', $groupe->filiere_id) === (string) $filiere->id ? 'selected' : '' }}>
                                    {{ $filiere->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold text-base text-gray-100 mb-2" data-i18n-app="groupCodeLabel">Code du Groupe</label>
                        <input id="group-code" type="text" name="code" value="{{ old('code', $groupe->code) }}" class="w-full rounded-md border border-slate-400 bg-white px-4 py-3 text-slate-900 font-semibold placeholder-slate-500 shadow-sm" placeholder="Ex: DES-1" required>
                    </div>

                    <div class="flex items-center gap-4 mt-6">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md font-bold" data-i18n-app="saveBtn">Enregistrer</button>
                        <a href="{{ route('groupes.index') }}" class="text-gray-600" data-i18n-app="cancelBtn">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var form = document.getElementById('edit-groupe-form');
            var yearSelect = document.getElementById('group-year');
            var filiereSelect = document.getElementById('group-filiere');
            var codeInput = document.getElementById('group-code');
            var lastAutoValue = '';
            var originalValue = codeInput ? codeInput.value.trim() : '';
            var editFiliereId = form ? (form.getAttribute('data-edit-filiere-id') || '') : '';

            if (!yearSelect || !filiereSelect || !codeInput) return;

            function mapYearToNiveau(year) {
                return (year === '2ème' || year === '2') ? '2ème année' : '1ère année';
            }

            function normalize(value) {
                return (value || '').toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
            }

            function expectedCodeBySelection() {
                var year = (yearSelect.value === '2ème' || yearSelect.value === '2') ? '2' : '1';
                var selected = filiereSelect.options[filiereSelect.selectedIndex];
                var nom = normalize(selected ? selected.getAttribute('data-nom') : '');

                if (year === '1') {
                    if (nom.indexOf('digital design') !== -1 || nom.indexOf('digitale design') !== -1) return 'DES-1';
                    if (nom.indexOf('developpement digital') !== -1 || nom.indexOf('developement digital') !== -1) return 'DEV-1';
                    if (nom.indexOf('intelligence artificielle') !== -1) return 'AI-1';
                    if (nom.indexOf('infrastructure digitale') !== -1 || nom.indexOf('infra') !== -1) return 'ID-1';
                }
                if (year === '2') {
                    if (nom.indexOf('web full stack') !== -1) return 'DEVOWFS-2';
                    if (nom.indexOf('applications mobiles') !== -1 || nom.indexOf('application mobile') !== -1) return 'DEVOAM-2';
                    if (nom.indexOf('ui designer') !== -1) return 'DESOUI-2';
                    if (nom.indexOf('ux designer') !== -1) return 'DESOUS-2';
                    if (nom.indexOf('cyber securite') !== -1 || nom.indexOf('cybersecurite') !== -1) return 'IDOCS-2';
                    if (nom.indexOf('systemes et reseaux') !== -1 || nom.indexOf('systemes reseaux') !== -1) return 'IDSR-2';
                }
                return year === '2' ? 'GRP-2' : 'GRP-1';
            }

            function refreshFilieres() {
                var wanted = mapYearToNiveau(yearSelect.value);
                var selectedVisible = false;
                var firstVisibleValue = null;

                Array.from(filiereSelect.options).forEach(function (option) {
                    var isEditFiliere = editFiliereId && (String(option.value) === String(editFiliereId));
                    var visible = (option.getAttribute('data-niveau') === wanted) || isEditFiliere;
                    option.hidden = !visible;
                    if (visible && firstVisibleValue === null) firstVisibleValue = option.value;
                    if (visible && option.selected) selectedVisible = true;
                });

                if (!selectedVisible && firstVisibleValue !== null && !editFiliereId) {
                    filiereSelect.value = firstVisibleValue;
                }
            }

            function ensureCodePrefix() {
                var generated = expectedCodeBySelection();
                var value = (codeInput.value || '').trim();
                codeInput.placeholder = 'Ex: ' + generated;
                if (originalValue) {
                    return;
                }
                if (value === '') {
                    codeInput.value = generated;
                    lastAutoValue = generated;
                }
            }

            yearSelect.addEventListener('change', function () { refreshFilieres(); ensureCodePrefix(); });
            filiereSelect.addEventListener('change', ensureCodePrefix);
            refreshFilieres();
            ensureCodePrefix();
        });
    </script>
</x-app-layout>