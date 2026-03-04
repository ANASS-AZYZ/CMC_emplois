<x-app-layout>
    <style>
        /* Configuration dyal l-Impression standard OFPPT */
        @media print {
            .no-print { display: none !important; }
            @page { size: A4 landscape; margin: 10mm; }
            body { background: white !important; }
            .print-container { width: 100% !important; margin: 0 !important; padding: 0 !important; box-shadow: none !important; border: none !important; }
            table { width: 100% !important; border: 2px solid black !important; }
            th, td { border: 1px solid black !important; color: black !important; }
            .bg-blue-600 { background-color: #2563eb !important; color: white !important; -webkit-print-color-adjust: exact; }
            .bg-cyan-600 { background-color: #0891b2 !important; color: white !important; -webkit-print-color-adjust: exact; }
        }
    </style>

    <div class="py-0 flex min-h-screen bg-gray-100">
        <div class="w-72 bg-[#0f172a] text-white p-6 no-print shadow-2xl flex flex-col">
            <h2 class="text-2xl font-black text-blue-400 mb-10 italic uppercase tracking-tighter border-b border-slate-700 pb-4">
                CMC Planning
            </h2>
            
            <nav class="space-y-4 flex-1">
                <a href="{{ route('formateur.dashboard') }}" 
                   class="flex items-center gap-3 p-4 {{ request()->routeIs('formateur.dashboard') ? 'bg-blue-600 shadow-blue-500/50' : 'hover:bg-slate-800 text-slate-400' }} rounded-xl font-bold shadow-lg transition-all duration-200">
                    <span class="text-xl">📅</span> Mon Emploi
                </a>

                <a href="{{ route('stagiaire.emploi') }}" 
                   class="flex items-center gap-3 p-4 hover:bg-slate-800 rounded-xl transition text-slate-400 font-bold">
                    <span class="text-xl">👥</span> Emplois des Groupes
                </a>

                <a href="mailto:admin@cmc.ma?subject=Demande de Modification" 
                   class="flex items-center gap-3 p-4 hover:bg-slate-800 rounded-xl transition text-slate-400 font-bold">
                    <span class="text-xl">📧</span> Contacter l'Admin
                </a>
            </nav>

            <div class="pt-6 border-t border-slate-700 text-[10px] text-slate-500 text-center uppercase tracking-widest">
                © 2026 Pôle Digital & IA
            </div>
        </div>

        <div class="flex-1 p-10 overflow-y-auto">
            <div class="bg-white p-10 shadow-2xl border-t-[12px] border-blue-900 rounded-lg print-container relative overflow-hidden">
                
                <div class="flex justify-between items-center mb-10 pb-6 border-b-2 border-gray-100">
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center text-[10px] text-gray-500 italic">Logo CMC</div>
                        <p class="text-[8px] mt-1 font-bold">Cité des Métiers et des Compétences</p>
                    </div>
                    
                    <div class="text-center">
                        <h1 class="text-2xl font-black uppercase tracking-widest text-gray-800">Emploi du Temps Formateur</h1>
                        <p class="text-blue-700 font-extrabold text-2xl mt-2 underline underline-offset-8 decoration-4 italic uppercase tracking-tighter">
                            {{ $formateur->prenom }} {{ $formateur->nom }}
                        </p>
                    </div>

                    <div class="flex flex-col items-center text-right">
                        <div class="w-16 h-8 bg-gray-200 rounded flex items-center justify-center text-[8px] text-gray-500 font-bold">OFPPT</div>
                        <p class="text-[7px] mt-1 uppercase font-medium">La Voie de l'Avenir</p>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-6 mb-8 bg-slate-50 p-5 rounded-lg border-2 border-slate-100 font-black text-slate-700 uppercase text-[11px] tracking-tight">
                    <div class="flex items-center gap-2">
                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded">MATRICULE :</span>
                        <span class="text-blue-900 text-sm">{{ $formateur->matricule }}</span>
                    </div>
                    <div class="text-center self-center underline decoration-blue-200 decoration-2">
                        Année de Formation : 2025 / 2026
                    </div>
                    <div class="text-right self-center italic text-slate-400">
                        Masse Horaire : Hebdomadaire (25h)
                    </div>
                </div>

                <div class="overflow-x-auto border-2 border-gray-200 rounded-xl">
                    <table class="w-full border-collapse">
                        <thead class="bg-cyan-700 text-white uppercase text-[11px] font-black tracking-widest">
                            <tr class="divide-x-2 divide-cyan-600">
                                <th class="p-5 w-40 italic bg-cyan-800">Jour / Horaire</th>
                                <th class="p-5">08:30 - 11:00 (S1)</th>
                                <th class="p-5">11:00 - 13:30 (S2)</th>
                                <th class="p-5">13:30 - 16:00 (S3)</th>
                                <th class="p-5">16:00 - 18:30 (S4)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y-2 divide-gray-100">
                            @foreach($jours as $j)
                                <tr class="h-28 divide-x-2 divide-gray-100 hover:bg-slate-50 transition-colors">
                                    <td class="bg-slate-100 font-black text-center text-blue-900 italic uppercase text-xs border-r-2 border-gray-200">
                                        {{ $j }}
                                    </td>
                                    @foreach($creneaux as $c)
                                        <td class="p-1 text-center relative min-w-[180px]">
                                            @if(isset($emploi[$j][$c]))
                                                <div class="absolute inset-1 bg-blue-600 text-white flex flex-col justify-center items-center rounded-lg shadow-md transform hover:scale-[1.02] transition-transform cursor-default">
                                                    <p class="font-black text-sm uppercase mb-1">{{ $emploi[$j][$c]->groupe->code }}</p>
                                                    <div class="w-3/4 h-[1px] bg-blue-400 opacity-40 mb-1"></div>
                                                    <p class="text-[10px] font-bold tracking-widest italic opacity-90 uppercase">
                                                        Salle: {{ $emploi[$j][$c]->salle->code }}
                                                    </p>
                                                </div>
                                            @else 
                                                <span class="text-gray-200 text-2xl font-thin">—</span> 
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-12 text-center no-print">
                    <button onclick="window.print()" 
                            class="bg-blue-700 hover:bg-blue-800 text-white px-12 py-4 rounded-full font-black text-sm uppercase tracking-widest shadow-xl hover:shadow-blue-500/20 transition-all active:scale-95 flex items-center gap-3 mx-auto">
                        <span>🖨️</span> Imprimer mon Emploi du temps
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>