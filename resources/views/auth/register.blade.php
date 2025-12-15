<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Family Cafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-[#F8FAFC] text-slate-700 antialiased min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Header -->
        <div class="text-center mb-8">
            <a href="{{ route('order.index') }}" class="inline-flex items-center gap-3 group">
                <div class="w-14 h-14 bg-emerald-500 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:shadow-emerald-500/50 transition-shadow">
                    <span class="text-2xl">☕</span>
                </div>
            </a>
            <h1 class="text-3xl font-bold text-slate-800 mt-6">Join the Club!</h1>
            <p class="text-slate-500 mt-2">Daftar gratis, dapetin promo spesial</p>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        placeholder="Nama kamu"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                    @error('name')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        placeholder="email@contoh.com"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                    @error('email')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                    <input id="password" type="password" name="password" required
                        placeholder="Min. 8 karakter"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                    @error('password')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        placeholder="Ulangi password"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                    @error('password_confirmation')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-3 rounded-xl font-semibold shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 transition-all">
                    Daftar Sekarang
                </button>
            </form>

            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-100"></div></div>
                <div class="relative flex justify-center text-sm"><span class="px-4 bg-white text-slate-400">atau</span></div>
            </div>

            <p class="text-center text-slate-600">
                Udah punya akun?
                <a href="{{ route('login') }}" class="text-emerald-500 hover:text-emerald-600 font-semibold">Login aja!</a>
            </p>
        </div>

        <p class="text-center text-sm text-slate-400 mt-8">© {{ date('Y') }} FamilyCafe</p>
    </div>
</body>
</html>
