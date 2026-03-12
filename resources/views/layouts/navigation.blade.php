<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        
        <div class="flex lg:hidden justify-between items-center h-16">
            <div class="shrink-0 flex items-center">
                <a href="{{ Auth::check() ? (Auth::user()->role === 'admin' ? route('dashboard') : route('formateur.dashboard')) : '#' }}">
                    <img src="{{ asset('images/logo-cmc.png') }}" alt="Logo CMC" class="block h-8 w-auto object-contain" />
                </a>
            </div>

            <div class="flex flex-1 justify-center gap-3 px-2 overflow-x-auto">
                @if(Auth::check() && Auth::user()->role === 'formateur')
                    <a href="{{ route('formateur.dashboard') }}" class="text-[11px] font-bold text-gray-600 hover:text-blue-600 leading-tight text-center whitespace-nowrap px-1 {{ request()->routeIs('formateur.dashboard') ? 'text-blue-600' : '' }}">Mon<br>Emploi</a>
                    <a href="{{ route('formateur.emploi.view') }}" class="text-[11px] font-bold text-gray-600 hover:text-blue-600 leading-tight text-center whitespace-nowrap px-1 {{ request()->routeIs('formateur.emploi.view') ? 'text-blue-600' : '' }}">Emplois<br>Groupe</a>
                    <a href="{{ route('formateur.contact-admin.create') }}" class="text-[11px] font-bold text-gray-600 hover:text-blue-600 leading-tight text-center whitespace-nowrap px-1 {{ request()->routeIs('formateur.contact-admin.*') ? 'text-blue-600' : '' }}">Contacter<br>Admin</a>
                @endif
            </div>

            <div class="relative" x-data="{ userOpen: false }">
                <button @click="userOpen = !userOpen" class="flex items-center ui-avatar-fallback bg-gray-100 text-gray-700 h-9 w-9 rounded-full justify-center font-bold border border-gray-200 focus:outline-none">
                    {{ mb_strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}
                </button>

                <div x-show="userOpen" @click.outside="userOpen = false" class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50" style="display: none;">
                    <div class="px-3 pb-2 border-b border-gray-100 mb-2">
                        <input type="text" placeholder="Rechercher..." class="w-full text-sm border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 py-1.5" />
                    </div>

                    <a href="{{ route('settings.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Paramètres</a>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Mon Profil</a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Déconnexion</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="hidden lg:flex justify-between items-center h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ Auth::check() ? (Auth::user()->role === 'admin' ? route('dashboard') : route('formateur.dashboard')) : '#' }}">
                        <img src="{{ asset('images/logo-cmc.png') }}" alt="Logo CMC" class="block h-9 w-auto object-contain" />
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex flex-1 justify-center px-4 lg:px-8">
                <div class="ui-search-wrap w-80 md:w-96">
                    <svg class="ui-search-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="11" cy="11" r="6" stroke="currentColor" stroke-width="1.8" />
                    </svg>
                    <input id="ui-nav-search" type="search" class="ui-search-input" placeholder="Rechercher..." autocomplete="off" />
                    <span class="ui-search-shortcut">Ctrl+K</span>
                </div>
            </div>

            <div class="flex items-center gap-2 me-2 sm:me-3">
                @auth
                    <button class="ui-icon-btn" title="Notifications">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                            <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                        </svg>
                    </button>

                    <a href="{{ route('settings.theme') }}" class="ui-icon-btn hover:text-blue-600 transition-colors" title="Paramètres">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3" />
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06-.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z" />
                        </svg>
                    </a>

                    <a href="{{ route('profile.edit') }}" class="ui-avatar-fallback hover:opacity-80 transition-opacity" title="Mon profil">
                        {{ mb_strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="ms-1">
                        @csrf
                        <button type="submit" class="ui-icon-btn hover:text-red-600" title="Déconnexion">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                <polyline points="16 17 21 12 16 7" />
                                <line x1="21" y1="12" x2="9" y2="12" />
                            </svg>
                        </button>
                    </form>
                @endauth
            </div>
        </div>
</nav>