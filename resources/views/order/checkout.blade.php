@extends('layouts.pos')
@section('title', 'Checkout - Family Cafe')
@section('content')
<div x-data="checkoutLogic()">
    <!-- Header -->
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('order.index') }}" class="p-2 rounded-xl bg-white border border-slate-100 text-slate-500 hover:text-emerald-500 hover:border-emerald-200 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Checkout</h1>
            <p class="text-slate-500 text-sm">Cek pesanan kamu sebelum bayar</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100">
                    <h3 class="font-semibold text-slate-800">Pesanan Kamu</h3>
                </div>
                <div class="divide-y divide-slate-100">
                    <template x-for="(item, index) in cart" :key="item.id">
                        <div class="p-4 flex items-center gap-4">
                            <div class="w-16 h-16 rounded-xl bg-slate-50 flex items-center justify-center text-2xl flex-shrink-0">☕</div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-slate-800 truncate" x-text="item.name"></p>
                                <p class="text-sm text-slate-500" x-text="formatRupiah(item.price)"></p>
                            </div>
                            <div class="flex items-center gap-2 bg-slate-50 rounded-xl p-1">
                                <button @click="decreaseQty(index)" class="w-8 h-8 rounded-lg bg-white border border-slate-200 text-slate-600 hover:border-emerald-300 hover:text-emerald-600 transition-all flex items-center justify-center font-bold">−</button>
                                <span class="w-8 text-center font-semibold text-slate-800" x-text="item.qty"></span>
                                <button @click="increaseQty(index)" class="w-8 h-8 rounded-lg bg-white border border-slate-200 text-slate-600 hover:border-emerald-300 hover:text-emerald-600 transition-all flex items-center justify-center font-bold">+</button>
                            </div>
                            <p class="font-bold text-emerald-600 w-28 text-right" x-text="formatRupiah(item.price * item.qty)"></p>
                            <button @click="removeFromCart(index)" class="p-2 text-slate-400 hover:text-red-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </template>
                </div>
                <div class="px-6 py-4 bg-slate-50 flex items-center justify-between">
                    <span class="font-semibold text-slate-700">Total Bayar</span>
                    <span class="text-xl font-bold text-emerald-600" x-text="formatRupiah(totalPrice)"></span>
                </div>
            </div>
        </div>

        <!-- Payment Method -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 sticky top-24">
                <h3 class="font-semibold text-slate-800 mb-4">Pilih Pembayaran</h3>
                <div class="space-y-3">
                    <label class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer transition-all" :class="paymentMethod === 'qris' ? 'border-emerald-500 bg-emerald-50' : 'border-slate-100 hover:border-slate-200'">
                        <input type="radio" name="payment" value="qris" x-model="paymentMethod" class="sr-only">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white text-xs font-bold">QR</div>
                        <span class="font-medium text-slate-700">QRIS</span>
                        <svg x-show="paymentMethod === 'qris'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500 ml-auto" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </label>
                    @foreach(['gopay' => '💚', 'dana' => '💙', 'shopeepay' => '🧡', 'ovo' => '💜'] as $wallet => $emoji)
                    <label class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer transition-all" :class="paymentMethod === '{{ $wallet }}' ? 'border-emerald-500 bg-emerald-50' : 'border-slate-100 hover:border-slate-200'">
                        <input type="radio" name="payment" value="{{ $wallet }}" x-model="paymentMethod" class="sr-only">
                        <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center text-xl">{{ $emoji }}</div>
                        <span class="font-medium text-slate-700">{{ ucfirst($wallet) }}</span>
                        <svg x-show="paymentMethod === '{{ $wallet }}'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500 ml-auto" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </label>
                    @endforeach
                </div>

                <button @click="handleMainButton()" :disabled="loading || !paymentMethod"
                    class="w-full mt-6 py-4 rounded-xl font-semibold transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                    :class="paymentMethod ? 'bg-emerald-500 hover:bg-emerald-600 text-white shadow-lg shadow-emerald-500/30' : 'bg-slate-100 text-slate-400'">
                    <span x-show="!loading">
                        <span x-show="!paymentMethod">Pilih Pembayaran Dulu</span>
                        <span x-show="paymentMethod">BAYAR SEKARANG</span>
                    </span>
                    <span x-show="loading" class="flex items-center justify-center gap-2">
                        <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </span>
                </button>
            </div>
        </div>
    </div>

    @if(config('features.pembayaran_metode'))
    <!-- Payment Modal -->
    <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div @click="showModal = false" class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"></div>
        <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-md p-6" x-transition>
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-slate-800">Selesaikan Pembayaran</h3>
                <button @click="showModal = false" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- QRIS -->
            <div x-show="paymentMethod === 'qris'" class="text-center">
                <p class="text-slate-600 mb-4">Scan QR Code di bawah ini:</p>
                <div class="bg-white p-4 rounded-2xl border border-slate-100 inline-block mb-4">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=CafeAppSimulasi" alt="QR Code" class="rounded-xl">
                </div>
                <p class="text-2xl font-bold text-emerald-600 mb-6" x-text="formatRupiah(totalPrice)"></p>
                <button @click="submitOrder()" class="w-full py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-semibold transition-colors">
                    SAYA SUDAH BAYAR
                </button>
            </div>

            <!-- E-Wallet -->
            <div x-show="paymentMethod !== 'qris'" class="space-y-4">
                <div class="text-center mb-4">
                    <span class="inline-block px-4 py-2 bg-slate-100 rounded-xl text-sm font-medium text-slate-600 uppercase" x-text="paymentMethod"></span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Nomor HP</label>
                    <input type="number" x-model="walletPhone" placeholder="0812..."
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">PIN (6 Digit)</label>
                    <input type="password" x-model="walletPin" maxlength="6" placeholder="••••••"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                </div>
                <button @click="validateWallet()" class="w-full py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-semibold transition-colors">
                    BAYAR SEKARANG
                </button>
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
function checkoutLogic() {
    return {
        loading: false, paymentMethod: null, showModal: false, walletPhone: '', walletPin: '',
        init() { if (this.cart.length === 0) window.location.href = "{{ route('order.index') }}"; },
        increaseQty(index) { let item = this.cart[index]; let maxStock = item.maxStock || 999; if (item.qty >= maxStock) { Swal.fire({ icon: 'warning', title: 'Stok Terbatas!', text: 'Maksimal ' + maxStock, confirmButtonColor: '#10b981' }); return; } item.qty++; },
        decreaseQty(index) { let item = this.cart[index]; if (item.qty > 1) { item.qty--; } else { Swal.fire({ title: 'Hapus item ini?', icon: 'question', showCancelButton: true, confirmButtonColor: '#10b981', cancelButtonColor: '#6b7280', confirmButtonText: 'Ya, Hapus!' }).then((result) => { if (result.isConfirmed) { this.removeFromCart(index); } }); } },
        handleMainButton() { if (!this.paymentMethod) return; @guest window.location.href = "{{ route('login') }}"; return; @endguest @if(config('features.pembayaran_metode')) this.walletPhone = ''; this.walletPin = ''; this.showModal = true; @else this.submitOrder(); @endif },
        validateWallet() { if (this.walletPhone.length < 8) { Swal.fire({ icon: 'error', title: 'Oops!', text: 'Nomor HP tidak valid!', confirmButtonColor: '#10b981' }); return; } if (this.walletPin.length !== 6) { Swal.fire({ icon: 'error', title: 'Oops!', text: 'PIN harus 6 digit!', confirmButtonColor: '#10b981' }); return; } this.submitOrder(); },
        async submitOrder() { this.loading = true; this.showModal = false; try { let response = await fetch("{{ route('order.store') }}", { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify({ payment_method: this.paymentMethod, cart: this.cart }) }); let result = await response.json(); if (response.ok) { this.cart = []; window.location.href = result.redirect_url; } else { Swal.fire({ icon: 'error', title: 'Gagal!', text: result.message, confirmButtonColor: '#10b981' }); this.loading = false; } } catch (err) { Swal.fire({ icon: 'error', title: 'Koneksi Bermasalah', confirmButtonColor: '#10b981' }); this.loading = false; } }
    }
}
</script>
@endpush
@endsection
