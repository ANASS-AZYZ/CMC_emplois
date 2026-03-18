<x-app-layout>
    <div class="flex flex-col md:flex-row gap-4 md:gap-8 p-3 sm:p-4 md:p-8">
        @include('settings.partials.nav')
        <div class="flex-1 px-2 sm:px-4 md:px-8 py-2 sm:py-4 md:py-8">
            @if(request()->routeIs('settings.theme'))
                <div class="flex justify-center items-center h-full min-h-[220px]">
                    <button class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white rounded-xl shadow text-base sm:text-lg font-semibold" style="min-width:220px;" data-i18n-app="settingsThemeNav">Changer le thème</button>
                </div>
            @elseif(request()->routeIs('settings.password'))
                <div class="flex justify-center items-center h-full min-h-[220px]">
                    <button class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white rounded-xl shadow text-base sm:text-lg font-semibold" style="min-width:220px;" data-i18n-app="settingsPasswordNav">Changer le mot de passe</button>
                </div>
            @elseif(request()->routeIs('settings.lang'))
                <div class="flex justify-center items-center h-full min-h-[220px]">
                    <button class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white rounded-xl shadow text-base sm:text-lg font-semibold" style="min-width:220px;" data-i18n-app="settingsLanguageNav">Changer la langue</button>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
