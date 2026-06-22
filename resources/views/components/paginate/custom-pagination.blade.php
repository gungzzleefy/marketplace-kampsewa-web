@if ($paginator->hasPages())
    <div class="_pagination">
        <div class="flex w-full flex-wrap items-center justify-center gap-2 pt-1">

            {{-- Tautan Sebelumnya --}}
            @if ($paginator->onFirstPage())
                <span
                    class="inline-flex cursor-not-allowed items-center justify-center rounded-xl bg-slate-100 px-4 py-2 text-[12px] font-bold text-slate-400 shadow-sm">
                    Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="inline-flex items-center justify-center rounded-xl bg-gradient-to-br from-[#B381F4] to-[#5038ED] px-4 py-2 text-[12px] font-bold text-white shadow-lg shadow-violet-500/20 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-violet-500/30">
                    Sebelumnya
                </a>
            @endif

            {{-- Tautan Halaman --}}
            @foreach ($elements as $element)

                {{-- Three Dots Separator --}}
                @if (is_string($element))
                    <span
                        class="inline-flex min-w-9 items-center justify-center rounded-xl bg-white px-4 py-2 text-[12px] font-bold text-slate-400 shadow-sm">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page"
                                class="relative inline-flex min-w-9 scale-[1.05] items-center justify-center rounded-xl bg-gradient-to-br from-[#B381F4] to-[#5038ED] px-4 py-2 text-[12px] font-black text-white shadow-lg shadow-violet-500/30 ring-4 ring-violet-100">
                                {{ $page }}

                                <span
                                    class="absolute -bottom-2 left-1/2 h-1 w-5 -translate-x-1/2 rounded-full bg-[#5038ED]"></span>
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="inline-flex min-w-9 items-center justify-center rounded-xl bg-white px-4 py-2 text-[12px] font-bold text-slate-700 shadow-sm ring-1 ring-slate-200 transition-all duration-300 hover:-translate-y-0.5 hover:bg-violet-50 hover:text-violet-600 hover:ring-violet-200 hover:shadow-md">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tautan Selanjutnya --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="inline-flex items-center justify-center rounded-xl bg-gradient-to-br from-[#B381F4] to-[#5038ED] px-4 py-2 text-[12px] font-bold text-white shadow-lg shadow-violet-500/20 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-violet-500/30">
                    Next
                </a>
            @else
                <span
                    class="inline-flex cursor-not-allowed items-center justify-center rounded-xl bg-slate-100 px-4 py-2 text-[12px] font-bold text-slate-400 shadow-sm">
                    Next
                </span>
            @endif

        </div>
    </div>
@endif