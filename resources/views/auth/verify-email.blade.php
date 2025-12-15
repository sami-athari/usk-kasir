<x-guest-layout>
    <div class="text-center mb-6">
        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <span class="text-2xl">📧</span>
        </div>
        <h2 class="text-2xl font-bold text-slate-800">Verifikasi Email</h2>
        <p class="text-slate-500 mt-2 text-sm">Cek inbox email kamu dan klik link verifikasi yang kami kirim.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm">
        Link verifikasi baru telah dikirim ke email kamu.
    </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-3 rounded-xl font-semibold shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 transition-all">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full py-3 rounded-xl font-medium text-slate-500 hover:text-slate-700 hover:bg-slate-50 transition-all">
                Logout
            </button>
        </form>
    </div>
</x-guest-layout>
