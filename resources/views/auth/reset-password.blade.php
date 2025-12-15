<x-guest-layout>
    <div class="text-center mb-6">
        <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <span class="text-2xl">🔐</span>
        </div>
        <h2 class="text-2xl font-bold text-slate-800">Reset Password</h2>
        <p class="text-slate-500 mt-2 text-sm">Buat password baru untuk akun kamu</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none bg-slate-50"
                readonly>
            @error('email')
            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password Baru</label>
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
                placeholder="Ulangi password baru"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
            @error('password_confirmation')
            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-3 rounded-xl font-semibold shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 transition-all">
            Reset Password
        </button>
    </form>
</x-guest-layout>
