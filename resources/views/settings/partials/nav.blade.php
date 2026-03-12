<div class="settings-nav bg-white border border-blue-200 rounded-xl shadow-md p-6 w-72">
    <nav class="space-y-2">
        <a href="{{ route('settings.theme') }}" class="block font-medium text-sm text-gray-700 hover:bg-blue-600 hover:text-white rounded-xl px-4 py-2 transition {{ request()->routeIs('settings.theme') ? 'bg-blue-600 text-white shadow' : '' }}">
            <i class="fas fa-paint-brush mr-2"></i> <span class="tracking-tight">Changer le thème</span>
        </a>
        <a href="{{ route('settings.password') }}" class="block font-medium text-sm text-gray-700 hover:bg-blue-600 hover:text-white rounded-xl px-4 py-2 transition {{ request()->routeIs('settings.password') ? 'bg-blue-600 text-white shadow' : '' }}">
            <i class="fas fa-key mr-2"></i> <span class="tracking-tight">Changer le mot de passe</span>
        </a>
        <a href="{{ route('settings.lang') }}" class="block font-medium text-sm text-gray-700 hover:bg-blue-600 hover:text-white rounded-xl px-4 py-2 transition {{ request()->routeIs('settings.lang') ? 'bg-blue-600 text-white shadow' : '' }}">
            <i class="fas fa-language mr-2"></i> <span class="tracking-tight">Changer la langue</span>
        </a>
    </nav>
</div>
