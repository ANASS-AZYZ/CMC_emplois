<div class="flex flex-col h-screen bg-[#0f172a] text-white w-72 shadow-2xl no-print">
    
    <div class="p-8 border-b border-slate-800">
        <h1 class="text-2xl font-black text-blue-400 italic tracking-tighter uppercase">
            CMC Planning
        </h1>
    </div>

    <nav class="flex-1 px-6 py-8 space-y-4">
        
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm font-bold rounded-xl {{ request()->routeIs('dashboard') ? 'bg-blue-600' : 'text-slate-400 hover:bg-slate-800' }}">
                <i class="fas fa-chart-pie mr-3"></i> Dashboard
            </a>

            <div class="pt-4 pb-2 px-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Ressources</div>
            <a href="{{ route('groupes.index') }}" class="flex items-center px-4 py-3 text-sm font-semibold text-slate-300 hover:bg-slate-800 rounded-xl">
                <i class="fas fa-users mr-3"></i> Groupes
            </a>
            <a href="{{ route('salles.index') }}" class="flex items-center px-4 py-3 text-sm font-semibold text-slate-300 hover:bg-slate-800 rounded-xl">
                <i class="fas fa-door-open mr-3"></i> Salles
            </a>
            <a href="{{ route('formateurs.index') }}" class="flex items-center px-4 py-3 text-sm font-semibold text-slate-300 hover:bg-slate-800 rounded-xl">
                <i class="fas fa-chalkboard-user mr-3"></i> Formateurs
            </a>

            <div class="pt-4 pb-2 px-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">Planning</div>
            <a href="{{ route('seances.index') }}" class="flex items-center px-4 py-3 text-sm font-semibold text-slate-300 hover:bg-slate-800 rounded-xl">
                <i class="fas fa-calendar-days mr-3"></i> Gestion Séances
            </a>

            <div class="mt-6 px-2">
                <a href="{{ route('seances.create') }}" class="flex items-center justify-center py-4 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl shadow-xl transition-all">
                    + Ajouter Séance
                </a>
            </div>
        @endif

        @if(Auth::user()->role === 'formateur')
            <div class="bg-slate-800/50 p-2 rounded-2xl space-y-2 border border-slate-700">
                <a href="{{ route('formateur.dashboard') }}" class="flex items-center px-4 py-4 bg-blue-600 text-white font-black rounded-xl shadow-lg shadow-blue-600/20">
                    <i class="fas fa-calendar-check mr-3"></i> Mon Emploi
                </a>

                <a href="{{ route('stagiaire.emploi') }}" class="flex items-center px-4 py-4 text-slate-300 hover:bg-slate-700 rounded-xl transition font-bold">
                    <i class="fas fa-users-viewfinder mr-3 text-blue-400"></i> Emplois des Groupes
                </a>

                <a href="mailto:admin@cmc.ma" class="flex items-center px-4 py-4 text-slate-400 hover:bg-slate-700 rounded-xl transition font-bold">
                    <i class="fas fa-envelope mr-3"></i> Contacter l'Admin
                </a>
            </div>
        @endif

        <div class="pt-10">
            <a href="{{ route('stagiaire.emploi') }}" class="flex items-center px-4 py-3 text-sm font-bold text-slate-500 hover:bg-slate-800 rounded-xl transition">
                <i class="fas fa-search mr-3"></i> Consulter l'Emploi
            </a>
        </div>
    </nav>
</div>