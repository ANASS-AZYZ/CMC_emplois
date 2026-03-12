<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Emploi du Temps - CMC</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-cmc.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
        {{ $slot }}
    </div>
</body>
</html>