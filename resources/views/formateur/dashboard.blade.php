<x-app-layout>
    <style>
        
        body {
            font-family: Trebuchet MS, Arial, sans-serif;
        }

        .paper {
            width: 100%;
            max-width: 1000px;
            margin: 10px auto;
            background: white;
            color: #0f172a;
            padding: 8px;
            border: 1px solid #cfd4da;
            overflow: hidden;
            box-sizing: border-box;
        }

        .header {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            border: 1px solid #cfd4da;
        }

        .header td {
            border: 1px solid #cfd4da;
            padding: 4px;
            text-align: center;
            vertical-align: middle;
        }

        .header-ar {
            font-size: 16px;
            margin: 0;
            font-weight: 700;
            color: #333;
        }

        .header-fr {
            font-size: 16px;
            margin: 4px 0 0;
            color: #222;
            font-weight: 600;
        }

        .meta {
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

        .meta b {
            font-size: 15px;
            margin-left: 6px;
            color: #355f88;
            font-weight: 800;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .table th {
            background-color: #2f9cb7 !important;
            color: white !important;
            border: 1px solid #d0d5db;
            padding: 4px;
            font-size: 13px;
            height: 36px;
            font-weight: 700;
        }

        .table td {
            border: 1px solid #d0d5db;
            height: 60px;
            text-align: center;
            vertical-align: middle;
            font-size: 11px;
            color: #1f2937;
            padding: 0 !important;
            background: #f5f5f5;
        }

        .day {
            background-color: #d7e2e9 !important;
            color: #1f2937;
            font-weight: bold;
            width: 110px;
            font-size: 13px;
        }

        .slot {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3px;
            line-height: 1.25;
            font-size: 11px;
            text-transform: uppercase;
        }

        .times {
            display: flex;
            justify-content: space-between;
            padding: 0 10px;
            font-size: 13px;
            font-weight: 700;
        }

        .btn-print {
            margin-top: 14px;
            text-align: center;
        }

        .btn-print button {
            background: #1f2937;
            color: white;
            border: 0;
            border-radius: 999px;
            padding: 10px 34px;
            font-weight: 700;
            cursor: pointer;
        }

        body.theme-dark .paper {
            background: #ffffff;
            color: #0f172a;
            border-color: #cbd5e1;
        }

        body.theme-dark .meta,
        body.theme-dark .table td,
        body.theme-dark .day,
        body.theme-dark .header-ar,
        body.theme-dark .header-fr {
            color: #0f172a !important;
        }

        body.theme-dark .table td {
            background: #f3f4f6;
        }

.edt-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    border: 1px solid #cfd4da;
    padding: 8px 12px;
    margin-bottom: 10px;
    flex-wrap: nowrap;
}

.header-logo {
    height: 55px;
    object-fit: contain;
    flex-shrink: 0;
}

.header-center {
    text-align: center;
    flex: 1;
    min-width: 0;
}
        @media print {
            .no-print, nav, aside { display: none !important; }
            @page { size: A4 landscape; margin: 5mm; }
            .paper { width: 100% !important; margin: 0 !important; border: 0 !important; padding: 0 !important; }
            .table th, .slot {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .table td {
                
            }
        }

        @media (max-width: 480px) {
            .paper { 
                padding: 4px !important; 
                margin: 4px !important;
                width: calc(100% - 8px) !important;
            }
            .edt-header    { padding: 3px 2px; gap: 3px; }
            .header-logo   { height: 25px; }
            .header-ar     { font-size: 6px; }
            .header-fr     { font-size: 6px; }
            .paper        { padding: 6px; } 
            .header img   { height: 40px  }
            .meta         { font-size: 6px; padding: 3px 4px; gap: 3px; }
            .meta b       { font-size: 8px; }
            .table th     { height: 10px; font-size: 7px; padding: 3px 2px; }
            .table td     { height: 10px; }
            .slot         { font-size: 7px; padding: 2px; }
            .times        { font-size: 9px; padding: 0 3px; }
            .day          { width: 70px; font-size: 9px; }
        }
        .btn-print button {
            padding: 8px 24px;
            font-size: 13px;
        }
        .custom-scrollbar::-webkit-scrollbar {
            height: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
    </style>

    @php
        $totalSeances = 0;
        if(isset($emploi)) {
            foreach($jours as $j) {
                foreach($creneaux as $c) {
                    if(isset($emploi[$j][$c])) {
                        $totalSeances++;
                    }
                }
            }
        }
        $totalHeures = $totalSeances * 2.5;
    @endphp

<div style="background:#eef2f7; padding:16px 6px; box-sizing:border-box; width:100%; overflow-x:hidden;">
    <div class="paper shadow-lg rounded-sm">
            <div class="edt-header">
    <img src="{{ asset('images/logo-cmc.png') }}" class="header-logo">
    <div class="header-center">
        <p class="header-ar">مكتب التكوين المهني و إنعاش الشغل</p>
        <p class="header-fr">Office de la formation professionnelle et de la promotion du travail</p>
    </div>
    <img src="{{ asset('images/logo-ofppt.png') }}" class="header-logo">
</div>

            <div class="meta">
                <div><span data-i18n-app="trainerNameLabel">Nom du Formateur</span> : <b>{{ strtoupper($formateur->nom ?? '') }} {{ strtoupper($formateur->prenom ?? '') }}</b></div>
                <div><span data-i18n-app="weeklyHoursLabel">Masse Horaire Hebdomadaire</span> : <b>{{ rtrim(rtrim(number_format($totalHeures, 1), '0'), '.') }}h</b></div>
                <div><span data-i18n-app="trainingYearLabel">Année de Formation</span> : <b>2025 / 2026</b></div>
            </div>

            <div class="w-full overflow-x-auto custom-scrollbar">
                <table class="table" style="min-width:450px;">
                    <thead>
                        <tr>
                            <th class="day" data-i18n-app="dayHourHeader">Jour / Horaire</th>
                            <th><div class="times"><span>08:30</span><span>11:00</span></div></th>
                            <th><div class="times"><span>11:00</span><span>13:30</span></div></th>
                            <th><div class="times"><span>13:30</span><span>16:00</span></div></th>
                            <th><div class="times"><span>16:00</span><span>18:30</span></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jours as $j)
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
                                    $dayKey = $dayMap[$j] ?? null;
                                @endphp
                                <td class="day" @if($dayKey) data-i18n-app="{{ $dayKey }}" @endif>{{ $j }}</td>
                                @foreach($creneaux as $c)
                                    <td>
                                        @if(isset($emploi[$j][$c]))
                                            @php
                                                $seance = $emploi[$j][$c];
                                                $isAbsent = !($seance->formateur_present ?? true);
                                                $isDistance = (($seance->mode ?? 'presentiel') === 'distance');
                                                $groupeCode = $seance->groupe->code ?? 'N/A';
                                            @endphp
                                            <div class="slot" style="@if($isAbsent) background:#facc15 !important; color:#1f2937 !important; @elseif($isDistance) background:#1f3648 !important; color:#ffffff !important; @else background:#4d8cc3 !important; color:#ffffff !important; @endif">
                                                
                                                <div style="font-weight:800; font-size: 6px; margin-bottom: 2px;"><span>Groupe : </span>{{ $groupeCode }}</div>
                                                
                                                @if($isAbsent)
                                                    <div style="color:#7c2d12; font-weight:800;">ABSENT</div>
                                                @elseif($isDistance)
                                                    <div style="font-weight:700;">A distance</div>
                                                @else
                                                    <div style="font-weight:700;">SALLE : {{ $seance->salle->code ?? '' }}</div>
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

            <div class="btn-print no-print">
                <button onclick="window.print()"> <span data-i18n-app="printTimetableBtn">Imprimer emplois</span></button>
            </div>
        </div>
    </div>
</x-app-layout>