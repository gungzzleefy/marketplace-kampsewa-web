@extends('layouts.developers.ly-dashboard')

@section('content')
    <div class="w-full px-4 py-5 sm:px-5 lg:px-6">

        {{-- Summary Cards --}}
        <section class="grid w-full grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @include('components.cards.card-totalpengguna')
            @include('components.cards.card-totalfeedback')
            @include('components.cards.card-totaltransaksi')
            @include('components.cards.card-totalmitra')
        </section>

        {{-- Finance + New Customer --}}
        <section class="mt-5 grid w-full grid-cols-1 gap-4 2xl:grid-cols-[minmax(0,2fr)_minmax(320px,1fr)]">

            {{-- Finance Cards --}}
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                @include('components.cards.card-penghasilan')
                @include('components.cards.card-pengeluaran')
                @include('components.cards.card-keuntungan')
                @include('components.cards.card-kerugian')
            </div>

            {{-- New Customer --}}
            <div class="w-full">
                @include('components.cards.cars-listnewuser')
            </div>
        </section>

        {{-- Online Customer Table --}}
        <section class="mt-5 w-full">
            @include('components.tables.table-customer')
        </section>

    </div>
@endsection