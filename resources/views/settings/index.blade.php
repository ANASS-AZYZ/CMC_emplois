<x-app-layout>
    <div class="flex">
        @include('settings.partials.nav')
        <div class="flex-1 px-12 py-12">
            @if(request()->routeIs('settings.theme'))
                <div class="flex justify-center items-center h-full">
                    <button class="px-6 py-3 bg-blue-600 text-white rounded-xl shadow text-lg font-semibold" style="min-width:220px;">Changer le thème</button>
                </div>
            @elseif(request()->routeIs('settings.password'))
                <div class="flex justify-center items-center h-full">
                    <button class="px-6 py-3 bg-blue-600 text-white rounded-xl shadow text-lg font-semibold" style="min-width:220px;">Changer le mot de passe</button>
                </div>
            @elseif(request()->routeIs('settings.lang'))
                <div class="flex justify-center items-center h-full">
                    <button class="px-6 py-3 bg-blue-600 text-white rounded-xl shadow text-lg font-semibold" style="min-width:220px;">Changer la langue</button>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
