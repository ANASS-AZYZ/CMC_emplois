<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Back - CMC Planning</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 antialiased font-sans">
    <div class="min-h-screen flex flex-col justify-center items-center p-4">
        
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2 tracking-tight">Welcome Back</h1>
            <p class="text-gray-500 font-medium">Access the CMC scheduling and planning system</p>
        </div>

        <div class="w-full max-w-md bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
            
            <div class="flex p-1 bg-gray-100 rounded-xl mb-8">
                <button class="flex-1 py-2 text-sm font-bold text-gray-900 bg-white rounded-lg shadow-sm">
                    Formateur Login
                </button>
                <a href="{{ route('login') }}" class="flex-1 py-2 text-sm font-bold text-gray-500 text-center">
                    Admin Login
                </a>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Academic Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">@</span>
                        <input type="email" name="email" placeholder="Number" required
                               class="block w-full pl-10 pr-32 py-4 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-300 text-sm font-medium">
                            @ofppt-edu.ma
                        </span>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="flex justify-between mb-2">
                        <label class="block text-sm font-bold text-gray-700">Password</label>
                        <a href="#" class="text-xs font-bold text-blue-400">Forgot?</a>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-xs">🔒</span>
                        <input type="password" name="password" placeholder="••••••••" required
                               class="block w-full pl-10 py-4 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                    </div>
                </div>

                <div class="flex items-center mb-8">
                    <input type="checkbox" name="remember" class="w-4 h-4 text-blue-400 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-500 italic">Keep me logged in on this device</span>
                </div>

                <button type="submit" class="w-full py-4 bg-blue-300 text-blue-900 font-black rounded-xl hover:bg-blue-400 transition flex items-center justify-center gap-2 uppercase tracking-widest">
                    Sign In <span>→</span>
                </button>
            </form>
        </div>

        <div class="mt-12 text-center">
            <div class="flex items-center justify-center gap-4 mb-4 opacity-30">
                <hr class="w-16 border-gray-300">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Academic Portal</span>
                <hr class="w-16 border-gray-300">
            </div>
            <a href="{{ route('stagiaire.emploi') }}" class="text-blue-600 font-black hover:underline uppercase text-xs tracking-tighter">
                🔍 Consulter l'emploi du temps (Espace Public)
            </a>
        </div>
    </div>
</body>
</html>