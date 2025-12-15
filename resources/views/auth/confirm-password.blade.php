<x-guest-layout>
    <div class="text-center mb-6">
        <div class="w-16 h-16 bg-amber-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <span class="text-2xl">🔒</span>
        </div>
        <h2 class="text-2xl font-bold text-slate-800">Konfirmasi Password</h2>
        <p class="text-slate-500 mt-2 text-sm">Ini adalah area yang aman. Konfirmasi password kamu untuk melanjutkan.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf
        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                placeholder="Masukkan password"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
            @error('password')
            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-3 rounded-xl font-semibold shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 transition-all">
            Konfirmasi
        </button>
    </form>
</x-guest-layout>
