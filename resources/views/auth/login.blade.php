<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="max-w-2xl mx-auto">
        <h1 class="text-5xl font-black text-slate-900 text-center tracking-tight">Welcome Back</h1>
        <p class="text-center text-slate-600 text-2xl mt-4 mb-10">Access the CMC scheduling and planning system</p>

        <form method="POST" action="{{ route('login') }}" class="rounded-[2rem] border border-slate-200 bg-white/90 p-8 shadow-sm">
            @csrf

            <input type="hidden" name="login_as" id="login_as" value="{{ old('login_as', 'formateur') }}">

            <div class="mb-8 rounded-2xl bg-slate-100 p-2 grid grid-cols-2 gap-2">
                <button type="button" data-role="formateur" class="role-tab rounded-xl px-4 py-3 text-xl font-bold transition">
                    Formateur Login
                </button>
                <button type="button" data-role="admin" class="role-tab rounded-xl px-4 py-3 text-xl font-bold text-slate-500 transition">
                    Admin Login
                </button>
            </div>

            <div>
                <x-input-label for="email" class="text-2xl font-bold" :value="__('Academic Email')" />
                <x-text-input id="email" class="block mt-3 w-full rounded-2xl border-0 bg-slate-100 px-5 py-4 text-xl"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-8">
                <div class="flex items-center justify-between">
                    <x-input-label for="password" class="text-2xl font-bold" :value="__('Password')" />
                    @if (Route::has('password.request'))
                        <a class="text-lg font-semibold text-blue-500 hover:text-blue-600" href="{{ route('password.request') }}">
                            {{ __('Forgot?') }}
                        </a>
                    @endif
                </div>

                <x-text-input id="password" class="block mt-3 w-full rounded-2xl border-0 bg-slate-100 px-5 py-4 text-xl"
                    type="password" name="password" required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="block mt-8">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                    <span class="ms-2 text-lg italic text-slate-500">{{ __('Keep me logged in on this device') }}</span>
                </label>
            </div>

            <button type="submit" class="mt-8 w-full rounded-2xl bg-blue-400 py-4 text-3xl font-black tracking-widest text-blue-900 hover:bg-blue-500 transition">
                SIGN IN ->
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="{{ route('stagiaire.emploi') }}" class="inline-flex items-center gap-2 text-lg font-bold text-slate-500 hover:text-blue-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                </svg>
                Consulter l'emploi du temps 
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var loginAsInput = document.getElementById('login_as');
            var tabs = document.querySelectorAll('.role-tab');

            function setRole(role) {
                loginAsInput.value = role;
                tabs.forEach(function (tab) {
                    var active = tab.getAttribute('data-role') === role;
                    tab.classList.toggle('bg-white', active);
                    tab.classList.toggle('text-slate-900', active);
                    tab.classList.toggle('shadow-sm', active);
                    tab.classList.toggle('text-slate-500', !active);
                });
            }

            tabs.forEach(function (tab) {
                tab.addEventListener('click', function () {
                    setRole(tab.getAttribute('data-role'));
                });
            });

            setRole(loginAsInput.value || 'formateur');
        });
    </script>
</x-guest-layout>
