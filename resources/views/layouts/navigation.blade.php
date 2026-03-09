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
                                    <svg style="width: 10px; height: 10px;" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M15 17H9m9-1V11a6 6 0 10-12 0v5l-2 2h16l-2-2z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
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
                            <svg style="width: 10px; height: 10px;" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M15 17H9m9-1V11a6 6 0 10-12 0v5l-2 2h16l-2-2z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    @endif
                @endauth

                @auth
                    <a href="{{ route('settings.index') }}" class="ui-icon-btn" title="Parametres">
                        <svg style="width: 10px; height: 10px;" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M10.325 4.317a1 1 0 011.35-.936l1.756.74a1 1 0 00.79 0l1.756-.74a1 1 0 011.35.936l.166 1.897a1 1 0 00.5.79l1.59.92a1 1 0 01.366 1.366l-.99 1.714a1 1 0 000 .998l.99 1.714a1 1 0 01-.366 1.366l-1.59.92a1 1 0 00-.5.79l-.166 1.897a1 1 0 01-1.35.936l-1.756-.74a1 1 0 00-.79 0l-1.756.74a1 1 0 01-1.35-.936l-.166-1.897a1 1 0 00-.5-.79l-1.59-.92a1 1 0 01-.366-1.366l.99-1.714a1 1 0 000-.998l-.99-1.714a1 1 0 01.366-1.366l1.59-.92a1 1 0 00.5-.79l.166-1.897z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                            <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8" />
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

                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center" title="Profile">
                        @if ($avatarUrl)
                            <img src="{{ $avatarUrl }}" alt="{{ Auth::user()->name }}" class="h-10 w-10 rounded-full object-cover border border-gray-300" />
                        @else
                            <span class="ui-avatar-fallback">{{ $firstLetter }}</span>
                        @endif
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="ms-2">
                        @csrf
                        <button type="submit" class="ui-icon-btn" title="Deconnexion">
                            <svg style="width: 10px; height: 10px;" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M16 17l5-5m0 0l-5-5m5 5H9m4 5v1a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2h6a2 2 0 012 2v1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
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