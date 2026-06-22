@extends('layouts.developers.ly-dashboard')

@section('content')
    <div class="min-h-screen w-full bg-[#F6F7FB] px-4 py-5 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-6 flex flex-col gap-4 rounded-[28px] bg-gradient-to-br from-[#19191B] via-[#24243A] to-[#5038ED] p-5 text-white shadow-lg sm:p-7 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <a href="{{ route('kelola-pengguna.index') }}"
                    class="mb-4 inline-flex items-center gap-2 rounded-full bg-white/15 px-3 py-1.5 text-xs font-bold text-white backdrop-blur transition hover:bg-white/25">
                    <i class="fi fi-rr-arrow-small-left text-base"></i>
                    <span>Kembali</span>
                </a>

                <h1 class="text-2xl font-bold tracking-tight sm:text-3xl">
                    Detail Pengguna
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-white/75">
                    Lihat informasi customer, produk yang disewakan, dan feedback terbaru dari pengguna.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-3 sm:flex">
                <div class="rounded-2xl bg-white/15 px-4 py-3 backdrop-blur">
                    <p class="text-xs text-white/70">Total Produk</p>
                    <p class="mt-1 text-xl font-bold">{{ $data->total_product ?? 0 }}</p>
                </div>

                <div class="rounded-2xl bg-white/15 px-4 py-3 backdrop-blur">
                    <p class="text-xs text-white/70">Total Feedback</p>
                    <p class="mt-1 text-xl font-bold">{{ $total_feedback ?? 0 }}</p>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="grid grid-cols-1 gap-5 xl:grid-cols-[380px_1fr]">

            {{-- Left: Profile --}}
            <div class="xl:sticky xl:top-5 xl:h-fit">
                @include('components.cards.card-profile-detail-pengguna')
            </div>

            {{-- Right: Information --}}
            <div class="flex flex-col gap-5">
                @include('components.cards.card-information-detp')

                @include('components.cards.card-produk-disewakan-detp')
            </div>
        </div>
    </div>
@endsection