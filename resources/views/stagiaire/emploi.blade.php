<x-guest-layout>
    <style>
        body {
            background: #eef1f4;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .filter-container {
            background: white;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
        }

        .filter-form {
            display: flex;
            gap: 20px;
            align-items: flex-end;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .filter-group label {
            font-weight: 600;
            color: #4b5563;
            font-size: 14px;
        }

        .filter-input {
            padding: 10px 15px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            min-width: 250px;
            outline: none;
            transition: border-color 0.2s;
        }

        .filter-input:focus {
            border-color: #2563eb;
        }

        .btn-submit {
            background: #2563eb;
            color: white;
            padding: 10px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
            transition: background 0.2s;
        }

        .btn-submit:hover {
            background: #1d4ed8;
        }

        .paper {
            width: 100%;
            max-width: 1300px;
            margin: 0 auto 30px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #d1d5db;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .header {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            border: 1px solid #e5e7eb;
        }

        .header td {
            border: 1px solid #e5e7eb;
            padding: 10px;
            text-align: center;
            vertical-align: middle;
        }

        .header-ar {
            font-size: 18px;
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
            color: white !important;
            border: 1px solid #cbd5e1;
            padding: 8px;
            font-size: 14px;
        }

        .table td {
            border: 1px solid #cbd5e1;
            height: 75px;
            text-align: center;
            background: #ffffff;
        }

        .day-cell {
            background-color: #f1f5f9 !important;
            font-weight: 700;
            width: 120px;
            color: #334155;
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
        }

        .slot-active {
            background-color: #4d8cc3 !important;
            color: white !important;
        }

        .slot-distance {
            background-color: #1f3648 !important;
            color: white !important;
        }

        .slot-absent {
            background-color: #facc15 !important;
            color: #1f2937 !important;
        }

        .times {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            padding: 0 5px;
        }

        .btn-print-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn-print-container button {
            background: #1e293b;
            color: white;
            padding: 12px 40px;
            border-radius: 50px;
            border: none;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: background-color 0.2s;
        }
        .btn-print-container button:hover {
            background: #0f172a;
        }

        /* Mobile & Tablet Optimization */
        @media (max-width: 768px) {
            .filter-container {
                padding: 15px;
            }
            .filter-form {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 12px;
                align-items: end;
            }
            .filter-group label {
                font-size: 13px;
            }
            .filter-input {
                min-width: 0;
                width: 100%;
                font-size: 14px;
                padding: 10px 8px;
            }
            .btn-submit {
                grid-column: span 2;
                width: 100%;
                padding: 12px;
                font-size: 15px;
            }
            .paper {
                padding: 10px;
                overflow-x: auto; /* Allow horizontal scroll for table */
            }
            .table {
                min-width: 700px; /* Force table width to keep shape */
            }
            .header td {
                width: auto !important;
            }
            .header img {
                height: 40px !important; /* Smaller logos */
            }
            .header-ar { font-size: 13px; }
            .header-fr { font-size: 10px; }
            .meta {
                flex-direction: column;
                gap: 8px;
            }
        }

        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .paper { 
                width: 100% !important; 
                max-width: 100% !important;
                border: none !important; 
                box-shadow: none !important;
                padding: 0 !important;
            }
            @page { size: A4 landscape; margin: 1cm; }
        }
    </style>

    <div class="no-print" style="max-width:1300px; margin:30px auto; padding: 0 20px;">
        <div class="filter-container">
            <form action="{{ route('stagiaire.emploi') }}" method="GET" class="filter-form">
                <div class="filter-group">
                    <label>FILIERE</label>
                    <select id="filiere_id" name="filiere_id" class="filter-input">
                        <option value="">-- Sélectionner --</option>
                        @foreach($filieres as $f)
                            <option value="{{ $f->id }}" {{ (string)$selectedFiliere === (string)$f->id ? 'selected' : '' }}>
                                {{ $f->nom }} ({{ $f->niveau }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label>GROUPE</label>
                    <select id="groupe_id" name="groupe_id" class="filter-input">
                        <option value="">-- Sélectionner --</option>
                        @foreach($groupes as $g)
                            <option value="{{ $g->id }}" {{ (string)$selectedGroupe === (string)$g->id ? 'selected' : '' }}>
                                {{ $g->code }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn-submit">Afficher</button>
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
                        <img src="{{ asset('images/logo-cmc.png') }}" style="height:65px;">
                    </td>
                    <td>
                        <p class="header-ar">مكتب التكوين المهني و إنعاش الشغل</p>
                        <p class="header-fr">Office de la formation professionnelle et de la promotion du travail</p>
                    </td>
                    <td style="width:200px;">
                        <img src="{{ asset('images/logo-ofppt.png') }}" style="height:55px;">
                    </td>
                </tr>
            </table>

            <div class="meta">
                <div>Groupe : <b>{{ $currentGroupe->code }}</b></div>
                <div>Masse Horaire Hebdomadaire : <b>{{ number_format($totalHeures, 1) }}h</b></div>
                <div>Année de Formation : <b>2025 / 2026</b></div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th class="day-cell">Jour / Horaire</th>
                        <th><div class="times"><span>08:30</span><span>11:00</span></div></th>
                        <th><div class="times"><span>11:00</span><span>13:30</span></div></th>
                        <th><div class="times"><span>13:30</span><span>16:00</span></div></th>
                        <th><div class="times"><span>16:00</span><span>18:30</span></div></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jours as $jour)
                        <tr>
                            <td class="day-cell">{{ $jour }}</td>
                            @foreach($creneaux as $creneau)
                                <td>
                                    @if(isset($emploi[$jour][$creneau]))
                                        @php
                                            $item = $emploi[$jour][$creneau];
                                            $isAbsent = !($item->formateur_present ?? true);
                                            $isDistance = (($item->mode ?? 'presentiel') === 'distance');
                                            $formateur = trim(($item->formateur->nom ?? '') . ' ' . ($item->formateur->prenom ?? ''));
                                            
                                            $statusClass = 'slot-active';
                                            if($isAbsent) $statusClass = 'slot-absent';
                                            elseif($isDistance) $statusClass = 'slot-distance';
                                        @endphp
                                        <div class="slot {{ $statusClass }}">
                                            <div style="font-weight:800; font-size:12px;">{{ $formateur }}</div>
                                            @if($isAbsent)
                                                <div style="text-decoration: underline;">ABSENT</div>
                                            @elseif($isDistance)
                                                <div>(A distance)</div>
                                            @else
                                                <div style="font-size:11px; opacity:0.9;">{{ $item->salle->code ?? '' }}</div>
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

            <div class="btn-print-container no-print">
                <button onclick="window.print()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 20px; height: 20px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                    </svg>
                    Imprimer l'emploi du temps
                </button>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filiereEl = document.getElementById('filiere_id');
            const groupeEl = document.getElementById('groupe_id');

            if (filiereEl && groupeEl) {
                filiereEl.addEventListener('change', async function () {
                    groupeEl.innerHTML = '<option value="">-- Sélectionner --</option>';
                    if (!this.value) return;

                    try {
                        const response = await fetch('/filieres/' + this.value + '/groupes');
                        const groupes = await response.json();
                        groupes.forEach(g => {
                            const opt = document.createElement('option');
                            opt.value = g.id;
                            opt.textContent = g.code;
                            groupeEl.appendChild(opt);
                        });
                    } catch (e) { console.error("Erreur AJAX"); }
                });
            }
        });
    </script>
</x-guest-layout>