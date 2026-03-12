<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" data-i18n-app="emploisGroupsTitle">Emplois des Groupes</h2>
    </x-slot>

    @php
        $hasFilter = !empty($selectedGroupe);
        $currentGroupe = $selectedGroupe ? $groupes->firstWhere('id', (int) $selectedGroupe) : null;
        $totalSeances = 0;
        foreach($jours as $j) {
            foreach($creneaux as $c) {
                if(isset($emploi[$j][$c])) {
                    $totalSeances++;
                }
            }
        }
        $totalHeures = $totalSeances * 2.5;
    @endphp

    <style>
        body {
            font-family: Trebuchet MS, Arial, sans-serif;
        }

        /* ── PAPER ── desktop: fixed 1000px / mobile: full width */
        .paper {
            width: 100%;
            max-width: 1000px;

            margin: 0px auto;
            background: white;
            padding: 8px;
            border: 1px solid #cfd4da;
        }

        @media (max-width: 1040px) {
            .paper {
                width: 100%;
                overflow-x: auto;
            }
        }

        .doc-header {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            border: 1px solid #cfd4da;
        }

        .doc-header td {
            border: 1px solid #cfd4da;
            text-align: center;
            vertical-align: middle;
            padding: 4px;
        }

        /* ── hide logos on very small screens to save space ── */
        @media (max-width: 600px) {
            .doc-header .logo-cell {
                display: none;
            }
        }

        .doc-title-ar {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            color: #333;
            line-height: 1.2;
        }

        .doc-title-fr {
            margin: 4px 0 0;
            font-size: 16px;
            font-weight: 600;
            color: #222;
            line-height: 1.2;
        }

        @media (max-width: 600px) {
            .doc-title-ar { font-size: 13px; }
            .doc-title-fr { font-size: 12px; }
        }

        .doc-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            font-size: 12px;
            font-weight: 600;
            color: #8a94a0;
            background: #eef1f4;
            border: 1px solid #d4dbe3;
            margin: 4px 0 8px;
            padding: 6px 10px;
        }

        .doc-meta b {
            font-size: 15px;
            margin-left: 6px;
            color: #355f88;
            font-weight: 800;
        }

        /* ── TABLE wrapper: scrollable on mobile ── */
        .table-scroll-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .group-table {
            width: 100%;
            min-width: 480px; /* prevents squishing below readable size */
            border-collapse: collapse;
            table-layout: fixed;
            page-break-inside: auto;
        }

        .group-table tr {
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .group-table th {
            background-color: #2f9cb7 !important;
            color: #fff !important;
            border: 1px solid #d0d5db;
            padding: 4px;
            font-size: 7px;
            height: 36px;
            font-weight: 700;
        }

        .group-table td {
            border: 1px solid #d0d5db;
            height: 60px;
            text-align: center;
            vertical-align: middle;
            font-size: 11px;
            padding: 0 !important;
            background: #f5f5f5;
        }

        .day-cell {
            background-color: #d7e2e9 !important;
            color: #334155;
            font-weight: 700;
            width: 110px;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .day-cell { width: 20px; font-size: 8px; }
            .group-table th { font-size: 7px; padding: 2px; }
            .group-table td { height: 15px; font-size: 7px; }
            .times { font-size: 8px; padding: 0 3px; }
            .slot-card { font-size: 9px; padding: 2px; }
        }

        .slot-card {
            background-color: #5c80b9 !important;
            color: #fff !important;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3px;
            line-height: 1.25;
            font-size: 11px;
            text-transform: uppercase;
        }

        .slot-title {
            font-weight: 100;
        }

        .times {
            display: flex;
            justify-content: space-between;
            padding: 0 10px;
            font-size: 13px;
            font-weight: 1  00;
        }

        @media (max-width: 768px) {
            .doc-title-ar {
    font-size: 5px;
    margin: 0;
}

.doc-title-fr {
    font-size: 5px;
    margin: 4px 0 0;
}
            .times { font-size: 10px; padding: 0 4px; }
        }

        .emploi-shell {
            background: #ffffff;
            border: 1px solid #e2e8f0;
        }

        .empty-state {
            border: 2px dashed #d1d5db;
            color: #94a3b8;
        }

        /* ── DARK MODE ── */
        body.theme-dark .emploi-shell {
            background: var(--app-surface) !important;
            border-color: var(--app-border) !important;
        }

        body.theme-dark .emploi-shell label {
            color: #f8fafc !important;
        }

        body.theme-dark .emploi-shell select {
            background: #ffffff !important;
            border-color: #64748b !important;
            color: #0f172a !important;
        }

        body.theme-dark .emploi-shell select option {
            background: #ffffff;
            color: #0f172a;
        }

        body.theme-dark .emploi-shell button[type="submit"] {
            background: #2f7df6 !important;
            color: #ffffff !important;
        }

        body.theme-dark .empty-state {
            border-color: #334155;
            color: #94a3b8;
        }

        body.theme-dark .group-table td {
            background: #111827;
            color: #e5e7eb;
        }

        body.theme-dark .day-cell {
            background-color: #1e293b !important;
            color: #f8fafc;
        }

        body.theme-dark .slot-card {
            background-color: #1d4ed8 !important;
        }

        /* Mobile card view */
/* Mobile card view */
.mobile-card-view { display: none; }

.
.day-card { border: 1px solid #d0d5db; border-radius: 8px; overflow: hidden; margin-bottom: 8px; }
.day-card-header { background-color: #2f9cb7; color: #fff; font-weight: 100; font-size: 10px; padding: 8px 12px; border-bottom: 1px solid #c5cfd6; }
.creneau-row { display: flex; align-items: stretch; border-bottom: 1px solid #e5e7eb;  }
.creneau-row:last-child { border-bottom: none; }
.creneau-time { width: 40px;  background: #f0f4f7; display: flex; flex-direction: column; align-items: center; justify-content: center; font-size: 7px; font-weight: 100; color: #4a6b7a; padding: 6px 4px; border-right: 1px solid #d0d5db; line-height: 1.3; text-align: center; }
.creneau-content { flex: 1; display: flex; align-items: center; justify-content: center; background: #f5f5f5; padding: 6px 8px; font-size: 11px; text-align: center; color: #94a3b8; }
.mobile-slot-card { width: 100%; border-radius: 5px; padding: 6px 8px; font-size: 11px; line-height: 1.4; text-transform: uppercase; font-weight: 100; color: #fff; text-align: left; }

body.theme-dark .day-card { border-color: #334155; }
body.theme-dark .day-card-header { background-color: #1e293b; color: #f8fafc; border-bottom-color: #334155; }
body.theme-dark .creneau-row { border-bottom-color: #1e293b; }
body.theme-dark .creneau-time { background: #111827; color: #94a3b8; border-right-color: #334155; }
body.theme-dark .creneau-content { background: #111827; }

@media print {
    .desktop-table-view { display: block !important; }
    .mobile-card-view { display: none !important; }
}
/* Dark mode mobile */
body.theme-dark .day-card { border-color: #334155; }
body.theme-dark .day-card-header { background-color: #1e293b; color: #f8fafc; border-bottom-color: #334155; }
body.theme-dark .creneau-row { border-bottom-color: #1e293b; }
body.theme-dark .creneau-time { background: #111827; color: #94a3b8; border-right-color: #334155; }
body.theme-dark .creneau-content { background: #111827; }

/* Print: force desktop table */
@media print {
    .desktop-table-view { display: block !important; }
    .mobile-card-view { display: none !important; }
}
        /* ── PRINT ── desktop layout is preserved exactly ── */
        @media print {
            .no-print, nav, aside { display: none !important; }
            header { display: none !important; }
            main { padding: 0 !important; }
            .py-12 { padding-top: 0 !important; padding-bottom: 0 !important; }
            .max-w-7xl { max-width: 400px !important; }
            @page { size: A4 landscape; margin: 5mm; }
            .print-wrap,
            .paper { box-shadow: none !important; border: 0 !important; padding: 0 !important; width: 100%;  !important; margin: 0 !important; }
            .group-table th, .slot-card {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .group-table th { font-size: 10px; padding: 3px; }
            .group-table td { height: 52px; font-size: 10px; }
            .day-cell { width: 86px; font-size: 10px; }
            .slot-card { font-size: 10px; padding: 3px; }
            .doc-title-ar, .doc-title-fr { font-size: 13px; }
            .doc-meta { font-size: 11px; margin: 2px 0 6px; }
            .doc-meta b { font-size: 12px; }
            .times { font-size: 10px; padding: 0 6px; }
            /* restore logos for print */
            .doc-header .logo-cell { display: table-cell !important; }
            /* no horizontal scroll on print */
            .table-scroll-wrapper { overflow: visible; }
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="emploi-shell overflow-hidden shadow-sm sm:rounded-lg p-6 print-wrap" style="width:400px;">
                <form method="GET" action="{{ auth()->user()?->role === 'admin' ? route('seances.emploi') : route('formateur.emploi.view') }}" class="mb-8 no-print">
                    <input type="hidden" name="type" value="groupe">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1" data-i18n-app="filiereLabel">Filiere</label>
                            <select name="filiere_id" id="filiere_id" class="w-full border-gray-300 rounded-md shadow-sm">
                                <option value="" data-i18n-app="selectPrompt">-- Selectionner --</option>
                                @foreach($filieres as $filiere)
                                    <option value="{{ $filiere->id }}" {{ (string)$selectedFiliere === (string)$filiere->id ? 'selected' : '' }}>{{ $filiere->nom }} ({{ $filiere->niveau }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1" data-i18n-app="groupeLabel">Groupe</label>
                            <select name="groupe_id" id="groupe_id" class="w-full border-gray-300 rounded-md shadow-sm">
                                <option value="" data-i18n-app="selectPrompt">-- Selectionner --</option>
                                @foreach($groupes as $g)
                                    <option value="{{ $g->id }}" {{ (string)$selectedGroupe === (string)$g->id ? 'selected' : '' }}>{{ $g->code }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition duration-200 shadow">
                                <span data-i18n-app="showBtn">Afficher</span>
                            </button>
                        </div>


                    </div>
                </form>

                @if($hasFilter)
                    <div class="paper">
                        <table class="doc-header">
                            <tr>
                                <td style="width:80px;" class="logo-cell">
                                    <img src="{{ asset('images/logo-cmc.png') }}" alt="Logo CMC" style="height:40px; object-fit:contain;">
                                </td>
                                <td>
                                    <p class="doc-title-ar">مكتب التكوين المهني و إنعاش الشغل</p>
                                    <p class="doc-title-fr">Office de la formation professionnelle et de la promotion du travail</p>
                                </td>
                                <td style="width:80px;" class="logo-cell">
                                    <img src="{{ asset('images/logo-ofppt.png') }}" alt="Logo OFPPT" style="height:60px; object-fit:contain;">
                                </td>
                            </tr>
                        </table>

                        <div class="doc-meta">
                            <div><span data-i18n-app="groupLabelMeta">Groupe</span> : <b>{{ strtoupper($currentGroupe?->code ?? '') }}</b></div>
                            <div><span data-i18n-app="weeklyHoursLabel">Masse Horaire Hebdomadaire</span> : <b>{{ rtrim(rtrim(number_format($totalHeures, 1), '0'), '.') }}h</b></div>
                            <div><span data-i18n-app="trainingYearLabel">Année de Formation</span> : <b>2025 / 2026</b></div>
                        </div>

                        {{-- Wrapper div makes the table scroll horizontally on mobile --}}
                        <div class="desktop-table-view">
                        <div class="table-scroll-wrapper">
                            <table class="w-full border-collapse group-table">
                            <thead>
                                <tr>
                                    <th class="day-cell" data-i18n-app="dayHourHeader">Jour / Horaire</th>
                                    <th><div class="times"><span>08:30</span><span>11:00</span></div></th>
                                    <th><div class="times"><span>11:00</span><span>13:30</span></div></th>
                                    <th><div class="times"><span>13:30</span><span>16:00</span></div></th>
                                    <th><div class="times"><span>16:00</span><span>18:30</span></div></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jours as $jour)
                                    <tr>
                                        @php
                                            $dayMap = [
                                                'Lundi' => 'dayMonday',
                                                'Mardi' => 'dayTuesday',
                                                'Mercredi' => 'dayWednesday',
                                                'Jeudi' => 'dayThursday',
                                                'Vendredi' => 'dayFriday',
                                                'Samedi' => 'daySaturday',
                                            ];
                                            $dayKey = $dayMap[$jour] ?? null;
                                        @endphp
                                        <td class="day-cell" @if($dayKey) data-i18n-app="{{ $dayKey }}" @endif>{{ $jour }}</td>
                                        @foreach($creneaux as $creneau)
                                            <td>
                                                @if(isset($emploi[$jour][$creneau]))
                                                    @php
                                                        $isAbsent = !($emploi[$jour][$creneau]->formateur_present ?? true);
                                                        $isDistance = (($emploi[$jour][$creneau]->mode ?? 'presentiel') === 'distance');
                                                        $formateurName = trim(($emploi[$jour][$creneau]->formateur->nom ?? '') . ' ' . ($emploi[$jour][$creneau]->formateur->prenom ?? ''));
                                                    @endphp
                                                    <div class="slot-card" style="@if($isAbsent) background:#facc15 !important; color:#1f2937 !important; @elseif($isDistance) background:#1f3648 !important; color:#ffffff !important; @else background:#4d8cc3 !important; color:#ffffff !important; @endif">
                                                        <div style="font-weight:700;"><span style="color:EEF1F5">Formateur : </span>{{ $formateurName }}</div>
                                                        @if($isAbsent)
                                                            <div style="font-weight:800; color:#7c2d12;">ABSENT</div>
                                                        @elseif($isDistance)
                                                            <div style="font-weight:700;">A distance</div>
                                                        @else
                                                            <div style="font-weight:700;"><span style="color:EEF1F5">Salle : {{ $emploi[$jour][$creneau]->salle->code ?? '' }}</div>
                                                        @endif
                                                    </div>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                        </div>{{-- end desktop-table-view --}}
                        <div class="text-right no-print">
                            @if($hasFilter)
                                <button type="button" onclick="window.print()" class="bg-gray-500 hover:bg-gray-200 text-white px-6 py-2 rounded-md transition duration-200 shadow">
                                    <span data-i18n-app="printEmploisBtn">Imprimer emplois</span>
                                </button>
                            @endif
                        </div>
                        <div class="mobile-card-view">
                            @foreach($jours as $jour)
                                <div class="day-card">
                                    <div class="day-card-header">{{ $jour }}</div>
                                    @foreach($creneaux as $creneau)
                                        @php
                                            $creneauLabels = [
                                                '08:30-11:00' => ['08:30', '11:00'],
                                                '11:00-13:30' => ['11:00', '13:30'],
                                                '13:30-16:00' => ['13:30', '16:00'],
                                                '16:00-18:30' => ['16:00', '18:30'],
                                            ];
                                            $times     = $creneauLabels[$creneau] ?? explode('-', $creneau);
                                            $timeStart = $times[0] ?? $creneau;
                                            $timeEnd   = $times[1] ?? '';
                                        @endphp
                                        <div class="creneau-row">
                                            <div class="creneau-time">
                                                <span>{{ $timeStart }}</span>
                                                <span style="color:#b0bec5;">↓</span>
                                                <span>{{ $timeEnd }}</span>
                                            </div>
                                            <div class="creneau-content">
                                                @if(isset($emploi[$jour][$creneau]))
                                                    @php
                                                        $isAbsent      = !($emploi[$jour][$creneau]->formateur_present ?? true);
                                                        $isDistance    = (($emploi[$jour][$creneau]->mode ?? 'presentiel') === 'distance');
                                                        $formateurName = trim(($emploi[$jour][$creneau]->formateur->nom ?? '') . ' ' . ($emploi[$jour][$creneau]->formateur->prenom ?? ''));
                                                        $bgColor       = $isAbsent ? '#facc15' : ($isDistance ? '#1f3648' : '#4d8cc3');
                                                        $textColor     = $isAbsent ? '#1f2937' : '#ffffff';
                                                    @endphp
                                                    <div class="mobile-slot-card" style="background:{{ $bgColor }}; color:{{ $textColor }};">
                                                        <div style="font-weight:100; margin-bottom:2px;">{{ $formateurName }}</div>
                                                        @if($isAbsent)
                                                            <div style="font-weight:100; color:#7c2d12;">⚠ ABSENT</div>
                                                        @elseif($isDistance)
                                                            <div>📡 A distance</div>
                                                        @else
                                                            <div>🏫 Salle : {{ $emploi[$jour][$creneau]->salle->code ?? '' }}</div>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span style="color:#cbd5e1;">—</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>{{-- end mobile-card-view --}}

                    </div>{{-- end paper --}}
                    
                @else
                    <div class="empty-state text-center py-10 rounded-lg">
                        <p data-i18n-app="emptyPlanningMsg">Veuillez selectionner un filtre pour afficher le planning.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filiereEl = document.getElementById('filiere_id');
            const groupeEl = document.getElementById('groupe_id');
            const currentGroupe = '{{ $selectedGroupe }}';
            const allGroupOptionsHtml = groupeEl ? groupeEl.innerHTML : '';

            async function loadGroupesByFiliere() {
                if (!filiereEl || !groupeEl || !filiereEl.value) {
                    if (groupeEl) {
                        groupeEl.innerHTML = allGroupOptionsHtml;
                    }
                    return;
                }

                let response;
                try {
                    response = await fetch('/filieres/' + filiereEl.value + '/groupes');
                } catch (e) {
                    return;
                }
                if (!response.ok) {
                    return;
                }

                const groupes = await response.json();
                const promptText = document.documentElement.lang === 'ar'
                    ? '-- اختر --'
                    : (document.documentElement.lang === 'en' ? '-- Select --' : '-- Selectionner --');
                const options = ['<option value="">' + promptText + '</option>'];
                groupes.forEach(function (g) {
                    const selected = String(g.id) === String(currentGroupe) ? ' selected' : '';
                    options.push('<option value="' + g.id + '"' + selected + '>' + g.code + '</option>');
                });
                groupeEl.innerHTML = options.join('');
            }

            if (filiereEl) {
                filiereEl.addEventListener('change', async function () {
                    if (!groupeEl) {
                        return;
                    }
                    if (!filiereEl.value) {
                        groupeEl.innerHTML = allGroupOptionsHtml;
                        return;
                    }
                    const promptText = document.documentElement.lang === 'ar'
                        ? '-- اختر --'
                        : (document.documentElement.lang === 'en' ? '-- Select --' : '-- Selectionner --');
                    groupeEl.innerHTML = '<option value="">' + promptText + '</option>';
                    let response;
                    try {
                        response = await fetch('/filieres/' + filiereEl.value + '/groupes');
                    } catch (e) {
                        return;
                    }
                    if (!response.ok) {
                        return;
                    }
                    const groupes = await response.json();
                    groupes.forEach(function (g) {
                        const option = document.createElement('option');
                        option.value = g.id;
                        option.textContent = g.code;
                        groupeEl.appendChild(option);
                    });
                });

                loadGroupesByFiliere();
            }
        });
    </script>
</x-app-layout>
