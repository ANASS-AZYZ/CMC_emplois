<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - CMC</title>
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('favicon-cmcm.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #0b1730;
            color: #e2e8f0;
        }

        body.theme-dark {
            background: #061022;
        }

        .login-shell {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
        }

        .login-wrap {
            width: 100%;
            max-width: 520px;
        }

        .logo-band {
            width: 100%;
            border: 1px solid #2b3e64;
            border-radius: 14px;
            background: #0f1d37;
            padding: 14px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .logo-slot {
            width: 45%;
            display: flex;
            align-items: center;
        }

        .logo-slot.left { justify-content: flex-start; }
        .logo-slot.right { justify-content: flex-end; }

        .logo-band img {
            height: 42px;
            max-width: 100%;
            object-fit: contain;
            display: block;
        }

        .logo-sep {
            width: 1px;
            height: 40px;
            background: #334a75;
            flex-shrink: 0;
        }

        .login-card {
            width: 100%;
            min-height: 420px;
            border: 1px solid #334a75;
            border-radius: 18px;
            background: #0f1d37;
            padding: 26px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        }

        .login-title {
            margin: 0 0 18px;
            text-align: center;
            font-size: 30px;
            font-weight: 800;
            color: #f8fafc;
        }

        .login-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: #dbeafe;
        }

        .login-input {
            width: 100%;
            height: 50px;
            border-radius: 12px;
            border: 1px solid #7c8ea7;
            background: #ffffff;
            color: #0f172a;
            padding: 0 14px;
            font-size: 22px;
            margin-bottom: 16px;
        }

        .login-submit {
            width: 100%;
            height: 50px;
            border-radius: 12px;
            border: 0;
            background: #3b82f6;
            color: #ffffff;
            font-size: 22px;
            font-weight: 800;
            cursor: pointer;
            margin-top: 8px;
        }

        .switch-links {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .switch-links a {
            color: #93c5fd;
            text-decoration: none;
            border-bottom: 1px solid transparent;
        }

        .switch-links a.active {
            color: #ffffff;
            border-bottom-color: #ffffff;
        }

        .helper-links {
            margin-top: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 15px;
        }

        .helper-links a { color: #93c5fd; text-decoration: none; }

    </style>
</head>
<body>
    @php
        $role = $forcedRole ?? old('login_as', 'formateur');
    @endphp
    <div class="login-shell">
        <div class="login-wrap">
            <div class="logo-band">
                <div class="logo-slot left">
                    <img src="{{ asset('images/logo-cmc.png') }}" alt="CMC" class="logo-left">
                </div>
                <div class="logo-sep"></div>
                <div class="logo-slot right">
                    <img src="{{ asset('images/logo-ofppt.png') }}" alt="OFPPT" class="logo-right">
                </div>
            </div>

            <div class="login-card">
                <h1 class="login-title" id="login-title">{{ $role === 'admin' ? 'Connexion Admin' : 'Connexion Formateur' }}</h1>

                @if(!$forcedRole)
                    <div class="switch-links">
                        <a href="{{ route('login.formateur') }}" class="{{ $role === 'formateur' ? 'active' : '' }}">Formateur</a>
                        <a href="{{ route('login.admin') }}" class="{{ $role === 'admin' ? 'active' : '' }}">Admin</a>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="hidden" name="login_as" value="{{ $role }}">

                    <label class="login-label" id="label-email">Email</label>
                    <input class="login-input" type="email" name="email" value="{{ old('email') }}" placeholder="Entrer votre email" required autocomplete="username">
                    @error('email')
                        <p class="text-red-400 text-sm mb-3">{{ $message }}</p>
                    @enderror

                    <label class="login-label" id="label-password">Mot de passe</label>
                    <input class="login-input" type="password" name="password" placeholder="Entrer votre password" required autocomplete="current-password">
                    @error('password')
                        <p class="text-red-400 text-sm mb-3">{{ $message }}</p>
                    @enderror

                    <button class="login-submit" type="submit" id="btn-submit">Se connecter</button>

                    <div class="helper-links">
                        <label>
                            <input type="checkbox" name="remember">
                            <span id="remember-text">Rester connecté</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" id="forgot-text">Mot de passe oublié ?</a>
                        @endif
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var role = '{{ $role }}';

            function systemLang() {
                var nav = (navigator.language || 'fr').toLowerCase();
                if (nav.indexOf('ar') === 0) return 'ar';
                if (nav.indexOf('fr') === 0) return 'fr';
                return 'en';
            }

            var currentLang = localStorage.getItem('cmc_lang') || systemLang();

            var dict = {
                fr: {
                    titleAdmin: 'Connexion Admin',
                    titleFormateur: 'Connexion Formateur',
                    email: 'Email',
                    password: 'Mot de passe',
                    submit: 'Se connecter',
                    remember: 'Rester connecté',
                    forgot: 'Mot de passe oublié ?'
                },
                en: {
                    titleAdmin: 'Admin Login',
                    titleFormateur: 'Trainer Login',
                    email: 'Email',
                    password: 'Password',
                    submit: 'Sign In',
                    remember: 'Keep me signed in',
                    forgot: 'Forgot password?'
                },
                ar: {
                    titleAdmin: 'دخول الادارة',
                    titleFormateur: 'دخول المكون',
                    email: 'البريد الالكتروني',
                    password: 'كلمة المرور',
                    submit: 'تسجيل الدخول',
                    remember: 'ابقني متصلا',
                    forgot: 'نسيت كلمة المرور؟'
                }
            };

            function applyLang(lang) {
                var safe = dict[lang] ? lang : 'fr';
                localStorage.setItem('cmc_lang', safe);
                document.documentElement.lang = safe;
                document.documentElement.dir = safe === 'ar' ? 'rtl' : 'ltr';

                var d = dict[safe];
                document.getElementById('login-title').textContent = role === 'admin' ? d.titleAdmin : d.titleFormateur;
                document.getElementById('label-email').textContent = d.email;
                document.getElementById('label-password').textContent = d.password;
                document.getElementById('btn-submit').textContent = d.submit;
                document.getElementById('remember-text').textContent = d.remember;
                var forgot = document.getElementById('forgot-text');
                if (forgot) forgot.textContent = d.forgot;
            }

            applyLang(currentLang);
        });
    </script>
</body>
</html>
