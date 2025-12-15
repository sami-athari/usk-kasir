<x-guest-layout>
    <div class="text-center mb-6">
        <div class="w-16 h-16 bg-amber-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <span class="text-2xl">🔑</span>
        </div>
        <h2 class="text-2xl font-bold text-slate-800">Lupa Password?</h2>
        <p class="text-slate-500 mt-2 text-sm">Masukkan email kamu dan kami akan kirim link reset password.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
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

        <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-3 rounded-xl font-semibold shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 transition-all">
            Kirim Link Reset
        </button>
    </form>

    <p class="text-center text-slate-600 mt-6">
        Ingat password?
        <a href="{{ route('login') }}" class="text-emerald-500 hover:text-emerald-600 font-semibold">Login</a>
    </p>
</x-guest-layout>
