@extends('layouts.developers.ly-dashboard')
@section('content')
    <div class="_container w-full flex gap-4 flex-col p-8">
        <div class="_btn-back w-fit"><a href="{{ route('detail-pengguna.produk-disewakan', ['fullname' => $name]) }}"
                class="flex items-center gap-2 px-4 py-2 gradient-1 text-white rounded-[10px]">
                <p class="mt-1"><i class="text-[18px] fi fi-rr-arrow-small-left"></i></p>
                <p class="text-[14px] font-medium">Kembali</p>
            </a></div>
        <div class="_part-one w-full grid grid-cols-3 gap-8">
            <div class="_component-image-produk flex flex-col gap-2 w-full">
                <div class="_main-image"><img class="rounded-[10px] object-cover w-full h-[350px]"
                        src="{{ \App\Helpers\PhotoHelper::getThumbnailUrl($produk) }}" alt="{{ $produk->nama }}"></div>
                <div class="_all-image w-full grid grid-cols-4 gap-2">
                    @foreach($produk->foto as $p)
                        <img class="w-full object-cover h-[70px] rounded-[10px]"
                            src="{{ \App\Helpers\PhotoHelper::getPhotoUrl($p->url_foto, $p->tipe_sumber) }}" alt="">
                    @endforeach
                </div>
            </div>
            <div class="_component-detail-produk">
                <div class="_nama-produk">
                    <h1 class="text-[18px] font-medium">{{ $produk->nama }}</h1>
                </div>
                <div class="_rating-totaldisewa mt-2 flex gap-2 items-center">
                    <div class="_totaldisewa font-medium text-[14px]">Total Disewa <font class="text-gray-400">57</font>
                    </div>
                    <div class="_node w-[5px] h-[5px] rounded-full bg-black/60"></div>
                    <div class="_rating flex gap-1 items-center">
                        <div class="mt-1"><i class="text-yellow-400 fi fi-rr-heart-rate"></i></div>
                        <div class="text-[14px] font-medium">4.5 <font class="text-gray-400">(218 rating)</font>
                        </div>
                    </div>
                </div>
                <div class="_harga-sewa mt-2">
                    <p class="text-[14px] font-medium text-gray-400">Harga Sewa:</p>
                    <p class="text-[28px] font-bold">Rp. {{ number_format($harga_sewa_terkecil, 0, ',', '.') }} <sup class="text-[14px] font-medium">/Hari</sup></p>
                </div>
                <div class="_divider mt-4 w-full h-[1px] rounded-full bg-gray-300"></div>
                <div class="_stok-status-category mt-4">
                    <div class="_stok">
                        <font class="text-gray-400">Stok</font>: {{ $stok_produk }}
                    </div>
                    <div class="_status-produk">
                        <font class="text-gray-400">Status</font>: <span class="capitalize">{{ $produk->status }}</span>
                    </div>
                    <div class="_category-produk">
                        <font class="text-gray-400">Kategori</font>: {{ $produk->kategori }}
                    </div>
                </div>
                <div class="_divider mt-4 w-full h-[1px] rounded-full bg-gray-300"></div>
                <div class="_deskripsi mt-4">
                    <p class="text-[14px] font-medium text-gray-400">Deskripsi:</p>
                    <p class="text-[14px]">{{ $produk->deskripsi }}</p>
                </div>
            </div>
            <div class="_component-produk-pernah-disewa-oleh">
                <div class="_design flex flex-col gap-4">
                    <div class="_title">
                        <p class="text-[18px] font-medium">Riwayat Sewa</p>
                        <p class="text-[14px]">Berikut daftar barang ini pernah disewa oleh beberapa customer.</p>
                    </div>
                    <div
                        class="_card-design shadow-box-shadow-36 rounded-[10px] w-full h-[400px] overflow-y-auto p-2 flex flex-col gap-2">
                        @for ($i = 1; $i <= 10; $i++)
                            <div class="_card-item">
                                <a href=""
                                    class="hover:bg-[#F2F5FD] p-2 rounded-[10px] flex justify-between w-full items-center">
                                    <div class="_img-name-duration flex items-center gap-1">
                                        <div class="_img"><img class="w-[40px] h-[40px] rounded-full object-cover"
                                                src="{{ asset('assets/image/developers/agung-kurniawan.jpg') }}"
                                                alt=""></div>
                                        <div class="_name-duration">
                                            <p class="text-[14px] font-medium">Agung Kurniawan</p>
                                            <div class="flex gap-1 items-center">
                                                <p class="mt-1"><i class="fi fi-rr-clock-three"></i></p>
                                                <p class="text-[12px]">3 Hari</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-1"><i class="fi fi-rr-angle-small-right"></i></div>
                                </a>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
