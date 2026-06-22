<div id="modal" class="hidden">
    <div class="fixed inset-0 z-50 flex min-h-screen w-full items-center justify-center bg-slate-900/40 px-4 py-6 backdrop-blur-sm"
        onclick="modalHandler(false)">
        <div class="relative flex max-h-[92vh] w-full max-w-[620px] flex-col overflow-hidden rounded-[28px] bg-white shadow-2xl shadow-slate-900/20"
            onclick="event.stopPropagation()">

            {{-- Header --}}
            <div class="relative overflow-hidden bg-gradient-to-br from-[#19191B] via-[#25253A] to-[#12A4ED] px-5 py-5 text-white sm:px-6">
                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-14 left-8 h-28 w-28 rounded-full bg-white/10"></div>

                <div class="relative flex items-start justify-between gap-4">
                    <div class="flex items-start gap-3">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-white/15 backdrop-blur">
                            <i class="fi fi-rr-user-add text-lg"></i>
                        </div>

                        <div>
                            <h2 class="text-lg font-bold">
                                Tambah Customer
                            </h2>
                            <p class="mt-1 text-sm leading-5 text-white/70">
                                Lengkapi data customer baru dengan benar.
                            </p>
                        </div>
                    </div>

                    <button type="button" onclick="modalHandler(false)"
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-white transition hover:bg-white/25 active:scale-95">
                        <i class="fi fi-rr-cross-small text-2xl"></i>
                    </button>
                </div>
            </div>

            {{-- Form --}}
            <form action="{{ route('kelola-pengguna.store') }}" method="POST" enctype="multipart/form-data"
                class="flex min-h-0 flex-1 flex-col">
                @csrf

                {{-- Body --}}
                <div class="flex-1 overflow-y-auto px-5 py-5 sm:px-6">
                    <div class="grid grid-cols-1 gap-4">

                        {{-- Nama Lengkap --}}
                        <div>
                            <label for="fullname" class="mb-2 block text-sm font-bold text-[#19191B]">
                                Nama Lengkap
                            </label>

                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">
                                    <i class="fi fi-rr-user text-sm"></i>
                                </div>

                                <input
                                    class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 pl-11 pr-4 text-sm font-semibold text-[#19191B] outline-none transition placeholder:text-slate-400 focus:border-[#12A4ED] focus:bg-white focus:ring-4 focus:ring-[#12A4ED]/10 @error('fullname') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror"
                                    placeholder="Masukkan nama lengkap"
                                    type="text"
                                    id="fullname"
                                    name="fullname"
                                    value="{{ old('fullname') }}"
                                    required>
                            </div>

                            @error('fullname')
                                <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="mb-2 block text-sm font-bold text-[#19191B]">
                                Email
                            </label>

                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">
                                    <i class="fi fi-rr-envelope text-sm"></i>
                                </div>

                                <input
                                    class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 pl-11 pr-4 text-sm font-semibold text-[#19191B] outline-none transition placeholder:text-slate-400 focus:border-[#12A4ED] focus:bg-white focus:ring-4 focus:ring-[#12A4ED]/10 @error('email') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror"
                                    placeholder="Masukkan email customer"
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required>
                            </div>

                            @error('email')
                                <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nomor Telepon --}}
                        <div>
                            <label for="number_phone" class="mb-2 block text-sm font-bold text-[#19191B]">
                                Nomor Telepon
                            </label>

                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">
                                    <i class="fi fi-rr-phone-call text-sm"></i>
                                </div>

                                <input
                                    class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 pl-11 pr-4 text-sm font-semibold text-[#19191B] outline-none transition placeholder:text-slate-400 focus:border-[#12A4ED] focus:bg-white focus:ring-4 focus:ring-[#12A4ED]/10 @error('number_phone') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror"
                                    placeholder="Masukkan nomor telepon"
                                    type="text"
                                    id="number_phone"
                                    name="number_phone"
                                    value="{{ old('number_phone') }}"
                                    required>
                            </div>

                            @error('number_phone')
                                <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label for="password" class="mb-2 block text-sm font-bold text-[#19191B]">
                                Password
                            </label>

                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">
                                    <i class="fi fi-rr-lock text-sm"></i>
                                </div>

                                <input
                                    class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 pl-11 pr-12 text-sm font-semibold text-[#19191B] outline-none transition placeholder:text-slate-400 focus:border-[#12A4ED] focus:bg-white focus:ring-4 focus:ring-[#12A4ED]/10 @error('password') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror"
                                    placeholder="Masukkan password"
                                    type="password"
                                    id="password"
                                    name="password"
                                    required>

                                <button type="button" onclick="toggleCustomerPassword()"
                                    class="absolute inset-y-0 right-4 flex items-center text-slate-400 transition hover:text-[#12A4ED]">
                                    <i id="passwordIcon" class="fi fi-rr-eye"></i>
                                </button>
                            </div>

                            @error('password')
                                <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div>
                            <label for="date_of_birth" class="mb-2 block text-sm font-bold text-[#19191B]">
                                Tanggal Lahir
                            </label>

                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">
                                    <i class="fi fi-rr-calendar text-sm"></i>
                                </div>

                                <input
                                    class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 pl-11 pr-4 text-sm font-semibold text-[#19191B] outline-none transition focus:border-[#12A4ED] focus:bg-white focus:ring-4 focus:ring-[#12A4ED]/10 @error('date_of_birth') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror"
                                    type="date"
                                    id="date_of_birth"
                                    name="date_of_birth"
                                    value="{{ old('date_of_birth') }}"
                                    required>
                            </div>

                            @error('date_of_birth')
                                <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div>
                            <label for="gender" class="mb-2 block text-sm font-bold text-[#19191B]">
                                Jenis Kelamin
                            </label>

                            <div class="relative">
                                <select name="gender" id="gender"
                                    class="h-12 w-full appearance-none rounded-2xl border border-slate-200 bg-slate-50 px-4 pr-10 text-sm font-semibold text-[#19191B] outline-none transition focus:border-[#12A4ED] focus:bg-white focus:ring-4 focus:ring-[#12A4ED]/10 @error('gender') border-red-400 focus:border-red-400 focus:ring-red-100 @enderror">
                                    <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki
                                    </option>
                                    <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>
                                </select>

                                <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
                                    <i class="fi fi-rr-angle-small-down"></i>
                                </div>
                            </div>

                            @error('gender')
                                <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Upload Photo --}}
                        <div>
                            <p class="mb-2 text-sm font-bold text-[#19191B]">
                                Upload Photo
                            </p>

                            <label for="photo"
                                class="group relative flex min-h-[210px] w-full cursor-pointer items-center justify-center overflow-hidden rounded-[24px] border-2 border-dashed border-slate-300 bg-slate-50 transition hover:border-[#12A4ED] hover:bg-[#12A4ED]/5">
                                <img id="photoPreview" class="hidden h-full min-h-[210px] w-full object-cover"
                                    src="" alt="Preview foto customer">

                                <div id="photoPlaceholder" class="flex flex-col items-center justify-center px-5 text-center">
                                    <div class="mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-[#12A4ED] shadow-sm">
                                        <i class="fi fi-rr-picture text-[28px]"></i>
                                    </div>

                                    <p class="text-sm font-bold text-[#19191B]">
                                        Upload foto klik <u>disini!</u>
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-slate-500">
                                        Format foto didukung JPG dan PNG. Ukuran maksimal 10 MB.
                                    </p>
                                </div>

                                <div class="absolute bottom-3 right-3 hidden rounded-full bg-white px-3 py-1.5 text-xs font-bold text-[#12A4ED] shadow-md group-hover:block">
                                    Ganti Foto
                                </div>
                            </label>

                            <input type="file" name="photo" id="photo"
                                accept="image/png, image/jpeg, image/jpg"
                                class="hidden"
                                onchange="previewCustomerPhoto(event)">

                            @error('photo')
                                <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="border-t border-slate-100 bg-white px-5 py-4 sm:px-6">
                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                        <button type="button"
                            class="h-11 rounded-2xl border border-slate-200 bg-white px-5 text-sm font-bold text-slate-700 transition hover:bg-slate-50 active:scale-[0.98]"
                            onclick="modalHandler(false)">
                            Cancel
                        </button>

                        <button type="submit"
                            class="h-11 rounded-2xl bg-[#12A4ED] px-6 text-sm font-bold text-white shadow-md shadow-[#12A4ED]/20 transition hover:-translate-y-0.5 hover:bg-[#0E8FD0] active:scale-[0.98]">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            modalHandler(true);
        });
    </script>
@endif

<script>
    function previewCustomerPhoto(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('photoPreview');
        const placeholder = document.getElementById('photoPlaceholder');

        if (!file) return;

        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        const maxSize = 10 * 1024 * 1024;

        if (!allowedTypes.includes(file.type)) {
            Swal.fire({
                icon: 'error',
                title: 'Format tidak didukung',
                text: 'Format foto harus JPG atau PNG.',
                confirmButtonColor: '#12A4ED'
            });

            event.target.value = '';
            return;
        }

        if (file.size > maxSize) {
            Swal.fire({
                icon: 'error',
                title: 'Ukuran foto terlalu besar',
                text: 'Ukuran foto maksimal 10 MB.',
                confirmButtonColor: '#12A4ED'
            });

            event.target.value = '';
            return;
        }

        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');
        placeholder.classList.add('hidden');
    }

    function toggleCustomerPassword() {
        const password = document.getElementById('password');
        const icon = document.getElementById('passwordIcon');

        if (!password || !icon) return;

        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.remove('fi-rr-eye');
            icon.classList.add('fi-rr-eye-crossed');
        } else {
            password.type = 'password';
            icon.classList.remove('fi-rr-eye-crossed');
            icon.classList.add('fi-rr-eye');
        }
    }
</script>