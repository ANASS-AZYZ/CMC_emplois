<div class="sidebar-shell flex flex-col h-screen w-72 shadow-2xl no-print">
    <div class="h-16 px-6 border-b border-gray-200 flex items-center">
        <h1 class="sidebar-brand text-2xl font-black tracking-tight leading-none">DIA-EMPLOIS</h1>
    </div>

    <nav class="flex-1 px-5 py-6 space-y-2 overflow-y-auto">
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('dashboard') }}"
                    class="sidebar-link flex items-center px-4 py-3 text-base rounded-xl font-semibold transition {{ request()->routeIs('dashboard') ? 'sidebar-link-active' : '' }}">
                <i class="fas fa-home mr-3"></i> <span data-i18n-app="navDashboard">Dashboard</span>
            </a>

            <div data-i18n-app="sideResources" class="sidebar-section pt-6 pb-2 px-4 text-sm font-bold uppercase tracking-wider">Ressources</div>
            <a href="{{ route('groupes.index') }}"
                    class="sidebar-link flex items-center px-4 py-3 text-base rounded-xl transition {{ request()->routeIs('groupes.*') ? 'sidebar-link-active' : '' }}">
                <i class="fas fa-users mr-3"></i> <span data-i18n-app="sideGroups">Groupes</span>
            </a>
            <a href="{{ route('salles.index') }}"
                    class="sidebar-link flex items-center px-4 py-3 text-base rounded-xl transition {{ request()->routeIs('salles.*') ? 'sidebar-link-active' : '' }}">
                <i class="fas fa-door-open mr-3"></i> <span data-i18n-app="sideRooms">Salles</span>
            </a>
            <a href="{{ route('formateurs.index') }}"
                    class="sidebar-link flex items-center px-4 py-3 text-base rounded-xl transition {{ request()->routeIs('formateurs.*') ? 'sidebar-link-active' : '' }}">
                <i class="fas fa-chalkboard-teacher mr-3"></i> <span data-i18n-app="sideTrainers">Formateurs</span>
            </a>
            <a href="{{ route('admin.messages.index') }}"
                    class="sidebar-link flex items-center px-4 py-3 text-base rounded-xl transition {{ request()->routeIs('admin.messages.*') ? 'sidebar-link-active' : '' }}">
                <i class="fas fa-inbox mr-3"></i> <span data-i18n-app="sideMessages">Messages</span>
            </a>

            <div data-i18n-app="sidePlanning" class="sidebar-section pt-6 pb-2 px-4 text-sm font-bold uppercase tracking-wider">Planning</div>
            <a href="{{ route('seances.index') }}"
                    class="sidebar-link flex items-center px-4 py-3 text-base rounded-xl transition {{ (request()->routeIs('seances.index') || request()->routeIs('seances.create') || request()->routeIs('seances.edit')) ? 'sidebar-link-active font-semibold' : '' }}">
                <i class="fas fa-calendar-alt mr-3"></i> <span data-i18n-app="sideManageSessions">Gestion Seances</span>
            </a>
            <a href="{{ route('seances.emploi', ['type' => 'groupe']) }}"
                    class="sidebar-link flex items-center px-4 py-3 text-base rounded-xl transition {{ request()->routeIs('seances.emploi') ? 'sidebar-link-active' : '' }}">
                <i class="fas fa-table mr-3"></i> <span data-i18n-app="sideGroupTimetables">Emplois Groupe</span>
            </a>
        @endif

        @if(Auth::user()->role === 'formateur')
            <div data-i18n-app="sideFormateurSpace" class="sidebar-section pt-6 pb-2 px-4 text-sm font-bold uppercase tracking-wider">Espace formateur</div>
            <a href="{{ route('formateur.dashboard') }}"
                    class="sidebar-link flex items-center px-4 py-3 text-base rounded-xl font-semibold transition {{ request()->routeIs('formateur.dashboard') ? 'sidebar-link-active' : '' }}">
                <i class="fas fa-calendar-check mr-3"></i> <span data-i18n-app="navMyTimetable">Mon Emploi</span>
            </a>
            <a href="{{ route('formateur.emploi.view') }}"
                    class="sidebar-link flex items-center px-4 py-3 text-base rounded-xl font-semibold transition {{ request()->routeIs('formateur.emploi.view') ? 'sidebar-link-active' : '' }}">
                <i class="fas fa-table mr-3"></i> <span data-i18n-app="sideGroupTimetables">Emplois du Groupe</span>
            </a>
            <a href="{{ route('formateur.contact-admin.create') }}"
                    class="sidebar-link flex items-center px-4 py-3 text-base rounded-xl font-semibold transition {{ request()->routeIs('formateur.contact-admin.*') ? 'sidebar-link-active' : '' }}">
                <i class="fas fa-envelope mr-3"></i> <span data-i18n-app="sideContactAdmin">Contacter Admin</span>
            </a>
        @endif

        <div class="sidebar-section pt-6 pb-2 px-4 text-sm font-bold uppercase tracking-wider" data-i18n-app="sidePreferences">Preferences</div>
        <a href="{{ route('settings.index') }}"
                class="sidebar-link flex items-center px-4 py-3 text-base rounded-xl transition {{ request()->routeIs('settings.index') ? 'sidebar-link-active' : '' }}">
            <i class="fas fa-cog mr-3"></i> <span data-i18n-app="sideSettings">Parametres</span>
        </a>
    </nav>
</div>