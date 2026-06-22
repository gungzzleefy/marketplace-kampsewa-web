<div class="relative flex min-h-[220px] w-full flex-col justify-between overflow-hidden rounded-[28px] border border-slate-200/70 bg-white p-5 shadow-sm transition-all duration-300 hover:shadow-xl hover:shadow-slate-200/70 sm:flex-row sm:items-center">

    <div class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-red-100/70 blur-2xl"></div>

    <div class="relative z-10 flex h-full flex-col justify-between">
        <div>
            <div class="flex items-center gap-3">
                <div class="h-8 w-8 rounded-xl bg-gradient-to-br from-[#B381F4] to-[#5038ED] shadow-lg shadow-violet-500/20"></div>

                <p class="text-base font-bold text-slate-700">
                    Kerugian
                </p>
            </div>

            <p class="mt-4 break-words text-3xl font-black tracking-tight text-slate-900">
                Rp. {{ $total_kerugian_tahun_ini }}
            </p>

            <p class="mt-3 w-fit rounded-full bg-emerald-50 px-3 py-1 text-sm font-bold text-emerald-500">
                {{ date('Y') }}
            </p>
        </div>

        <a href="{{ route('rekap-keuangan.index') }}"
            class="mt-6 flex w-fit items-center gap-2 rounded-2xl bg-gradient-to-br from-[#B381F4] to-[#5038ED] px-4 py-3 text-xs font-bold text-white shadow-lg shadow-violet-500/20 transition-all duration-300 hover:shadow-xl hover:shadow-violet-500/30">
            Details
            <i class="fi fi-rr-angle-right mt-1"></i>
        </a>
    </div>

    {{-- Chart Kerugian --}}
    @php
    $kerugianChartValue = preg_replace('/[^0-9]/', '', $total_kerugian_tahun_ini);
    $kerugianChartValue = $kerugianChartValue == '' ? 0 : (int) $kerugianChartValue;
@endphp

<div class="relative z-10 mt-6 flex justify-center sm:mt-0">
    <div class="relative h-[120px] w-[120px] shrink-0">
        <canvas
            id="chart-kerugian"
            data-kerugian="{{ $kerugianChartValue }}"
            class="block h-full w-full">
        </canvas>
    </div>
</div>
</div>