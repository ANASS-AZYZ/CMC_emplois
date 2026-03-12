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
                if(isset($emploi[$j][$c])) $totalSeances++;
            }
        }
        $totalHeures = $totalSeances * 2.5;
    @endphp

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* ── FILTER ── */
        .filter-container {
            background: white;
            padding: 24px 20px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            margin-bottom: 25px;
            max-width: 320px;
        }

        .filter-form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .filter-group label {
            display: block;
            font-weight: 600;
            color: #374151;
            font-size: 14px;
            margin-bottom: 6px;
        }

        .filter-input {
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            width: 100%;
            outline: none;
            font-size: 15px;
            background: #f8fafc;
            color: #374151;
            transition: border-color 0.2s;
            appearance: auto;
            box-sizing: border-box;
        }

        .filter-input:focus { border-color: #2563eb; }

        .btn-submit {
            background: #2563eb;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 700;
            font-size: 15px;
            width: 100%;
            transition: background 0.2s;
        }

        .btn-submit:hover { background: #1d4ed8; }

        .btn-print {
            background: #1e293b;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 700;
            font-size: 15px;
            width: 100%;
            transition: background 0.2s;
        }

        .btn-print:hover { background: #0f172a; }

        /* ── PAPER ── */
        .paper {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto 15px;
            background: white;
            padding: 15px;
            border-radius: 12px;
            border: 1px solid #d1d5db;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            box-sizing: border-box;
        }

        /* ── DOC HEADER ── */
        .doc-header {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
            border: 1px solid #e5e7eb;
        }

        .doc-header td {
            border: 1px solid #e5e7eb;
            padding: 10px;
            text-align: center;
            vertical-align: middle;
        }

        .doc-title-ar {
            font-size: 16px;
            margin: 0;
            font-weight: 700;
            color: #111827;
        }

        .doc-title-fr {
            font-size: 14px;
            margin: 5px 0 0;
            color: #374151;
            font-weight: 500;
        }

        /* ── META ── */
        .doc-meta {
            display: flex;
            justify-content: space-between;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 12px 20px;
            margin-bottom: 15px;
            border-radius: 8px;
            color: #64748b;
            font-size: 13px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .doc-meta b {
            color: #1e3a8a;
            font-size: 15px;
            margin-left: 5px;
        }

        /* ── TABLE ── */
        .group-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .group-table th {
            background-color: #31a9c7 !important;
            color: white !important;
            border: 1px solid #cbd5e1;
            padding: 8px;
            font-size: 14px;
            font-weight: 700;
        }

        .group-table td {
            border: 1px solid #cbd5e1;
            height: 75px;
            text-align: center;
            vertical-align: middle;
            background: #ffffff;
            padding: 0 !important;
        }

        .day-cell {
            background-color: #f1f5f9 !important;
            font-weight: 700;
            width: 120px;
            color: #334155;
            font-size: 13px;
        }

        .slot {
            height: 100%;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 5px;
            gap: 4px;
            font-size: 12px;
            text-transform: uppercase;
        }

        .slot-active   { background-color: #4d8cc3 !important; color: white !important; }
        .slot-distance { background-color: #1f3648 !important; color: white !important; }
        .slot-absent   { background-color: #facc15 !important; color: #1f2937 !important; }

        .times {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            padding: 0 5px;
            font-weight: 700;
        }

        /* ── EMPTY STATE ── */
        .empty-state {
            max-width: 520px;
            margin: 0 auto;
            border: 2px dashed #e2e8f0;
            border-radius: 16px;
            padding: 40px 20px;
            text-align: center;
            color: #94a3b8;
            font-size: 15px;
            background: white;
        }

        /* ── SHELL ── */
        .emploi-shell {
            background: #ffffff;
            border: 1px solid #e2e8f0;
        }

        /* ── DARK MODE ── */
        body.theme-dark .emploi-shell {
            background: var(--app-surface) !important;
            border-color: var(--app-border) !important;
        }

        body.theme-dark .filter-container { background: var(--app-surface); border-color: var(--app-border); }
        body.theme-dark .filter-group label { color: #f8fafc !important; }
        body.theme-dark .filter-input { background: #ffffff !important; color: #0f172a !important; }
        body.theme-dark .paper { background: #ffffff; color: #0f172a; }
        body.theme-dark .doc-title-ar,
        body.theme-dark .doc-title-fr { color: #0f172a !important; }
        body.theme-dark .doc-meta { color: #0f172a !important; }
        body.theme-dark .group-table td { background: #f3f4f6; }
        body.theme-dark .empty-state { border-color: #334155; color: #94a3b8; }

        /* ── RESPONSIVE MOBILE ── */
        @media (max-width: 768px) {
    .filter-container { max-width: 100%; padding: 16px; }

    .filter-form {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        align-items: end;
    }

    .btn-submit,
    .btn-print { grid-column: span 2; }

    .paper { padding: 6px; margin: 0 0 10px; overflow-x: auto; }

    .group-table { min-width: 480px; }

    .doc-header .logo-cell { display: none; }
    .doc-title-ar { font-size: 12px; }
    .doc-title-fr { font-size: 10px; }

    .doc-meta { flex-direction: row; flex-wrap: wrap; gap: 3px; font-size: 10px; padding: 5px 8px; }
    .doc-meta b { font-size: 12px; }

    .group-table th { font-size: 9px; padding: 3px; }
    .group-table td { height: 50px; font-size: 9px; }
    .day-cell { width: 55px; font-size: 9px; }
    .slot { font-size: 9px; padding: 2px; gap: 1px; }
    .times { font-size: 8px; padding: 0 2px; }
}

@media (max-width: 480px) {
    .filter-form { grid-template-columns: 1fr; }
    .btn-submit,
    .btn-print { grid-column: span 1; }

    .doc-title-ar { font-size: 10px; }
    .doc-title-fr { font-size: 9px; }

    .group-table { min-width: 420px; }
    .group-table th { font-size: 8px; padding: 2px; }
    .group-table td { height: 45px; font-size: 8px; }
    .day-cell { width: 45px; font-size: 8px; }
    .slot { font-size: 8px; padding: 2px; gap: 1px; }
    .times { font-size: 7px; padding: 0 2px; }
}
        /* ── PRINT ── */
        @media print {
            .no-print, nav, aside { display: none !important; }
            header { display: none !important; }
            main { padding: 0 !important; }
            .py-12 { padding-top: 0 !important; padding-bottom: 0 !important; }
            .max-w-7xl { max-width: 100% !important; }
            body { background: white !important; margin: 0 !important; padding: 0 !important; }

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            @page { size: A4 landscape; margin: 1cm; }

            .emploi-shell,
            .print-wrap { box-shadow: none !important; border: none !important; padding: 0 !important; background: white !important; }

            .paper {
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 8px !important;
                border: none !important;
                box-shadow: none !important;
                border-radius: 0 !important;
                overflow: visible !important;
            }

            .doc-header .logo-cell { display: table-cell !important; }
            .doc-title-ar { font-size: 16px !important; }
            .doc-title-fr { font-size: 13px !important; }

            .group-table { min-width: 0 !important; width: 100% !important; }
            .group-table th { font-size: 12px !important; padding: 6px !important; }
            .group-table td { height: 52px !important; font-size: 12px !important; }
            .day-cell { width: 86px !important; font-size: 11px !important; }
            .slot { font-size: 11px !important; }
            .times { font-size: 12px !important; }

            .doc-meta {
                flex-direction: row !important;
                flex-wrap: nowrap !important;
                font-size: 7px !important;
                padding: 2  px 6px !important;
            }
            .doc-meta b { font-size: 7px !important; }
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="emploi-shell overflow-hidden shadow-sm sm:rounded-lg p-6 print-wrap">

                {{-- ── FILTER FORM ── --}}
                <div class="filter-container no-print">
                    <form method="GET" action="{{ auth()->user()?->role === 'admin' ? route('seances.emploi') : route('formateur.emploi.view') }}" class="filter-form">
                        <input type="hidden" name="type" value="groupe">

                        <div class="filter-group">
                            <label data-i18n-app="filiereLabel">FILIERE</label>
                            <select name="filiere_id" id="filiere_id" class="filter-input">
                                <option value="" data-i18n-app="selectPrompt">-- Selectionner --</option>
                                @foreach($filieres as $filiere)
                                    <option value="{{ $filiere->id }}" {{ (string)$selectedFiliere === (string)$filiere->id ? 'selected' : '' }}>
                                        {{ $filiere->nom }} ({{ $filiere->niveau }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="filter-group">
                            <label data-i18n-app="groupeLabel">GROUPE</label>
                            <select name="groupe_id" id="groupe_id" class="filter-input">
                                <option value="" data-i18n-app="selectPrompt">-- Selectionner --</option>
                                @foreach($groupes as $g)
                                    <option value="{{ $g->id }}" {{ (string)$selectedGroupe === (string)$g->id ? 'selected' : '' }}>{{ $g->code }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn-submit">
                            <span data-i18n-app="showBtn">Afficher</span>
                        </button>

                        @if($hasFilter)
                            <button type="button" onclick="window.print()" class="btn-print">
                                <span data-i18n-app="printEmploisBtn">Imprimer emplois</span>
                            </button>
                        @endif
                    </form>
                </div>

                {{-- ── PLANNING ── --}}
                @if($hasFilter)
                    <div class="paper">

                        {{-- DOC HEADER --}}
                        <table class="doc-header">
                            <tr>
                                <td style="width:60px;" class="logo-cell">
                                    <img src="{{ asset('images/logo-cmc.png') }}" alt="Logo CMC" style="height:60px; object-fit:contain;">
                                </td>
                                <td>
                                    <p class="doc-title-ar">مكتب التكوين المهني و إنعاش الشغل</p>
                                    <p class="doc-title-fr">Office de la formation professionnelle et de la promotion du travail</p>
                                </td>
                                <td style="width:60px;" class="logo-cell">
                                    <img src="{{ asset('images/logo-ofppt.png') }}" alt="Logo OFPPT" style="height:30px; object-fit:contain;">
                                </td>
                            </tr>
                        </table>

                        {{-- META --}}
                        <div class="doc-meta">
                            <div><span data-i18n-app="groupLabelMeta">Groupe</span> : <b>{{ strtoupper($currentGroupe?->code ?? '') }}</b></div>
                            <div><span data-i18n-app="weeklyHoursLabel">Masse Horaire Hebdomadaire</span> : <b>{{ rtrim(rtrim(number_format($totalHeures, 1), '0'), '.') }}h</b></div>
                            <div><span data-i18n-app="trainingYearLabel">Année de Formation</span> : <b>2025 / 2026</b></div>
                        </div>

                        {{-- TABLE --}}
                        <div style="width:100%; overflow-x:auto; -webkit-overflow-scrolling:touch;">
                            <table class="group-table">
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
                                                    'Lundi'    => 'dayMonday',
                                                    'Mardi'    => 'dayTuesday',
                                                    'Mercredi' => 'dayWednesday',
                                                    'Jeudi'    => 'dayThursday',
                                                    'Vendredi' => 'dayFriday',
                                                    'Samedi'   => 'daySaturday',
                                                ];
                                                $dayKey = $dayMap[$jour] ?? null;
                                            @endphp
                                            <td class="day-cell" @if($dayKey) data-i18n-app="{{ $dayKey }}" @endif>{{ $jour }}</td>
                                            @foreach($creneaux as $creneau)
                                                <td>
                                                    @if(isset($emploi[$jour][$creneau]))
                                                        @php
                                                            $item          = $emploi[$jour][$creneau];
                                                            $isAbsent      = !($item->formateur_present ?? true);
                                                            $isDistance    = (($item->mode ?? 'presentiel') === 'distance');
                                                            $formateurName = trim(($item->formateur->nom ?? '') . ' ' . ($item->formateur->prenom ?? ''));
                                                            $slotClass     = $isAbsent ? 'slot-absent' : ($isDistance ? 'slot-distance' : 'slot-active');
                                                        @endphp
                                                        <div class="slot {{ $slotClass }}">
                                                            <div style="font-weight:800;">{{ $formateurName }}</div>
                                                            @if($isAbsent)
                                                                <div style="font-weight:800; text-decoration:underline; color:#7c2d12;">ABSENT</div>
                                                            @elseif($isDistance)
                                                                <div>(A distance)</div>
                                                            @else
                                                                <div style="opacity:0.9;">{{ $item->salle->code ?? '' }}</div>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <span style="color:#cbd5e1;">-</span>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- PRINT BUTTON --}}
                        <div class="no-print" style="text-align:center; margin-top:20px;">
                            <button onclick="window.print()" style="background:#1e293b; color:white; padding:12px 40px; border-radius:50px; border:none; font-weight:700; cursor:pointer; display:inline-flex; align-items:center; gap:10px; font-size:14px; transition:background 0.2s;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:20px;height:20px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                </svg>
                                <span data-i18n-app="printEmploisBtn">Imprimer l'emploi du temps</span>
                            </button>
                        </div>

                    </div>

                @else
                    <div class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor"
                             style="width:40px;height:40px;margin:0 auto 12px;display:block;color:#cbd5e1;">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                        </svg>
                        <p data-i18n-app="emptyPlanningMsg">Veuillez selectionner un filtre pour afficher le planning.</p>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filiereEl = document.getElementById('filiere_id');
            const groupeEl  = document.getElementById('groupe_id');
            const currentGroupe = '{{ $selectedGroupe }}';
            const allGroupOptionsHtml = groupeEl ? groupeEl.innerHTML : '';

            async function loadGroupesByFiliere() {
                if (!filiereEl || !groupeEl || !filiereEl.value) {
                    if (groupeEl) groupeEl.innerHTML = allGroupOptionsHtml;
                    return;
                }
                let response;
                try { response = await fetch('/filieres/' + filiereEl.value + '/groupes'); }
                catch (e) { return; }
                if (!response.ok) return;

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
                    if (!groupeEl) return;
                    if (!filiereEl.value) { groupeEl.innerHTML = allGroupOptionsHtml; return; }

                    const promptText = document.documentElement.lang === 'ar'
                        ? '-- اختر --'
                        : (document.documentElement.lang === 'en' ? '-- Select --' : '-- Selectionner --');
                    groupeEl.innerHTML = '<option value="">' + promptText + '</option>';

                    let response;
                    try { response = await fetch('/filieres/' + filiereEl.value + '/groupes'); }
                    catch (e) { return; }
                    if (!response.ok) return;

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