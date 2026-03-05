<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ Auth::check() ? (Auth::user()->role === 'admin' ? route('dashboard') : route('formateur.dashboard')) : '#' }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                        @if (Auth::user()->role === 'admin')
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                <span data-i18n-nav="navDashboard">{{ __('Dashboard') }}</span>
                            </x-nav-link>
                            <x-nav-link :href="route('seances.emploi', ['type' => 'groupe'])" :active="request()->routeIs('seances.emploi')">
                                <span data-i18n-nav="navGroupTimetable">Emplois Groupe</span>
                            </x-nav-link>
                        @elseif (Auth::user()->role === 'formateur')
                            <x-nav-link :href="route('formateur.dashboard')" :active="request()->routeIs('formateur.dashboard')">
                                <span data-i18n-nav="navMyTimetable">Mon Emploi</span>
                            </x-nav-link>
                        @endif
                    @else
                        <span class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500">
                            <span data-i18n-nav="navConsultation">Consultation Emploi</span>
                        </span>
                    @endauth
                </div>
            </div>

            <div class="flex items-center gap-2 me-2 sm:me-3">
                    <button id="ui-theme-toggle" type="button" class="ui-icon-btn" title="Theme">🌙</button>
                    <div class="ui-lang-wrap">
                        <button id="ui-lang-toggle" type="button" class="ui-icon-btn" title="Language">🌐</button>
                        <div id="ui-lang-menu" class="ui-lang-menu ui-hidden">
                            <button type="button" class="ui-lang-item" data-lang="fr">Francais</button>
                            <button type="button" class="ui-lang-item" data-lang="en">English</button>
                            <button type="button" class="ui-lang-item" data-lang="ar">Arabic</button>
                        </div>
                    </div>
                </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">

                @auth
                    @if (Auth::user()->role === 'admin')
                        @php
                            $unreadMessagesCount = \App\Models\FormateurMessage::query()->whereNull('read_at')->count();
                            $latestMessages = \App\Models\FormateurMessage::query()->with('sender')->latest()->take(5)->get();
                        @endphp

                        <x-dropdown align="right" width="72">
                            <x-slot name="trigger">
                                <button class="relative inline-flex items-center px-3 py-2 border border-gray-200 text-sm leading-4 font-medium rounded-md text-gray-600 bg-white focus:outline-none">
                                    <i class="fas fa-envelope"></i>
                                    @if ($unreadMessagesCount > 0)
                                        <span class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] leading-none px-1.5 py-1 rounded-full">
                                            {{ $unreadMessagesCount }}
                                        </span>
                                    @endif
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="px-4 py-2 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-100">
                                    Messages Formateurs
                                </div>
                                @forelse ($latestMessages as $msg)
                                    <a href="{{ route('admin.messages.index') }}" class="block px-4 py-3 border-b border-gray-100">
                                        <p class="text-sm font-semibold text-gray-800 truncate">{{ $msg->subject }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ $msg->sender->name ?? 'Formateur' }} - {{ $msg->created_at->diffForHumans() }}</p>
                                    </a>
                                @empty
                                    <div class="px-4 py-3 text-sm text-gray-500">Aucun message.</div>
                                @endforelse

                                <a href="{{ route('admin.messages.index') }}" class="block px-4 py-2 text-sm font-semibold text-blue-600">
                                    Voir tous les messages
                                </a>
                            </x-slot>
                        </x-dropdown>
                    @endif

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white focus:outline-none">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                <span data-i18n-nav="navProfile">{{ __('Profile') }}</span>
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    <span data-i18n-nav="navLogout">{{ __('Log Out') }}</span>
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
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
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if (Auth::user()->role === 'admin')
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <span data-i18n-nav="navDashboard">{{ __('Dashboard') }}</span>
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('seances.emploi', ['type' => 'groupe'])" :active="request()->routeIs('seances.emploi')">
                        <span data-i18n-nav="navGroupTimetable">Emplois Groupe</span>
                    </x-responsive-nav-link>
                @elseif (Auth::user()->role === 'formateur')
                    <x-responsive-nav-link :href="route('formateur.dashboard')" :active="request()->routeIs('formateur.dashboard')">
                        <span data-i18n-nav="navMyTimetable">Mon Emploi</span>
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

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