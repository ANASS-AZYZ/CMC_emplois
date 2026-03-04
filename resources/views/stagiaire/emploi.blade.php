<x-guest-layout>
    <style>
        /* ===== GLOBAL STYLE (COMPACT) ===== */
        body {
            background: #f8fafc;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .print-container {
            width: 1080px;
            margin: 10px auto;
            background: white;
            padding: 10px 20px;
            border: 1px solid #dee2e6;
        }

        /* ===== HEADER IDENTIQUE AU PDF ===== */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            border: 1px solid #dee2e6;
        }

        .header-table td {
            border: 1px solid #dee2e6;
            padding: 5px;
            text-align: center;
            vertical-align: middle;
            height: auto;
        }

        .header-center h1 {
            font-size: 20px;
            margin: 0;
            font-weight: bold;
            color: #333;
        }

        .header-center p {
            font-size: 13px;
            margin: 2px 0;
            color: #555;
            font-weight: 600;
        }

        /* ===== INFO BAR COMPACT ===== */
        .info-bar {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* ===== TABLEAU D'EMPLOI (HEIGHT REDUIT) ===== */
        .emploi-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .emploi-table th {
            background-color: #31a9c7 !important; /* Bleu Header */
            color: white !important;
            border: 1px solid #dee2e6;
            padding: 2px;
            font-size: 13px;
            height: 35px;
        }

        .emploi-table td {
            border: 1px solid #dee2e6;
            height: 60px; /* Height sghira bhal l-pdf */
            text-align: center;
            vertical-align: middle;
            font-size: 11px;
            padding: 0 !important;
        }

        .day-col {
            background-color: #f8f9fa;
            font-weight: bold;
            width: 110px;
        }

        /* ===== SESSION BOX ===== */
        .session-box {
            background-color: #5b84c1 !important; /* Bleu Case */
            color: white !important;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2px;
            line-height: 1.3;
        }

        .session-box b { font-size: 11px; }

        .time-header {
            display: flex;
            justify-content: space-between;
            padding: 0 10px;
            font-size: 13px;
        }

        /* ===== PRINT CONFIG ===== */
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .print-container { width: 100% !important; margin: 0; border: none; }
            @page { size: A4 landscape; margin: 5mm; }
            th, .session-box { 
                -webkit-print-color-adjust: exact !important; 
                print-color-adjust: exact !important; 
            }
        }
    </style>

    <div class="no-print" style="width:1080px; margin:20px auto;">
        <div style="background:white; padding:15px; border:1px solid #ddd; border-radius:8px;">
            <form action="{{ route('stagiaire.emploi') }}" method="GET" style="display:flex; gap:20px; align-items:center;">
                <label style="font-weight:bold;">GROUPE :</label>
                <select name="groupe_id" style="padding:8px; border:1px solid #31a9c7; border-radius:5px;">
                    <option value="">-- Sélectionner --</option>
                    @foreach($groupes as $g)
                        <option value="{{ $g->id }}" {{ $selectedGroupe == $g->id ? 'selected' : '' }}>{{ $g->code }}</option>
                    @endforeach
                </select>
                <button type="submit" style="background:#1e3a8a; color:white; padding:8px 30px; border:none; border-radius:5px; cursor:pointer; font-weight:bold;">Afficher</button>
            </form>
        </div>
    </div>

    @if($selectedGroupe)
        @php
            $currentGroupe = $groupes->find($selectedGroupe);
            // Hesab l-masa l-horayria dial l-groupe [cite: 27]
            $totalSeances = 0;
            foreach($jours as $j) {
                foreach($creneaux as $c) { if(isset($emploi[$j][$c])) $totalSeances++; }
            }
            $totalHeures = $totalSeances * 2.5;
        @endphp

        <div class="print-container">
            <table class="header-table">
                <tr>
                    <td style="width:200px;">
                        <img src="{{ asset('images/logo-cmc.png') }}" style="height:70px;">
                    </td>
                    <td class="header-center">
                        <h1>مكتب التكوين المهني و إنعاش الشغل </h1>
                        <p>Office de la formation professionnelle et de la promotion du travail [cite: 25]</p>
                    </td>
                    <td style="width:200px;">
                        <img src="{{ asset('images/logo-ofppt.png') }}" style="height:60px;">
                    </td>
                </tr>
            </table>

            <div class="info-bar">
                <div>Groupe : <span style="font-size:16px;">{{ $currentGroupe->code }}</span> </div>
                <div>Masse Horaire Hebdomadaire : <b>{{ $totalHeures }}h</b> </div>
                <div>Année de Formation : <b>2025 / 2026</b> </div>
            </div>

            <table class="emploi-table">
                <thead>
                    <tr>
                        <th class="day-col">Jour / Horaire </th>
                        <th><div class="time-header"><span>08:30</span><span>11:00</span></div></th>
                        <th><div class="time-header"><span>11:00</span><span>13:30</span></div></th>
                        <th><div class="time-header"><span>13:30</span><span>16:00</span></div></th>
                        <th><div class="time-header"><span>16:00</span><span>18:30</span></div></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jours as $jour)
                        <tr>
                            <td class="day-col">{{ $jour }} </td>
                            @foreach($creneaux as $creneau)
                                <td>
                                    @if(isset($emploi[$jour][$creneau]))
                                        <div class="session-box">
                                            <div>FORMATEUR : <b>{{ $emploi[$jour][$creneau]->formateur->nom ?? 'N/A' }}</b> </div>
                                            <div>SALLE : <b>{{ $emploi[$jour][$creneau]->salle->code ?? 'N/A' }}</b> </div>
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

            <div class="no-print" style="text-align:center; margin-top:20px;">
                <button onclick="window.print()" style="background:#333; color:white; padding:10px 40px; border:none; border-radius:50px; cursor:pointer; font-weight:bold;">
                    🖨️ Imprimer l'emploi du temps
                </button>
            </div>
        </div>
    @endif
</x-guest-layout>