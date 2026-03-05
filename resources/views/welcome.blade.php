<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Back - CMC Planning</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            transition: background-color 0.25s ease, color 0.25s ease;
        }

        body.theme-dark {
            background: #0f172a;
            color: #e2e8f0;
        }

        body.theme-dark .logo-chip {
            background: rgba(15, 23, 42, 0.7);
            border-color: #334155;
        }

        body.theme-dark .page-title {
            color: #f8fafc;
        }

        body.theme-dark .page-subtitle {
            color: #94a3b8;
        }

        body.theme-dark .login-card {
            background: #111827;
            border-color: #334155;
        }

        body.theme-dark .switch-wrap {
            background: #1e293b;
        }

        body.theme-dark .role-tab {
            color: #94a3b8;
        }

        body.theme-dark .role-tab.bg-white {
            background: #0f172a !important;
            color: #f8fafc !important;
        }

        body.theme-dark .form-label {
            color: #cbd5e1;
        }

        body.theme-dark .login-input {
            background: #1e293b;
            color: #e2e8f0;
        }

        body.theme-dark .login-input::placeholder {
            color: #94a3b8;
        }

        body.theme-dark .suffix {
            color: #64748b;
        }

        body.theme-dark .remember-text {
            color: #94a3b8;
        }

        body.theme-dark .portal-text {
            color: #64748b;
        }

        body.theme-dark .portal-link {
            color: #60a5fa;
        }

        .theme-control {
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #0f172a;
        }

        .icon-control {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            font-size: 18px;
            line-height: 1;
        }

        .lang-wrap {
            position: relative;
        }

        .lang-menu {
            position: absolute;
            top: 48px;
            right: 0;
            width: 130px;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.12);
            padding: 6px;
            z-index: 30;
        }

        .lang-item {
            width: 100%;
            text-align: left;
            padding: 8px 10px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            color: #0f172a;
        }

        .lang-item:hover {
            background: #f1f5f9;
        }

        .lang-item.active {
            background: #dbeafe;
            color: #1e3a8a;
        }

        .hidden {
            display: none !important;
        }

        body.theme-dark .theme-control {
            border-color: #334155;
            background: #1e293b;
            color: #e2e8f0;
        }

        body.theme-dark .lang-menu {
            border-color: #334155;
            background: #1e293b;
            box-shadow: 0 10px 24px rgba(2, 6, 23, 0.45);
        }

        body.theme-dark .lang-item {
            color: #e2e8f0;
        }

        body.theme-dark .lang-item:hover {
            background: #334155;
        }

        body.theme-dark .lang-item.active {
            background: #1d4ed8;
            color: #ffffff;
        }
    </style>
</head>
<body class="bg-slate-100 antialiased font-sans text-slate-900">
    <div class="min-h-screen flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-5xl">
            <div class="mx-auto w-full max-w-xl flex justify-end gap-2 sm:gap-3 mb-4">
                <button id="theme-toggle" type="button" class="theme-control icon-control" title="Dark mode">
                    🌙
                </button>
                <div class="lang-wrap">
                    <button id="lang-toggle" type="button" class="theme-control icon-control" title="Language">
                        🌐
                    </button>
                    <div id="lang-menu" class="lang-menu hidden">
                        <button type="button" class="lang-item" data-lang="fr">Francais</button>
                        <button type="button" class="lang-item" data-lang="en">English</button>
                        <button type="button" class="lang-item" data-lang="ar">Arabic</button>
                    </div>
                </div>
            </div>

            <div class="mx-auto w-full max-w-xl text-center mb-8">
                <div class="logo-chip inline-flex items-center gap-3 sm:gap-5 rounded-2xl bg-white/80 border border-slate-200 px-4 sm:px-6 py-3 shadow-sm">
                    <img src="{{ asset('images/logo-cmc.png') }}" alt="CMC" class="h-9 sm:h-10 w-auto object-contain">
                    <div class="h-8 sm:h-9 w-px bg-slate-200"></div>
                    <img src="{{ asset('images/logo-ofppt.png') }}" alt="OFPPT" class="h-9 sm:h-10 w-auto object-contain max-w-[175px] sm:max-w-[220px]">
                </div>
                <h1 data-i18n="welcomeTitle" class="page-title mt-7 text-5xl sm:text-6xl font-black tracking-tight text-slate-950">CMC Academic Portal</h1>
                <p data-i18n="subtitle" class="page-subtitle mt-3 text-slate-600 font-medium text-base sm:text-lg">Secure access to scheduling and planning services</p>
            </div>

            <div class="login-card mx-auto w-full max-w-xl rounded-[2rem] bg-white border border-slate-200 p-6 sm:p-8 shadow-lg">
                <div class="switch-wrap flex p-1.5 bg-slate-100 rounded-2xl mb-7">
                    <button type="button" data-role="formateur" data-i18n="formateurLogin" class="role-tab flex-1 py-2.5 text-base font-bold text-slate-900 bg-white rounded-xl shadow-sm transition">
                        Formateur Login
                    </button>
                    <button type="button" data-role="admin" data-i18n="adminLogin" class="role-tab flex-1 py-2.5 text-base font-bold text-slate-500 rounded-xl transition">
                        Admin Login
                    </button>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="login_as" id="login_as" value="{{ old('login_as', 'formateur') }}">

                    <div>
                        <label data-i18n="academicEmail" class="form-label block text-sm font-bold text-slate-800 mb-2">Academic Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">@</span>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@cmc.ma" required
                                   class="login-input block w-full pl-10 pr-4 sm:pr-36 py-3.5 bg-slate-100 border border-transparent rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            <span class="suffix absolute inset-y-0 right-0 pr-3 hidden sm:flex items-center text-slate-300 text-sm font-semibold">
                                @ofppt-edu.ma
                            </span>
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex justify-between mb-2">
                            <label data-i18n="password" class="form-label block text-sm font-bold text-slate-800">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" data-i18n="forgot" class="text-sm font-bold text-blue-500 hover:text-blue-600">Forgot?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 text-xs">🔒</span>
                            <input type="password" name="password" placeholder="••••••••" required
                                   class="login-input block w-full pl-10 py-3.5 bg-slate-100 border border-transparent rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="flex items-center gap-2.5 remember-text text-slate-500 italic text-sm">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-blue-500 border-slate-300 rounded">
                        <span data-i18n="remember">Keep me logged in on this device</span>
                    </label>

                    <button type="submit" class="w-full py-3.5 bg-blue-300 text-blue-900 font-black rounded-xl hover:bg-blue-400 transition flex items-center justify-center gap-2 uppercase tracking-[0.2em] text-xl">
                        <span data-i18n="signIn">Sign In</span> <span>→</span>
                    </button>
                </form>
            </div>

            <div class="mt-10 text-center">
                <div class="flex items-center justify-center gap-3 sm:gap-4 mb-4 opacity-40">
                    <hr class="w-12 sm:w-16 border-slate-300">
                    <span data-i18n="academicPortal" class="portal-text text-[10px] font-bold text-slate-400 uppercase tracking-[0.18em]">Academic Portal</span>
                    <hr class="w-12 sm:w-16 border-slate-300">
                </div>
                <a href="{{ route('stagiaire.emploi') }}" data-i18n="publicLink" class="portal-link text-blue-600 font-black hover:underline uppercase text-xs sm:text-sm tracking-tight">
                    🔍 Consulter l'emploi du temps (Espace Public)
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var loginAsInput = document.getElementById('login_as');
            var tabs = document.querySelectorAll('.role-tab');
            var themeToggle = document.getElementById('theme-toggle');
            var langToggle = document.getElementById('lang-toggle');
            var langMenu = document.getElementById('lang-menu');
            var langItems = document.querySelectorAll('.lang-item');
            var currentLang = localStorage.getItem('cmc_lang') || 'en';

            var translations = {
                fr: {
                    welcomeTitle: 'Portail Academique CMC',
                    subtitle: 'Acces securise aux services de planification et d\'emploi du temps',
                    formateurLogin: 'Connexion Formateur',
                    adminLogin: 'Connexion Admin',
                    academicEmail: 'Email Academique',
                    password: 'Mot de passe',
                    forgot: 'Oublie ?',
                    remember: 'Garder ma session active sur cet appareil',
                    signIn: 'Se Connecter',
                    academicPortal: 'Portail Academique',
                    publicLink: '🔍 Consulter l\'emploi du temps (Espace Public)',
                    themeDark: 'Mode Sombre',
                    themeLight: 'Mode Clair'
                },
                en: {
                    welcomeTitle: 'CMC Academic Portal',
                    subtitle: 'Secure access to scheduling and planning services',
                    formateurLogin: 'Formateur Login',
                    adminLogin: 'Admin Login',
                    academicEmail: 'Academic Email',
                    password: 'Password',
                    forgot: 'Forgot?',
                    remember: 'Keep me logged in on this device',
                    signIn: 'Sign In',
                    academicPortal: 'Academic Portal',
                    publicLink: '🔍 View timetable (Public Space)',
                    themeDark: 'Dark Mode',
                    themeLight: 'Light Mode'
                },
                ar: {
                    welcomeTitle: 'البوابة الاكاديمية CMC',
                    subtitle: 'ولوج امن لخدمات التخطيط واستعمال الزمن',
                    formateurLogin: 'دخول المكون',
                    adminLogin: 'دخول الادارة',
                    academicEmail: 'البريد الاكاديمي',
                    password: 'كلمة المرور',
                    forgot: 'نسيت؟',
                    remember: 'ابقني متصلا على هذا الجهاز',
                    signIn: 'تسجيل الدخول',
                    academicPortal: 'البوابة الاكاديمية',
                    publicLink: '🔍 الاطلاع على استعمال الزمن (الفضاء العمومي)',
                    themeDark: 'الوضع الليلي',
                    themeLight: 'الوضع النهاري'
                }
            };

            function setRole(role) {
                loginAsInput.value = role;

                tabs.forEach(function (tab) {
                    var active = tab.getAttribute('data-role') === role;
                    tab.classList.toggle('bg-white', active);
                    tab.classList.toggle('text-gray-900', active);
                    tab.classList.toggle('shadow-sm', active);
                    tab.classList.toggle('text-gray-500', !active);
                });
            }

            tabs.forEach(function (tab) {
                tab.addEventListener('click', function () {
                    setRole(tab.getAttribute('data-role'));
                });
            });

            function updateThemeIcon() {
                if (!themeToggle) {
                    return;
                }
                themeToggle.textContent = document.body.classList.contains('theme-dark') ? '☀️' : '🌙';
            }

            function updateActiveLanguageItem() {
                langItems.forEach(function (item) {
                    var active = item.getAttribute('data-lang') === currentLang;
                    item.classList.toggle('active', active);
                });
            }

            function applyLanguage(lang) {
                currentLang = translations[lang] ? lang : 'en';
                localStorage.setItem('cmc_lang', currentLang);
                document.documentElement.setAttribute('lang', currentLang);
                document.documentElement.setAttribute('dir', currentLang === 'ar' ? 'rtl' : 'ltr');

                var dict = translations[currentLang];
                var items = document.querySelectorAll('[data-i18n]');
                items.forEach(function (item) {
                    var key = item.getAttribute('data-i18n');
                    if (dict[key]) {
                        item.textContent = dict[key];
                    }
                });

                updateThemeIcon();
                updateActiveLanguageItem();
            }

            function applyTheme(theme) {
                var isDark = theme === 'dark';
                document.body.classList.toggle('theme-dark', isDark);
                localStorage.setItem('cmc_theme', isDark ? 'dark' : 'light');
                updateThemeIcon();
            }

            if (themeToggle) {
                themeToggle.addEventListener('click', function () {
                    var nextTheme = document.body.classList.contains('theme-dark') ? 'light' : 'dark';
                    applyTheme(nextTheme);
                });
            }

            if (langToggle && langMenu) {
                langToggle.addEventListener('click', function () {
                    langMenu.classList.toggle('hidden');
                });
            }

            langItems.forEach(function (item) {
                item.addEventListener('click', function () {
                    var selected = item.getAttribute('data-lang');
                    applyLanguage(selected);
                    if (langMenu) {
                        langMenu.classList.add('hidden');
                    }
                });
            });

            document.addEventListener('click', function (event) {
                if (!langMenu || !langToggle) {
                    return;
                }

                var clickedInsideMenu = langMenu.contains(event.target);
                var clickedToggle = langToggle.contains(event.target);
                if (!clickedInsideMenu && !clickedToggle) {
                    langMenu.classList.add('hidden');
                }
            });

            var savedTheme = localStorage.getItem('cmc_theme') || 'light';
            applyTheme(savedTheme);
            applyLanguage(currentLang);

            setRole(loginAsInput.value || 'formateur');
        });
    </script>
</body>
</html>