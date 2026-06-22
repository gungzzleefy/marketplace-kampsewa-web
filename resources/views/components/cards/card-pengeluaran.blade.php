@php
    $rawPengeluaranChange = (float) str_replace(',', '.', $percentagePengeluaranChange);
    $progressPengeluaran = min(max(abs($rawPengeluaranChange), 0), 100);
    $visualProgressPengeluaran = $progressPengeluaran > 0 && $progressPengeluaran < 6 ? 6 : $progressPengeluaran;
@endphp

<div class="relative min-h-[260px] w-full overflow-hidden rounded-[28px] border border-slate-200/70 bg-white p-5 shadow-sm transition-all duration-300 hover:shadow-xl hover:shadow-slate-200/70">

    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-emerald-100/70 blur-2xl"></div>

    <div class="relative z-10 flex h-full min-h-[220px] flex-col justify-between">

        <div class="flex items-start justify-between gap-4">
            <div class="min-w-0">
                <p class="text-sm font-semibold text-slate-500">
                    Pengeluaran
                </p>

                <div class="mt-2 flex flex-wrap items-center gap-2">
                    <h1 class="break-words text-2xl font-black tracking-tight text-slate-900 sm:text-[26px]">
                        Rp. {{ $pengeluaran_bulan_ini }}
                    </h1>

                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-black text-emerald-500">
                        {{ $percentagePengeluaranChange }}%
                    </span>
                </div>
            </div>

            <a href="{{ route('pengeluaran.index') }}"
                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-slate-100 text-slate-700 transition-all duration-300 hover:-translate-y-0.5 hover:bg-violet-100 hover:text-violet-600">
                <i class="bi bi-arrow-up-right"></i>
            </a>
        </div>

        <div class="mt-8">
            <p class="mb-3 text-xs font-medium text-slate-500">
                Bulan {{ Carbon\Carbon::now()->subMonth()->format('F') }}
                <strong class="font-black text-slate-900">
                    Rp. {{ $pengeluaran_bulan_lalu }}
                </strong>
            </p>

            <div class="relative h-12 w-full overflow-hidden rounded-2xl bg-slate-100 p-1">
                <div class="h-full rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 shadow-sm transition-all duration-700"
                    style="width: {{ number_format($visualProgressPengeluaran, 2, '.', '') }}%;">
                </div>

                <div class="absolute inset-0 flex items-center justify-center">
                    <p class="text-sm font-black text-slate-700">
                        {{ $percentagePengeluaranChange }}%
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>