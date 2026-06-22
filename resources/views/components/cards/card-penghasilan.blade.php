@php
    $rawPemasukanChange = (float) str_replace(',', '.', $percentagePemasukanChange);
    $progressPemasukan = min(max(abs($rawPemasukanChange), 0), 100);
    $visualProgressPemasukan = $progressPemasukan > 0 && $progressPemasukan < 6 ? 6 : $progressPemasukan;
@endphp

<div class="relative min-h-[260px] w-full overflow-hidden rounded-[28px] bg-gradient-to-br from-[#B381F4] to-[#5038ED] p-5 shadow-xl shadow-violet-500/20">

    <img class="absolute inset-0 h-full w-full object-cover opacity-30"
        src="{{ asset('assets/accessories/gradient 3-04 1 1.png') }}" alt="">

    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/20 blur-2xl"></div>
    <div class="absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-white/10 blur-2xl"></div>

    <div class="relative z-10 flex h-full min-h-[220px] flex-col justify-between">

        <div class="flex items-start justify-between gap-4">
            <div class="min-w-0">
                <p class="text-sm font-semibold text-white/75">
                    Penghasilan
                </p>

                <div class="mt-2 flex flex-wrap items-center gap-2">
                    <h1 class="break-words text-2xl font-black tracking-tight text-white sm:text-[26px]">
                        Rp. {{ $pemasukan_bulan_ini }}
                    </h1>

                    <span class="rounded-full bg-white/90 px-3 py-1 text-xs font-black text-[#5038ED]">
                        {{ $percentagePemasukanChange }}%
                    </span>
                </div>
            </div>

            <a href="{{ route('penghasilan.index') }}"
                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-white/90 text-slate-900 shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:bg-white">
                <i class="bi bi-arrow-up-right"></i>
            </a>
        </div>

        <div class="mt-8">
            <p class="mb-3 text-xs font-medium text-white/80">
                Bulan {{ Carbon\Carbon::now()->subMonth()->format('F') }}
                <strong class="font-black text-white">
                    Rp. {{ $pemasukan_bulan_lalu }}
                </strong>
            </p>

            <div class="relative h-12 w-full overflow-hidden rounded-2xl bg-white/20 p-1">
                <div class="h-full rounded-xl bg-white/90 shadow-sm transition-all duration-700"
                    style="width: {{ number_format($visualProgressPemasukan, 2, '.', '') }}%;">
                </div>

                <div class="absolute inset-0 flex items-center justify-center">
                    <p class="text-sm font-black text-white drop-shadow">
                        {{ $percentagePemasukanChange }}%
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>