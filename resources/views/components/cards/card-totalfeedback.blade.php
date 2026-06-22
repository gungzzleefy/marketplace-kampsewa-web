<div class="group relative w-full overflow-hidden rounded-[28px] border border-slate-200/70 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-slate-200/70">

    <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-blue-100/60 blur-2xl"></div>

    <div class="relative z-10">
        <div class="flex items-start justify-between gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                <i class="fi fi-rr-feedback mt-1 text-[20px]"></i>
            </div>

            @if ($percentageFeedbackChange >= 0)
                <div class="flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-500">
                    {{ $percentageFeedbackChange }}%
                    <i class="fi fi-rr-arrow-small-up mt-1"></i>
                </div>
            @else
                <div class="flex items-center gap-1 rounded-full bg-red-50 px-3 py-1 text-xs font-bold text-red-500">
                    {{ abs($percentageFeedbackChange) }}%
                    <i class="fi fi-rr-arrow-small-down mt-1"></i>
                </div>
            @endif
        </div>

        <div class="mt-5">
            <h5 class="text-3xl font-black tracking-tight text-slate-900">
                {{ $total_feedback }} +
            </h5>
            <p class="mt-1 text-sm font-medium text-slate-500">
                Total Feedback
            </p>
        </div>

        <a href="{{ route('notification.index') }}"
            class="mt-5 flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-br from-[#B381F4] to-[#5038ED] px-4 py-3 text-sm font-bold text-white shadow-lg shadow-violet-500/20 transition-all duration-300 hover:shadow-xl hover:shadow-violet-500/30">
            Detail
            <i class="bi bi-arrow-right text-sm"></i>
        </a>
    </div>
</div>