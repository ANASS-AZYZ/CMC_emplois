<x-guest-layout>
    <style>
        body {
            background: #e5e7eb;
            font-family: Trebuchet MS, Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .paper {
            width: 1120px;
            margin: 10px auto;
            background: white;
            padding: 8px;
            border: 1px solid #cfd4da;
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
            font-size: 14px;
            font-weight: 600;
            margin: 4px 0 8px;
            padding: 0 6px;
        }

        .meta b {
            font-size: 16px;
            margin-left: 6px;
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
            padding: 0 !important;
            background: #f5f5f5;
        }

        .day {
            background-color: #d7e2e9 !important;
            font-weight: bold;
            width: 110px;
            font-size: 13px;
        }

        .slot {
            background-color: #5c80b9 !important;
            color: white !important;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3px;
            line-height: 1.25;
            font-size: 11px;
            text-transform: uppercase;
        }

        .slot b {
            font-size: 11px;
            font-weight: 700;
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

        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .paper { width: 100% !important; margin: 0 !important; border: 0 !important; padding: 0 !important; }
            @page { size: A4 landscape; margin: 5mm; }
            .table th, .slot {
                -webkit-print-color-adjust: exact !important; 
                print-color-adjust: exact !important; 
            }
            .table td {
                height: 52px;
            }
        }
    </style>

    <div class="no-print" style="width:1080px; margin:20px auto;">
        <div style="background:white; padding:15px; border:1px solid #ddd; border-radius:8px;">
            <form action="{{ route('stagiaire.emploi') }}" method="GET" style="display:flex; gap:20px; align-items:center; flex-wrap:wrap;">
                <label style="font-weight:bold;">FILIERE :</label>
                <select id="filiere_id" name="filiere_id" style="padding:8px; border:1px solid #31a9c7; border-radius:5px; min-width:260px;">
                    <option value="">-- Sélectionner --</option>
                    @foreach($filieres as $f)
                        <option value="{{ $f->id }}" {{ (string)$selectedFiliere === (string)$f->id ? 'selected' : '' }}>{{ $f->nom }} ({{ $f->niveau }})</option>
                    @endforeach
                </select>

                <label style="font-weight:bold;">GROUPE :</label>
                <select id="groupe_id" name="groupe_id" style="padding:8px; border:1px solid #31a9c7; border-radius:5px; min-width:200px;">
                    <option value="">-- Sélectionner --</option>
                    @foreach($groupes as $g)
                        <option value="{{ $g->id }}" {{ (string)$selectedGroupe === (string)$g->id ? 'selected' : '' }}>{{ $g->code }}</option>
                    @endforeach
                </select>
                <button type="submit" style="background:#1e3a8a; color:white; padding:8px 30px; border:none; border-radius:5px; cursor:pointer; font-weight:bold;">Afficher</button>
            </form>
        </div>
    </div>

    @if($selectedGroupe)
        @php
            $currentGroupe = $groupes->find($selectedGroupe);
            $totalSeances = 0;
            foreach($jours as $j) {
                foreach($creneaux as $c) { if(isset($emploi[$j][$c])) $totalSeances++; }
            }
            $totalHeures = $totalSeances * 2.5;
        @endphp

        <div class="paper">
            <table class="header">
                <tr>
                    <td style="width:200px;">
                        <img src="{{ asset('images/logo-cmc.png') }}" style="height:70px; object-fit:contain;">
                    </td>
                    <td>
                        <p class="header-ar">مكتب التكوين المهني و إنعاش الشغل</p>
                        <p class="header-fr">Office de la formation professionnelle et de la promotion du travail</p>
                    </td>
                    <td style="width:200px;">
                        <img src="{{ asset('images/logo-ofppt.png') }}" style="height:60px; object-fit:contain;">
                    </td>
                </tr>
            </table>

            <div class="meta">
                <div>Groupe : <b>{{ $currentGroupe->code }}</b></div>
                <div>Masse Horaire Hebdomadaire : <b>{{ rtrim(rtrim(number_format($totalHeures, 1), '0'), '.') }}h</b></div>
                <div>Année de Formation : <b>2025 / 2026</b></div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th class="day">Jour / Horaire</th>
                        <th><div class="times"><span>08:30</span><span>11:00</span></div></th>
                        <th><div class="times"><span>11:00</span><span>13:30</span></div></th>
                        <th><div class="times"><span>13:30</span><span>16:00</span></div></th>
                        <th><div class="times"><span>16:00</span><span>18:30</span></div></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jours as $jour)
                        <tr>
                            <td class="day">{{ $jour }}</td>
                            @foreach($creneaux as $creneau)
                                <td>
                                    @if(isset($emploi[$jour][$creneau]))
                                        <div class="slot">
                                            <div>FORMATEUR : {{ ($emploi[$jour][$creneau]->formateur->nom ?? '') }} {{ ($emploi[$jour][$creneau]->formateur->prenom ?? '') }}</div>
                                            <div>SALLE : {{ $emploi[$jour][$creneau]->salle->code ?? 'N/A' }}</div>
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

            <div class="btn-print no-print">
                <button onclick="window.print()">
                    🖨️ Imprimer l'emploi du temps
                </button>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filiereEl = document.getElementById('filiere_id');
            const groupeEl = document.getElementById('groupe_id');
            if (!filiereEl || !groupeEl) {
                return;
            }

            filiereEl.addEventListener('change', async function () {
                groupeEl.innerHTML = '<option value="">-- Sélectionner --</option>';
                if (!filiereEl.value) {
                    return;
                }

                const response = await fetch('/filieres/' + filiereEl.value + '/groupes');
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
        });
    </script>
</x-guest-layout>
