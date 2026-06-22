<div class="w-full overflow-hidden rounded-[28px] border border-violet-200/70 bg-white shadow-sm">
    <div class="border-b border-slate-100 p-5 sm:p-6">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <div
                    class="mb-2 inline-flex items-center gap-1.5 rounded-full bg-violet-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wide text-violet-600">
                    <i class="fi fi-rr-comments flex text-[10px]"></i>
                    Customer Membalas Lagi
                </div>

                <h2 class="text-xl font-black tracking-tight text-slate-900 sm:text-2xl">
                    Reply Masuk
                </h2>

                <p class="mt-1 text-sm font-medium text-slate-400">
                    Daftar customer yang mengirim balasan terbaru setelah feedback dibalas.
                </p>
            </div>

           @php
    $customerReplyCount = isset($customerReplies)
        ? (method_exists($customerReplies, 'total') ? $customerReplies->total() : $customerReplies->count())
        : 0;
@endphp

            <span id="customerReplyTotal"
                class="shrink-0 rounded-full bg-violet-50 px-4 py-2 text-sm font-bold text-violet-600">
                {{ $customerReplyCount }} chat
            </span>
        </div>
    </div>

    @php
    $isCustomerReplyFiltered =
        request('customer_reply_sort', 'date_latest') !== 'date_latest' ||
        request('customer_reply_kriteria', 'all') !== 'all';
@endphp

<form method="GET" action="{{ route('notification.index') }}"
    class="mx-5 mt-5 overflow-hidden rounded-[26px] border border-violet-200/70 bg-gradient-to-br from-violet-50/70 via-white to-slate-50 p-4 shadow-sm sm:mx-6">

    <input type="hidden" name="feedback_sort" value="{{ request('feedback_sort', 'date_latest') }}">
    <input type="hidden" name="feedback_kriteria" value="{{ request('feedback_kriteria', 'all') }}">
    <input type="hidden" name="reply_sort" value="{{ request('reply_sort', 'date_latest') }}">
    <input type="hidden" name="reply_kriteria" value="{{ request('reply_kriteria', 'all') }}">

    <div class="mb-4 flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
        <div class="flex items-center gap-3">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-white text-violet-600 shadow-sm ring-1 ring-violet-100">
                <i class="fi fi-rr-filter flex text-[17px]"></i>
            </div>

            <div>
                <h3 class="text-sm font-black text-slate-900">
                    Filter & Sorting
                </h3>
                <p class="mt-0.5 text-xs font-medium text-slate-400">
                    Atur urutan customer yang membalas lagi.
                </p>
            </div>
        </div>

        @if ($isCustomerReplyFiltered)
            <span class="inline-flex w-fit items-center gap-2 rounded-full bg-violet-100 px-3 py-1.5 text-xs font-black text-violet-700">
                <span class="h-1.5 w-1.5 rounded-full bg-violet-600"></span>
                Filter aktif
            </span>
        @else
            <span class="inline-flex w-fit items-center gap-2 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-black text-slate-500">
                <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                Default view
            </span>
        @endif
    </div>

    <div class="grid grid-cols-1 gap-3 lg:grid-cols-[1fr_1fr_auto]">
        <div class="group">
            <label class="mb-2 flex items-center gap-2 text-[11px] font-black uppercase tracking-[0.18em] text-slate-400">
                <i class="fi fi-rr-sort-alt flex text-[12px] text-violet-400"></i>
                Sort Reply Masuk
            </label>

            <div class="relative">
                <div class="pointer-events-none absolute left-4 top-1/2 z-10 flex h-8 w-8 -translate-y-1/2 items-center justify-center rounded-xl bg-violet-50 text-violet-500">
                    <i class="fi fi-rr-calendar-clock flex text-[14px]"></i>
                </div>

                <select name="customer_reply_sort" onchange="this.form.submit()"
                    class="h-[52px] w-full appearance-none rounded-[20px] border border-slate-200 bg-white py-3 pl-14 pr-12 text-sm font-bold text-slate-700 shadow-sm outline-none transition-all duration-300 hover:border-violet-200 hover:shadow-md focus:border-violet-400 focus:ring-4 focus:ring-violet-100">
                    <option value="date_latest" @selected(request('customer_reply_sort', 'date_latest') == 'date_latest')>Tanggal terbaru</option>
                    <option value="date_oldest" @selected(request('customer_reply_sort') == 'date_oldest')>Tanggal terlama</option>
                    <option value="kriteria_best" @selected(request('customer_reply_sort') == 'kriteria_best')>Kriteria terbaik</option>
                    <option value="kriteria_worst" @selected(request('customer_reply_sort') == 'kriteria_worst')>Kriteria terburuk</option>
                </select>

                <div class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-slate-400">
                    <i class="fi fi-rr-angle-small-down flex text-[18px]"></i>
                </div>
            </div>
        </div>

        <div class="group">
            <label class="mb-2 flex items-center gap-2 text-[11px] font-black uppercase tracking-[0.18em] text-slate-400">
                <i class="fi fi-rr-star flex text-[12px] text-amber-400"></i>
                Filter Kriteria
            </label>

            <div class="relative">
                <div class="pointer-events-none absolute left-4 top-1/2 z-10 flex h-8 w-8 -translate-y-1/2 items-center justify-center rounded-xl bg-amber-50 text-amber-500">
                    <i class="fi fi-rr-chart-histogram flex text-[14px]"></i>
                </div>

                <select name="customer_reply_kriteria" onchange="this.form.submit()"
                    class="h-[52px] w-full appearance-none rounded-[20px] border border-slate-200 bg-white py-3 pl-14 pr-12 text-sm font-bold text-slate-700 shadow-sm outline-none transition-all duration-300 hover:border-violet-200 hover:shadow-md focus:border-violet-400 focus:ring-4 focus:ring-violet-100">
                    <option value="all" @selected(request('customer_reply_kriteria', 'all') == 'all')>Semua kriteria</option>
                    <option value="baik" @selected(request('customer_reply_kriteria') == 'baik')>Baik / Sangat Baik</option>
                    <option value="cukup" @selected(request('customer_reply_kriteria') == 'cukup')>Cukup</option>
                    <option value="buruk" @selected(request('customer_reply_kriteria') == 'buruk')>Kurang / Sangat Kurang</option>
                    <option value="sangat_baik" @selected(request('customer_reply_kriteria') == 'sangat_baik')>Sangat Baik saja</option>
                    <option value="baik_only" @selected(request('customer_reply_kriteria') == 'baik_only')>Baik saja</option>
                    <option value="kurang" @selected(request('customer_reply_kriteria') == 'kurang')>Kurang saja</option>
                    <option value="sangat_kurang" @selected(request('customer_reply_kriteria') == 'sangat_kurang')>Sangat Kurang saja</option>
                </select>

                <div class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-slate-400">
                    <i class="fi fi-rr-angle-small-down flex text-[18px]"></i>
                </div>
            </div>
        </div>

        <div class="flex items-end">
            <a href="{{ route('notification.index') }}"
                class="inline-flex h-[52px] w-full items-center justify-center gap-2 rounded-[20px] border border-slate-200 bg-white px-5 text-sm font-black text-slate-500 shadow-sm transition-all duration-300 hover:border-red-100 hover:bg-red-50 hover:text-red-500 hover:shadow-md lg:w-auto">
                <i class="fi fi-rr-refresh flex text-[14px]"></i>
                Reset
            </a>
        </div>
    </div>
</form>

    <div id="customerReplyList" class="p-4 sm:p-5">
        @include('components.cards.customer-reply-list-items', [
            'customerReplies' => $customerReplies ?? collect(),
        ])
    </div>

    @if (isset($customerReplies) && method_exists($customerReplies, 'links') && $customerReplies->hasPages())
    <div id="customerReplyPagination" class="border-t border-slate-100 p-4">
        {{ $customerReplies->onEachSide(1)->links('components.paginate.custom-pagination') }}
    </div>
@endif
</div>
