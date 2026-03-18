<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau mot de passe - CMC</title>
    <link rel="icon" type="image/png" sizes="64x64" href="/favicon-cmcm.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #0b1730;
            color: #e2e8f0;
        }

        .shell {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
        }

        .wrap {
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

        .card {
            width: 100%;
            border: 1px solid #334a75;
            border-radius: 18px;
            background: #0f1d37;
            padding: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        }

        .title {
            margin: 0 0 8px;
            text-align: center;
            font-size: 30px;
            font-weight: 800;
            color: #f8fafc;
        }

        .subtitle {
            margin: 0 0 18px;
            text-align: center;
            color: #bfdbfe;
            font-size: 14px;
        }

        .error-box {
            background: #3f1d1d;
            border: 1px solid #b91c1c;
            color: #fecaca;
            padding: 10px 12px;
            border-radius: 10px;
            margin-bottom: 14px;
            font-size: 14px;
        }

        .label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: #dbeafe;
        }

        .input {
            width: 100%;
            height: 50px;
            border-radius: 12px;
            border: 1px solid #7c8ea7;
            background: #ffffff;
            color: #0f172a;
            padding: 0 14px;
            font-size: 18px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        .input[readonly] {
            background: #e2e8f0;
            color: #334155;
        }

        .btn {
            width: 100%;
            height: 50px;
            border-radius: 12px;
            border: 0;
            background: #3b82f6;
            color: #ffffff;
            font-size: 20px;
            font-weight: 800;
            cursor: pointer;
            margin-top: 8px;
        }

        .back-link {
            display: inline-block;
            margin-top: 14px;
            color: #93c5fd;
            text-decoration: none;
            font-weight: 700;
        }

        @media (max-width: 640px) {
            .card { padding: 18px 14px; }
            .title { font-size: 24px; }
            .input { height: 44px; font-size: 15px; }
            .btn { height: 44px; font-size: 16px; }
            .logo-band { padding: 10px 12px; }
            .logo-band img { height: 32px; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <div class="wrap">
            <div class="logo-band">
                <div class="logo-slot left"><img src="/images/logo-cmc.png" alt="CMC"></div>
                <div class="logo-sep"></div>
                <div class="logo-slot right"><img src="/images/logo-ofppt.png" alt="OFPPT"></div>
            </div>

            <div class="card">
                <h1 class="title">Nouveau mot de passe</h1>
                <p class="subtitle">Code OTP valide. Definissez maintenant votre nouveau mot de passe.</p>

                @if($errors->any())
                    <div class="error-box">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('password.otp.reset', [], false) }}">
                    @csrf

                    <label class="label" for="email">Email</label>
                    <input class="input" id="email" type="email" value="{{ $email }}" readonly>

                    <label class="label" for="password">Nouveau mot de passe</label>
                    <input class="input" id="password" type="password" name="password" required autocomplete="new-password">

                    <label class="label" for="password_confirmation">Confirmer mot de passe</label>
                    <input class="input" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">

                    <button class="btn" type="submit">Confirmer</button>
                </form>

                <a class="back-link" href="{{ route('password.request', [], false) }}">Retour au code OTP</a>
            </div>
        </div>
    </div>
</body>
</html>
