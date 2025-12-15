<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Family Cafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-[#F8FAFC] text-slate-700 antialiased min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">

        <div class="text-center mb-10">
            <a href="{{ route('order.index') }}" class="inline-flex items-center gap-3 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-emerald-500" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12.0002 11.2426L7.75752 6.99998L6.34331 8.41419L12.0002 14.0711L17.657 8.41419L16.2428 6.99998L12.0002 11.2426Z" opacity="0.5"/>
                    <path d="M6 15C6 13.3431 7.34315 12 9 12H15C16.6569 12 18 13.3431 18 15V19C18 20.6569 16.6569 22 15 22H9C7.34315 22 6 20.6569 6 19V15Z" />
                    <path d="M9 2C9 3.65685 10.3431 5 12 5C13.6569 5 15 3.65685 15 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
                <span class="text-3xl font-bold tracking-tight text-slate-800">Family<span class="text-emerald-500">Cafe.</span></span>
            </a>
            <h1 class="text-2xl font-bold text-slate-800 mt-8">Selamat Datang Kembali!</h1>
            <p class="text-slate-500 mt-2">Masuk untuk melanjutkan pesanan Anda.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 sm:p-10">
            @if (session('status'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        placeholder="email@contoh.com"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                    @error('email')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                    <input id="password" type="password" name="password" required
                        placeholder="••••••••"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                    @error('password')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-emerald-500 focus:ring-emerald-500/20">
                        <span class="text-sm text-slate-600">Ingat saya</span>
                    </label>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-emerald-500 hover:text-emerald-600 font-medium transition-colors">Lupa password?</a>
                    @endif
                </div>

                <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-3 rounded-full font-semibold shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 transition-all">
                    Masuk
                </button>
            </form>

            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-200"></div></div>
                <div class="relative flex justify-center text-sm"><span class="px-4 bg-white text-slate-400">atau</span></div>
            </div>

            <p class="text-center text-slate-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-emerald-500 hover:text-emerald-600 font-semibold transition-colors">Daftar yuk!</a>
            </p>
        </div>

        <p class="text-center text-sm text-slate-400 mt-8">© {{ date('Y') }} FamilyCafe. Semua hak cipta dilindungi.</p>
    </div>
</body>
</html>
