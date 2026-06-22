<div class="overflow-hidden rounded-[28px] border border-slate-200 bg-white shadow-sm">

    {{-- Cover --}}
    {{-- Cover --}}
    <div
        class="relative z-0 h-[180px] overflow-hidden rounded-t-[28px] bg-gradient-to-br from-[#19191B] via-[#24243A] to-[#5038ED]">
        <img class="h-full w-full object-cover opacity-50"
            src="{{ asset('assets/image/customers/background/pexels-juan-mendez-1082316.jpg') }}"
            alt="Background pengguna">

        <div class="absolute inset-0 bg-gradient-to-t from-black/45 via-black/10 to-transparent"></div>

        <span
            class="absolute left-4 top-4 rounded-full bg-white/20 px-3 py-1 text-xs font-bold text-white backdrop-blur">
            Customer
        </span>
    </div>

    {{-- Profile --}}
    <div class="relative z-10 px-5 pb-5">
        <div class="-mt-12 flex items-end justify-between gap-4">
            <div
                class="relative z-20 h-24 w-24 shrink-0 overflow-hidden rounded-[28px] border-4 border-white bg-slate-100 shadow-xl">
                <img class="h-full w-full object-cover" src="@userPhoto($data->foto)" alt="Foto {{ $data->name }}">
            </div>

            <span
                class="mb-2 inline-flex items-center gap-2 rounded-full bg-[#5038ED]/10 px-3 py-1.5 text-xs font-bold text-[#5038ED]">
                <span class="h-2 w-2 rounded-full bg-[#5038ED]"></span>
                Aktif
            </span>
        </div>

        <div class="mt-4">
            <h2 class="line-clamp-1 text-xl font-extrabold text-[#19191B]">
                {{ $data->name }}
            </h2>

            <p class="mt-1 line-clamp-1 text-sm font-medium text-slate-500">
                {{ $data->email ?? 'Email belum di isi.' }}
            </p>

            <div class="mt-3 flex flex-wrap items-center gap-2">
                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-500">
                    ID #{{ $data->user_id }}
                </span>

                <span class="rounded-full bg-[#FDEAEE] px-3 py-1 text-xs font-bold text-[#F5325C]">
                    Customer
                </span>
            </div>
        </div>

        <div class="mt-5 grid grid-cols-1 gap-3">
            <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                <div class="flex items-start gap-3">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-white text-[#5038ED] shadow-sm">
                        <i class="fi fi-rr-calendar"></i>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-400">
                            Bergabung
                        </p>
                        <p class="mt-1 text-sm font-bold text-[#19191B]">
                            {{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                <div class="flex items-start gap-3">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-white text-[#5038ED] shadow-sm">
                        <i class="fi fi-rr-party-horn"></i>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-400">
                            Tanggal Lahir
                        </p>
                        <p class="mt-1 text-sm font-bold text-[#19191B]">
                            {{ $data->tanggal_lahir ? Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y') : 'Belum di isi.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-1">
            <div class="rounded-2xl bg-[#5038ED]/10 p-4">
                <div
                    class="mb-2 flex h-10 w-10 items-center justify-center rounded-2xl bg-white text-[#5038ED] shadow-sm">
                    <i class="fi fi-rr-mobile-notch"></i>
                </div>

                <p class="text-sm font-extrabold text-[#19191B]">
                    Nomor Telepon
                </p>
                <p class="mt-1 break-words text-sm font-medium text-slate-500">
                    {{ $data->nomor_telephone ?: 'Belum di isi.' }}
                </p>
            </div>

            <div class="rounded-2xl bg-[#FDEAEE] p-4">
                <div
                    class="mb-2 flex h-10 w-10 items-center justify-center rounded-2xl bg-white text-[#F5325C] shadow-sm">
                    <i class="fi fi-rr-venus-mars"></i>
                </div>

                <p class="text-sm font-extrabold text-[#19191B]">
                    Jenis Kelamin
                </p>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ $data->jenis_kelamin ?: 'Belum di isi.' }}
                </p>
            </div>
        </div>
    </div>
</div>
