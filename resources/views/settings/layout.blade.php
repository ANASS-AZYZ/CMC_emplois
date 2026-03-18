<x-app-layout>
    <style>
        .settings-shell {
            min-height: calc(100vh - 6rem);
            padding: 0.75rem;
        }

        .settings-sidebar {
            width: 100%;
            margin-bottom: 0.75rem;
        }

        .settings-content {
            width: 100%;
            min-width: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        @media (min-width: 768px) {
            .settings-shell {
                padding: 1.5rem;
            }
            .settings-sidebar {
                width: 18rem;
                margin-bottom: 0;
                margin-right: 1.5rem;
            }
            [dir="rtl"] .settings-sidebar {
                margin-right: 0;
                margin-left: 1.5rem;
            }
        }
    </style>

    <div class="settings-shell flex flex-col md:flex-row">
        <!-- Sidebar Paramètres -->
        <aside class="settings-sidebar shrink-0">
            <div class="rounded-2xl bg-white dark:bg-[var(--app-surface)] border border-gray-100 dark:border-[var(--app-border)] shadow-lg overflow-hidden">
                <div class="px-4 py-3 bg-gray-50 dark:bg-[var(--app-surface-soft)] border-b border-gray-100 dark:border-[var(--app-border)]">
                    <span class="text-xs font-bold tracking-wider text-gray-500 dark:text-gray-400 uppercase" data-i18n-app="sidePreferences">Préférences</span>
                </div>
                <nav class="p-3 space-y-1">
                    <a href="{{ route('settings.theme') }}"
                       class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->is('settings/theme') ? 'bg-blue-600 text-white shadow-md' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[var(--app-surface-soft)]' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" /></svg>
                        <span data-i18n-app="settingsThemeNav">Changer le thème</span>
                    </a>
                    <a href="{{ route('settings.password') }}"
                       class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->is('settings/password') ? 'bg-blue-600 text-white shadow-md' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[var(--app-surface-soft)]' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg>
                        <span data-i18n-app="settingsPasswordNav">Changer le mot de passe</span>
                    </a>
                    <a href="{{ route('settings.lang') }}"
                       class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->is('settings/lang') ? 'bg-blue-600 text-white shadow-md' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[var(--app-surface-soft)]' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" /></svg>
                        <span data-i18n-app="settingsLanguageNav">Changer la langue</span>
                    </a>
                </nav>
            </div>
        </aside>
        <!-- Contenu principal (centré) -->
        <main class="settings-content flex-1">
            @yield('settings-content')
        </main>
    </div>
</x-app-layout>
