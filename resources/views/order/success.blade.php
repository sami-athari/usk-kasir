@extends('layouts.pos')
@section('title', 'Struk - Family Cafe')
@section('content')
<div class="max-w-2xl mx-auto receipt-container">
    <div class="flex items-center justify-between gap-3 mb-6 print:hidden">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Transaksi Selesai</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm">Struk di bawah ini bisa langsung dicetak ke PDF.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('order.history') }}" class="px-4 py-2 rounded-xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 text-slate-600 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">Riwayat</a>
            <a href="{{ route('order.index') }}" class="px-4 py-2 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-semibold shadow-lg shadow-emerald-500/20 transition-all">Transaksi Baru</a>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden receipt-card">
        <div class="p-6 receipt">
            <div class="text-center">
                <div class="inline-flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-emerald-500" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.0002 11.2426L7.75752 6.99998L6.34331 8.41419L12.0002 14.0711L17.657 8.41419L16.2428 6.99998L12.0002 11.2426Z" opacity="0.5"/>
                        <path d="M6 15C6 13.3431 7.34315 12 9 12H15C16.6569 12 18 13.3431 18 15V19C18 20.6569 16.6569 22 15 22H9C7.34315 22 6 20.6569 6 19V15Z" />
                        <path d="M9 2C9 3.65685 10.3431 5 12 5C13.6569 5 15 3.65685 15 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <div class="text-lg font-bold text-slate-800 dark:text-white">Family<span class="text-emerald-500">Cafe.</span></div>
                </div>
                <div class="text-sm text-slate-500 dark:text-slate-400">Struk Pembayaran (Tunai)</div>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-3 text-sm">
                <div class="text-slate-500 dark:text-slate-400">No. Antrean</div>
                <div class="text-right font-semibold text-slate-800 dark:text-white">{{ $order->queue_number }}</div>

                <div class="text-slate-500 dark:text-slate-400">Kasir</div>
                <div class="text-right font-semibold text-slate-800 dark:text-white">{{ $order->customer_name }}</div>

                <div class="text-slate-500 dark:text-slate-400">Waktu</div>
                <div class="text-right font-semibold text-slate-800 dark:text-white">{{ $order->created_at->format('d M Y, H:i') }}</div>
            </div>

            <div class="mt-6 border-t border-dashed border-slate-200 dark:border-slate-600 pt-4">
                <div class="space-y-2">
                    @foreach($order->items as $item)
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0 flex-1 flex flex-col">
                            <div class="font-medium text-slate-800 dark:text-white leading-snug break-words">{{ $item->product->name ?? 'Produk Dihapus' }}</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400 leading-snug mt-0.5">{{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                        </div>
                        <div class="font-semibold text-slate-800 dark:text-white shrink-0 text-right leading-snug">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-6 border-t border-dashed border-slate-200 dark:border-slate-600 pt-4">
                <div class="flex items-center justify-between">
                    <span class="text-slate-500 dark:text-slate-400">Total</span>
                    <span class="text-xl font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>

                <div class="mt-3 grid grid-cols-2 gap-2 text-sm">
                    <div class="text-slate-500 dark:text-slate-400">Tunai</div>
                    <div class="text-right font-semibold text-slate-800 dark:text-white">
                        Rp {{ number_format($order->cash_received ?? 0, 0, ',', '.') }}
                    </div>

                    <div class="text-slate-500 dark:text-slate-400">Kembalian</div>
                    <div class="text-right font-semibold text-slate-800 dark:text-white">
                        Rp {{ number_format($order->change_amount ?? 0, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            <div class="mt-6 text-center text-xs text-slate-400 dark:text-slate-500">
                Terima kasih.
            </div>
        </div>

        <div class="p-6 bg-slate-50 dark:bg-slate-900/40 border-t border-slate-100 dark:border-slate-700 print:hidden">
            <button type="button" onclick="printThermalReceipt()" class="w-full py-3 rounded-xl font-semibold bg-slate-900 dark:bg-white text-white dark:text-slate-900 hover:opacity-90 transition-all">
                Cetak Struk
            </button>
            <p class="text-xs text-slate-400 dark:text-slate-500 mt-2">Akan otomatis mengunduh PDF ukuran struk (80mm).</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
<script>
    window.__thermalPrinting = false;

    function printThermalReceipt() {
        if (typeof window.printThermalReceipt === 'function') {
            window.printThermalReceipt();
        }
    }

    window.printThermalReceipt = async () => {
        if (window.__thermalPrinting) return;
        window.__thermalPrinting = true;

        const receiptEl = document.querySelector('.receipt');
        if (!receiptEl) {
            window.__thermalPrinting = false;
            return;
        }

        try {
            // Wait briefly for CDN libs (in case network is slow)
            for (let i = 0; i < 20; i++) {
                if (window.jspdf?.jsPDF && window.html2canvas) break;
                await new Promise(r => setTimeout(r, 50));
            }

            const jspdf = window.jspdf;
            if (!jspdf?.jsPDF || !window.html2canvas) {
                Swal?.fire?.({
                    icon: 'error',
                    title: 'Gagal cetak',
                    text: 'Library cetak belum termuat. Coba refresh halaman lalu klik Cetak Struk lagi.'
                });
                return;
            }

            // Render ke lebar thermal (80mm) supaya teks tidak terlalu dempet/ketarik saat diperkecil.
            const THERMAL_WIDTH_PX = Math.round((80 / 25.4) * 96); // 80mm @ 96dpi ≈ 302px
            const wrapper = document.createElement('div');
            wrapper.style.position = 'fixed';
            wrapper.style.left = '-10000px';
            wrapper.style.top = '0';
            wrapper.style.width = THERMAL_WIDTH_PX + 'px';
            wrapper.style.background = '#ffffff';

            const clone = receiptEl.cloneNode(true);
            clone.style.width = '100%';
            clone.style.boxSizing = 'border-box';
            // Biar teks tidak dempet/nyatu saat dirender ke PDF
            clone.style.fontSize = '13px';
            clone.style.lineHeight = '1.4';
            wrapper.appendChild(clone);
            document.body.appendChild(wrapper);

            const wasDark = document.documentElement.classList.contains('dark');
            if (wasDark) document.documentElement.classList.remove('dark');

            const canvas = await window.html2canvas(clone, {
                scale: 3,
                backgroundColor: '#ffffff',
                logging: false,
                useCORS: true
            });

            if (wasDark) document.documentElement.classList.add('dark');
            wrapper.remove();

            const imgData = canvas.toDataURL('image/png');
            const { jsPDF } = jspdf;

            // Ukuran thermal 80mm. Tinggi pakai 297mm dan akan dibuat multi-page jika lebih panjang.
            const pdf = new jsPDF({
                orientation: 'portrait',
                unit: 'mm',
                format: [80, 297]
            });

            // Banyak printer 80mm punya area cetak efektif ~72mm.
            const paperWidth = 80;
            const paperHeight = 297;
            const marginX = 4;
            const marginY = 4;
            const printableWidth = paperWidth - (marginX * 2);
            const printableHeight = paperHeight - (marginY * 2);

            const imgHeight = (canvas.height * printableWidth) / canvas.width;

            let heightLeft = imgHeight;
            let position = marginY;

            pdf.addImage(imgData, 'PNG', marginX, position, printableWidth, imgHeight);
            heightLeft -= printableHeight;

            while (heightLeft > 0) {
                pdf.addPage([paperWidth, paperHeight], 'portrait');
                position = marginY - (imgHeight - heightLeft);
                pdf.addImage(imgData, 'PNG', marginX, position, printableWidth, imgHeight);
                heightLeft -= printableHeight;
            }

            const safeQueue = String(@json($order->queue_number)).replace(/[^a-zA-Z0-9-_]/g, '_');

            const filename = `Struk-${safeQueue}.pdf`;

            // Sesuai request: langsung download PDF, tanpa membuka popup/preview cetak.
            pdf.save(filename);
        } catch (e) {
            Swal?.fire?.({
                icon: 'error',
                title: 'Gagal cetak',
                text: 'Terjadi kesalahan saat membuat PDF struk.'
            });
        } finally {
            window.__thermalPrinting = false;
        }
    };
</script>
@endpush



