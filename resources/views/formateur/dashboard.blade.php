<x-app-layout>
    <style>
        body { font-family: Trebuchet MS, Arial, sans-serif; }

        .emploi-shell-wrap {
            background: #eef2f7;
            padding: 12px 8px;
            box-sizing: border-box;
            width: 100%;
        }

        .emploi-fit-stage {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .paper {
            width: 100%;
            max-width: 900px;
            margin: 0 auto 12px;
            background: white;
            padding: 15px;
            border-radius: 12px;
            border: 1px solid #d1d5db;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            box-sizing: border-box;
        }

        .edt-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            border: 1px solid #e5e7eb;
            padding: 10px;
            margin-bottom: 12px;
        }

        .header-logo {
            height: 50px;
            width: auto;
            object-fit: contain;
            flex-shrink: 0;
        }

        .header-center {
            text-align: center;
            flex: 1;
            min-width: 0;
        }

        .header-ar {
            font-size: 16px;
            margin: 0;
            font-weight: 700;
            color: #111827;
        }

        .header-fr {
            font-size: 14px;
            margin: 5px 0 0;
            color: #374151;
            font-weight: 500;
        }

        .meta {
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
            font-weight: 600;
        }

        .meta b {
            color: #1e3a8a;
            font-size: 15px;
            margin-left: 5px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .table th {
            background-color: #31a9c7 !important;
            color: #fff !important;
            border: 1px solid #cbd5e1;
            padding: 8px;
            font-size: 14px;
            font-weight: 700;
        }

        .table td {
            border: 1px solid #cbd5e1;
            height: 75px;
            text-align: center;
            vertical-align: middle;
            background: #ffffff;
            padding: 0 !important;
            font-size: 12px;
            color: #1f2937;
        }

        .day {
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
            padding: 4px;
            gap: 2px;
            font-size: 10px;
            text-transform: uppercase;
            line-height: 1.15;
        }

        .slot-title {
            font-weight: 800;
            font-size: 9px;
            margin-bottom: 0;
        }

        .slot-room,
        .slot-status {
            font-size: 8px;
            font-weight: 700;
            line-height: 1.1;
        }

        .slot-label { font-weight: 700; }

        .times {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            padding: 0 5px;
            font-weight: 700;
        }

        .btn-print {
            margin-top: 20px;
            text-align: center;
        }

        .btn-print button {
            background: #1e293b;
            color: white;
            padding: 12px 40px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 700;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar { height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }

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

        body.theme-dark .table td { background: #f3f4f6; }

        @media (max-width: 768px) {
            .emploi-shell-wrap { padding: 8px 4px; }
            .paper { padding: 6px; }
            .table { min-width: 360px; }
            .header-logo { height: 34px; }
            .header-ar { font-size: 12px; }
            .header-fr { font-size: 10px; }
            .meta { font-size: 10px; padding: 5px 8px; gap: 3px; }
            .meta b { font-size: 12px; }
            .table th { font-size: 9px; padding: 3px; }
            .table td { height: 50px; font-size: 9px; }
            .day { width: 55px; font-size: 9px; }
            .slot { font-size: 8px; padding: 2px; gap: 1px; }
            .slot-title { font-size: 8px; }
            .slot-room, .slot-status { font-size: 7px; }
            .times { font-size: 8px; padding: 0 2px; }
            .btn-print button { width: auto; padding: 10px 22px; font-size: 13px; }
        }

        @media (max-width: 480px) {
            .paper {
                width: calc(100% - 12px);
                margin: 6px auto;
                padding: 6px;
            }
            .table { min-width: 280px; }
            .header-logo { height: 25px; }
            .header-ar { font-size: 5px; }
            .header-fr { font-size: 6px; }
            .meta { font-size: 6px; padding: 2px 4px; gap: 2px; }
            .meta b { font-size: 7px; }
            .table th { font-size: 6px; padding: 1px; height: 22px; }
            .table td { height: 30px; font-size: 6px; }
            .day { width: 36px; font-size: 6px; }
            .slot { font-size: 5px; padding: 1px; gap: 0; }
            .slot-title { font-size: 5px; }
            .slot-room, .slot-status { font-size: 5px; }
            .times { font-size: 5px; padding: 0 1px; }
            .btn-print button { width: 100%; padding: 10px 14px; font-size: 12px; }
        }

        @media print {
            .no-print, nav, aside { display: none !important; }
            @page { size: A4 landscape; margin: 5mm; }
            .paper {
                width: 100% !important;
                margin: 0 !important;
                border: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
                border-radius: 0 !important;
            }
            .table th, .slot {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
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

<div class="emploi-shell-wrap">
    <div class="emploi-fit-stage">
    <div id="emploi-paper" class="paper shadow-lg rounded-sm">
            <div class="edt-header">
    <img src="/images/logo-cmc.png" class="header-logo" alt="Logo CMC">
    <div class="header-center">
        <p class="header-ar">مكتب التكوين المهني و إنعاش الشغل</p>
        <p class="header-fr">Office de la formation professionnelle et de la promotion du travail</p>
    </div>
    <img src="/images/logo-ofppt.png" class="header-logo" alt="Logo OFPPT">
</div>

            <div class="meta">
                <div><span data-i18n-app="trainerNameLabel">Nom du Formateur</span> : <b>{{ strtoupper($formateur->nom ?? '') }} {{ strtoupper($formateur->prenom ?? '') }}</b></div>
                <div><span data-i18n-app="weeklyHoursLabel">Masse Horaire Hebdomadaire</span> : <b>{{ rtrim(rtrim(number_format($totalHeures, 1), '0'), '.') }}h</b></div>
                <div><span data-i18n-app="trainingYearLabel">Année de Formation</span> : <b>2025 / 2026</b></div>
            </div>

            <div class="w-full overflow-x-auto custom-scrollbar" style="-webkit-overflow-scrolling:touch;">
                <table class="table">
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
                                                $salleCode = $seance->salle->code ?? '-';
                                            @endphp
                                            <div class="slot" style="@if($isAbsent) background:#facc15 !important; color:#1f2937 !important; @elseif($isDistance) background:#1f3648 !important; color:#ffffff !important; @else background:#4d8cc3 !important; color:#ffffff !important; @endif">
                                                <div class="slot-title"><span class="slot-label" data-i18n-app="groupLabelMeta">Groupe</span> : {{ $groupeCode }}</div>
                                                <div class="slot-room"><span class="slot-label" data-i18n-app="salleLabel">Salle</span> : {{ $salleCode }}</div>
                                                
                                                @if($isAbsent)
                                                    <div class="slot-status" style="color:#7c2d12; font-weight:800;" data-i18n-app="statusAbsent">ABSENT</div>
                                                @elseif($isDistance)
                                                    <div class="slot-status" style="font-weight:700;" data-i18n-app="statusDistance">A distance</div>
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
                <button type="button" onclick="downloadTimetablePdf()"> <span data-i18n-app="savePdfBtn">Enregistrer PDF</span></button>
            </div>
        </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var paper = document.getElementById('emploi-paper');
            if (paper) {
                paper.style.transform = 'none';
                paper.style.width = '';
                paper.style.maxWidth = '';
            }
        });

        function downloadTimetablePdf() {
            var paper = document.getElementById('emploi-paper');
            if (!paper) return;

            paper.querySelectorAll('.custom-scrollbar, [style*="overflow-x:auto"], [style*="overflow-x: auto"]').forEach(function (node) {
                node.scrollLeft = 0;
            });

            window.print();
        }
    </script>
</x-app-layout>