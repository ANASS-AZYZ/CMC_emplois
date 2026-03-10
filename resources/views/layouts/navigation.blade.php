<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ Auth::check() ? (Auth::user()->role === 'admin' ? route('dashboard') : route('formateur.dashboard')) : '#' }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
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
                    @if (Auth::user()->role === 'admin')
                        @php
                            $unreadMessagesCount = \App\Models\FormateurMessage::query()->whereNull('read_at')->count();
                            $latestMessages = \App\Models\FormateurMessage::query()
                                ->with('sender')
                                ->whereNull('read_at')
                                ->latest()
                                ->take(5)
                                ->get();
                        @endphp

                        <x-dropdown align="right" width="72">
                            <x-slot name="trigger">
                                <button
                                    id="ui-notification-trigger"
                                    class="ui-icon-btn relative"
                                    title="Notifications"
                                    data-mark-read-url="{{ route('admin.messages.read-all') }}"
                                    data-csrf="{{ csrf_token() }}"
                                >
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                                        <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                                    </svg>
                                    @if ($unreadMessagesCount > 0)
                                        <span id="ui-notification-badge" class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] leading-none px-1.5 py-1 rounded-full">
                                            {{ $unreadMessagesCount }}
                                        </span>
                                    @endif
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="px-4 py-2 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-100">
                                    Messages Formateurs
                                </div>
                                @foreach ($latestMessages as $msg)
                                    <a href="{{ route('admin.messages.index') }}" class="ui-notif-item block px-4 py-3 border-b border-gray-100">
                                        <p class="text-sm font-semibold text-gray-800 truncate">{{ $msg->subject }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ $msg->sender->name ?? 'Formateur' }} - {{ $msg->created_at->diffForHumans() }}</p>
                                    </a>
                                @endforeach

                                <div id="ui-notif-empty" class="px-4 py-3 text-sm text-gray-500 {{ $latestMessages->isEmpty() ? '' : 'hidden' }}">Aucun message.</div>

                                <a href="{{ route('admin.messages.index') }}" class="block px-4 py-2 text-sm font-semibold text-blue-600">
                                    Voir tous les messages
                                </a>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <button class="ui-icon-btn" type="button" title="Notifications">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                                <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                            </svg>
                        </button>
                    @endif
                @endauth

                @auth
                    <a href="{{ route('settings.index') }}" class="ui-icon-btn" title="Parametres">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="3" />
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z" />
                        </svg>
                    </a>
                @endauth

            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">

                @auth
                    @php
                        $name = trim((string) Auth::user()->name);
                        $firstLetter = $name !== '' ? mb_strtoupper(mb_substr($name, 0, 1)) : 'U';
                        $avatarUrl = Auth::user()->avatar_url ?? null;
                    @endphp

                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center shrink-0 rounded-full ring-2 ring-transparent hover:ring-blue-400 dark:hover:ring-blue-500 focus:ring-2 focus:ring-blue-500 transition-all outline-none" title="Mon profil – photo et paramètres">
                        @if ($avatarUrl)
                            <img src="{{ $avatarUrl }}" alt="{{ Auth::user()->name }}" class="w-9 h-9 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600 shrink-0 shadow-sm" />
                        @else
                            <span class="ui-avatar-fallback">{{ $firstLetter }}</span>
                        @endif
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="ms-2">
                        @csrf
                        <button type="submit" class="ui-icon-btn" title="Deconnexion">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                <polyline points="16 17 21 12 16 7" />
                                <line x1="21" y1="12" x2="9" y2="12" />
                            </svg>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline font-bold">Se connecter (Admin)</a>
                @endauth
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="px-4 pt-3">
            <div class="ui-search-wrap w-full">
                <svg class="ui-search-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    <circle cx="11" cy="11" r="6" stroke="currentColor" stroke-width="1.8" />
                </svg>
                <input id="ui-nav-search-mobile" type="search" class="ui-search-input" data-i18n-nav-placeholder="navSearchPlaceholder" placeholder="Rechercher..." autocomplete="off" />
                <span class="ui-search-shortcut">Ctrl+K</span>
            </div>
        </div>

        @auth
            @if(Auth::user()->role === 'formateur')
                <nav class="flex flex-col gap-2 px-4 pt-4">
                    <a href="{{ route('formateur.dashboard') }}" class="font-semibold px-3 py-2 rounded hover:bg-blue-50 transition {{ request()->routeIs('formateur.dashboard') ? 'text-blue-700 underline' : '' }}">
                        Mon Emploi
                    </a>
                    <a href="{{ route('formateur.emploi.view') }}" class="font-semibold px-3 py-2 rounded hover:bg-blue-50 transition {{ request()->routeIs('formateur.emploi.view') ? 'text-blue-700 underline' : '' }}">
                        Emplois du Groupe
                    </a>
                    <a href="{{ route('formateur.contact-admin.create') }}" class="font-semibold px-3 py-2 rounded hover:bg-blue-50 transition {{ request()->routeIs('formateur.contact-admin.*') ? 'text-blue-700 underline' : '' }}">
                        Contacter Admin
                    </a>
                    <a href="{{ route('settings.index') }}" class="font-semibold px-3 py-2 rounded hover:bg-blue-50 transition {{ request()->routeIs('settings.index') ? 'text-blue-700 underline' : '' }}">
                        Parametres
                    </a>
                </nav>
            @endif
        @endauth

        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        <span data-i18n-nav="navProfile">{{ __('Profile') }}</span>
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            <span data-i18n-nav="navLogout">{{ __('Log Out') }}</span>
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4 py-2 text-sm text-gray-500">
                    Mode Consultation (Invité)
                </div>
            @endauth
        </div>
    </div>
</nav>