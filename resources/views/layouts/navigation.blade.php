<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    @php
        $authUser = Auth::user();
        $userInitial = $authUser && $authUser->name ? mb_strtoupper(mb_substr($authUser->name, 0, 1)) : '?';
        $avatarUrl = $authUser?->avatar_url;
    @endphp
    <div class="w-full px-4 sm:px-6 lg:px-8">
        
        <div class="flex lg:hidden justify-between items-center h-16 gap-1">
            <div class="shrink-0 flex items-center">
                <a href="{{ Auth::check() ? (Auth::user()->role === 'admin' ? route('dashboard') : route('formateur.dashboard')) : '#' }}">
                    <img src="/images/logo-cmc.png" alt="Logo CMC" class="block h-8 w-auto object-contain" />
                </a>
            </div>

            <div class="flex flex-1 justify-center gap-2 px-1 overflow-x-auto">
                @if(Auth::check() && Auth::user()->role === 'formateur')
                    <a href="{{ route('formateur.dashboard') }}" class="text-[10px] sm:text-[11px] font-medium text-gray-600 hover:text-blue-600 leading-tight text-center whitespace-nowrap px-1 {{ request()->routeIs('formateur.dashboard') ? 'text-blue-600' : '' }}"><span data-i18n-app="navMyTimetable">Mon Emploi</span></a>
                    <a href="{{ route('formateur.emploi.view') }}" class="text-[10px] sm:text-[11px] font-medium text-gray-600 hover:text-blue-600 leading-tight text-center whitespace-nowrap px-1 {{ request()->routeIs('formateur.emploi.view') ? 'text-blue-600' : '' }}"><span data-i18n-app="sideGroupTimetables">Emplois Groupe</span></a>
                    <a href="{{ route('formateur.contact-admin.create') }}" class="text-[10px] sm:text-[11px] font-medium text-gray-600 hover:text-blue-600 leading-tight text-center whitespace-nowrap px-1 {{ request()->routeIs('formateur.contact-admin.*') ? 'text-blue-600' : '' }}"><span data-i18n-app="sideContactAdmin">Contacter Admin</span></a>
                @endif
            </div>

            <div class="relative">
                <button id="user-menu-toggle-mobile" type="button" class="flex items-center ui-avatar-fallback bg-gray-100 text-gray-700 h-9 w-9 rounded-full justify-center font-bold border border-gray-200 focus:outline-none" title="Menu utilisateur" aria-label="Menu utilisateur">
                    @if($avatarUrl)
                        <img src="{{ $avatarUrl }}" alt="Avatar" class="h-full w-full rounded-full object-cover" onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');">
                        <span class="hidden flex h-full w-full items-center justify-center">{{ $userInitial }}</span>
                    @else
                        {{ $userInitial }}
                    @endif
                </button>

                <div id="user-menu-mobile" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                    <div class="px-3 pb-2 border-b border-gray-100 mb-2">
                        <input type="text" data-i18n-nav-placeholder="navSearchPlaceholder" placeholder="Rechercher..." class="w-full text-sm border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 py-1.5" />
                    </div>

                    <a href="{{ route('settings.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50" data-i18n-nav="navSettings">Paramètres</a>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50" data-i18n-nav="navProfile">Mon Profil</a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50" data-i18n-nav="navLogout">Déconnexion</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="hidden lg:flex justify-between items-center h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ Auth::check() ? (Auth::user()->role === 'admin' ? route('dashboard') : route('formateur.dashboard')) : '#' }}">
                        <img src="/images/logo-cmc.png" alt="Logo CMC" class="block h-9 w-auto object-contain" />
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex flex-1 justify-center px-4 lg:px-8">
                <div class="ui-search-wrap w-80 md:w-96">
                    <svg class="ui-search-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="11" cy="11" r="6" stroke="currentColor" stroke-width="1.8" />
                    </svg>
                    <input id="ui-nav-search" type="search" class="ui-search-input" data-i18n-nav-placeholder="navSearchPlaceholder" placeholder="Rechercher..." autocomplete="off" />
                    <span class="ui-search-shortcut">Ctrl+K</span>
                </div>
            </div>

            <div class="flex items-center gap-2 me-2 sm:me-3">
                @auth
            <div class="relative" x-data="{ notifOpen: false }">
                <button @click="notifOpen = !notifOpen" class="ui-icon-btn" title="Notifications">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                        <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                    </svg>
                </button>

                <div x-show="notifOpen" @click.outside="notifOpen = false"
                    class="absolute right-0 mt-2 w-72 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50"
                    style="display:none;">
                    <div class="px-4 py-2 border-b border-gray-100 mb-1">
                        <span class="font-semibold text-sm text-gray-700" data-i18n-app="notificationsTitle">Notifications</span>
                    </div>
                    <div class="px-4 py-6 text-center text-sm text-gray-400">
                        <span data-i18n-app="noNotifications">Aucune notification pour le moment</span>
                    </div>
                </div>
            </div>

                    <a href="{{ route('settings.theme') }}" class="ui-icon-btn hover:text-blue-600 transition-colors" title="Paramètres">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3" />
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06-.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z" />
                        </svg>
                    </a>

                    <div class="relative">
                        <button id="user-menu-toggle-desktop" type="button" class="ui-avatar-fallback relative h-9 w-9 rounded-full overflow-hidden border border-gray-200 bg-gray-100 text-gray-700 hover:opacity-80 transition-opacity flex items-center justify-center font-bold" title="Menu utilisateur" aria-label="Menu utilisateur">
                            @if($avatarUrl)
                                <img src="{{ $avatarUrl }}" alt="Avatar" class="absolute inset-0 h-full w-full object-cover" onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');">
                                <span class="hidden flex h-full w-full items-center justify-center">{{ $userInitial }}</span>
                            @else
                                {{ $userInitial }}
                            @endif
                        </button>

                        <div id="user-menu-desktop" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                            <div class="px-3 pb-2 border-b border-gray-100 mb-2">
                                <input type="text" data-i18n-nav-placeholder="navSearchPlaceholder" placeholder="Rechercher..." class="w-full text-sm border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 py-1.5" />
                            </div>

                            <a href="{{ route('settings.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50" data-i18n-nav="navSettings">Paramètres</a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50" data-i18n-nav="navProfile">Mon Profil</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50" data-i18n-nav="navLogout">Déconnexion</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var pairs = [
            {
                toggle: document.getElementById('user-menu-toggle-mobile'),
                menu: document.getElementById('user-menu-mobile')
            },
            {
                toggle: document.getElementById('user-menu-toggle-desktop'),
                menu: document.getElementById('user-menu-desktop')
            }
        ];

        var isArabic = (localStorage.getItem('cmc_lang') || '').toLowerCase() === 'ar';
        var isRtl = document.documentElement.getAttribute('dir') === 'rtl' || isArabic;

        pairs.forEach(function (pair) {
            if (!pair.menu) return;
            if (isRtl) {
                pair.menu.classList.remove('right-0');
                pair.menu.classList.add('left-0');
            } else {
                pair.menu.classList.remove('left-0');
                pair.menu.classList.add('right-0');
            }
        });

        function closeAllMenus() {
            pairs.forEach(function (pair) {
                if (pair.menu) pair.menu.classList.add('hidden');
            });
        }

        pairs.forEach(function (pair) {
            if (!pair.toggle || !pair.menu) return;

            pair.toggle.addEventListener('click', function (e) {
                e.stopPropagation();
                var isHidden = pair.menu.classList.contains('hidden');
                closeAllMenus();
                if (isHidden) pair.menu.classList.remove('hidden');
            });

            pair.menu.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        });

        document.addEventListener('click', closeAllMenus);
    });
</script>