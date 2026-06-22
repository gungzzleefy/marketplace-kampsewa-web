<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Produk;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailPenggunaController extends Controller
{
    public function __construct()
    {
        $this->middleware('dev');
    }
    public function index($namalengkap)
{
    $name = $namalengkap;

    $user_baru_terdaftar = User::select('users.*')
        ->join('status_notifikasi_user', 'users.id', '=', 'status_notifikasi_user.id_user')
        ->where('users.type', 0)
        ->whereDate('users.created_at', Carbon::today())
        ->where('status_notifikasi_user.status', 'unread')
        ->orderByDesc('users.created_at')
        ->limit(10)
        ->get();

    $user = User::where('name', $namalengkap)
        ->where('type', 0)
        ->first();

    if (!$user) {
        return redirect()
            ->route('kelola-pengguna.index')
            ->with('error', 'Pengguna tidak ditemukan.');
    }

    $data = DB::table('users')
        ->leftJoin('produk', 'produk.id_user', '=', 'users.id')
        ->where('users.id', $user->id)
        ->where('users.type', 0)
        ->select(
            'users.id as user_id',
            'users.name',
            'users.email',
            'users.nomor_telephone',
            'users.created_at',
            'users.jenis_kelamin',
            'users.foto',
            'users.tanggal_lahir',
            'users.status',
            'users.background',
            DB::raw('COUNT(produk.id) as total_product')
        )
        ->groupBy(
            'users.id',
            'users.name',
            'users.email',
            'users.nomor_telephone',
            'users.created_at',
            'users.jenis_kelamin',
            'users.foto',
            'users.tanggal_lahir',
            'users.status',
            'users.background'
        )
        ->first();

    $produk_disewakan_limit2 = Produk::with('foto')
        ->leftJoin('variant_produk', 'produk.id', '=', 'variant_produk.id_produk')
        ->leftJoin('detail_variant_produk', 'variant_produk.id', '=', 'detail_variant_produk.id_variant_produk')
        ->select(
            'produk.id',
            'produk.nama',
            'produk.status',
            DB::raw('COALESCE(SUM(detail_variant_produk.stok), 0) as stok_produk')
        )
        ->where('produk.id_user', $user->id)
        ->groupBy('produk.id', 'produk.nama', 'produk.status')
        ->latest('produk.created_at')
        ->limit(5)
        ->get();

    $feedback_terbaru = Feedback::with([
        'messages' => function ($query) {
            $query->orderBy('created_at', 'asc')
                ->orderBy('id', 'asc');
        }
    ])
    ->where('id_user', $user->id)
    ->latest()
    ->limit(5)
    ->get();

$total_feedback = Feedback::where('id_user', $user->id)->count();

$feedback_dibalas = Feedback::where('id_user', $user->id)
    ->where(function ($query) {
        $query->where('status', 'Dibalas')
            ->orWhereHas('messages', function ($message) {
                $message->where('sender_type', 'admin');
            });
    })
    ->count();

$feedback_belum_dibalas = Feedback::where('id_user', $user->id)
    ->where(function ($query) {
        $query->where('status', 'Belum Dibalas')
            ->whereDoesntHave('messages', function ($message) {
                $message->where('sender_type', 'admin');
            });
    })
    ->count();

    return view('developers.detail-pengguna')->with([
        'title' => 'Detail Pengguna',
        'name' => $name,
        'user_baru_terdaftar' => $user_baru_terdaftar,
        'data' => $data,
        'produk_disewakan_limit2' => $produk_disewakan_limit2,
        'feedback_terbaru' => $feedback_terbaru,
        'total_feedback' => $total_feedback,
        'feedback_dibalas' => $feedback_dibalas,
        'feedback_belum_dibalas' => $feedback_belum_dibalas,
    ]);
}
    public function showProdukDisewakan($namalengkap, Request $request)
    {
        // Fetching new registered users with unread notifications
        $user_baru_terdaftar = User::select('users.*')
            ->join('status_notifikasi_user', 'users.id', '=', 'status_notifikasi_user.id_user')
            ->where('users.type', 0)
            ->whereDate('users.created_at', Carbon::today())
            ->where('status_notifikasi_user.status', 'unread')
            ->orderByDesc('users.created_at')
            ->limit(10)
            ->get();

        // Mengambil data pengguna berdasarkan nama lengkap
    $user = User::where('name', $namalengkap)->first();

    // Jika pengguna tidak ditemukan, kembalikan respon error atau alihkan ke halaman lain
    if (!$user) {
        return redirect()->back()->with('error', 'Pengguna tidak ditemukan');
    }

    $id_user = $user->id;

    // Mengambil kategori produk
    $get_kategori = Produk::select('kategori')
        ->distinct()
        ->pluck('kategori')
        ->toArray();

    // Menerapkan filter dan pencarian
    $filter_category = $request->input('filter_category', 'Semua Barang');
    $cari_barang = $request->input('cari_barang', '');

    $get_data_produk = Produk::with('foto')
        ->leftJoin('variant_produk', 'produk.id', '=', 'variant_produk.id_produk')
        ->leftJoin('detail_variant_produk', 'variant_produk.id', '=', 'detail_variant_produk.id_variant_produk')
        ->select(
            'produk.id as id_produk',
            'produk.id',
            'produk.nama',
            'produk.deskripsi',
            DB::raw('MIN(detail_variant_produk.harga_sewa) as harga_sewa_terkecil')
        )
        ->where('produk.id_user', $id_user)
        ->when($filter_category != 'Semua Barang', function ($query) use ($filter_category) {
            return $query->where('produk.kategori', $filter_category);
        })
        ->when($cari_barang, function ($query) use ($cari_barang) {
            return $query->where('produk.nama', 'like', "%{$cari_barang}%");
        })
        ->groupBy('produk.id', 'produk.nama', 'produk.deskripsi')
        ->get();

    // Mengembalikan view dengan data yang diperlukan
    return view('developers.detailpengguna-produkdisewakan')->with([
        'name' => $namalengkap,
        'title' => 'Produk Disewakan',
        'user_baru_terdaftar' => $user_baru_terdaftar,
        'get_kategori' => $get_kategori,
        'get_data_produk' => $get_data_produk,
        'filter_category' => $filter_category,
        'cari_barang' => $cari_barang,
    ]);
    }
    public function showDetailProdukDisewakan($namalengkap, $nama_produk)
    {
        $user_baru_terdaftar = User::select('users.*')
            ->join('status_notifikasi_user', 'users.id', '=', 'status_notifikasi_user.id_user')
            ->where('users.type', 0)
            ->whereDate('users.created_at', Carbon::today())
            ->where('status_notifikasi_user.status', 'unread')
            ->orderByDesc('users.created_at')->limit(10)
            ->get();

        $produk = Produk::with(['foto'])
            ->whereHas('user', function ($query) use ($namalengkap) {
                $query->where('name', $namalengkap);
            })
            ->where('nama', $nama_produk)
            ->firstOrFail();
            
        // Get stock and min price dynamically
        $stok_produk = DB::table('detail_variant_produk')
            ->join('variant_produk', 'detail_variant_produk.id_variant_produk', '=', 'variant_produk.id')
            ->where('variant_produk.id_produk', $produk->id)
            ->sum('stok');
            
        $harga_sewa_terkecil = DB::table('detail_variant_produk')
            ->join('variant_produk', 'detail_variant_produk.id_variant_produk', '=', 'variant_produk.id')
            ->where('variant_produk.id_produk', $produk->id)
            ->min('harga_sewa');

        return view('developers.detail-produk-disewakan', [
            'title' => 'Detail Produk Disewakan', 
            'name' => $namalengkap, 
            'user_baru_terdaftar' => $user_baru_terdaftar, 
            'nama_produk' => $nama_produk,
            'produk' => $produk,
            'stok_produk' => $stok_produk,
            'harga_sewa_terkecil' => $harga_sewa_terkecil
        ]);
    }
    public function showDetailProdukSedangDisewa($namalengkap, $nama_produk)
    {

        $user_baru_terdaftar = User::select('users.*')
            ->join('status_notifikasi_user', 'users.id', '=', 'status_notifikasi_user.id_user')
            ->where('users.type', 0)
            ->whereDate('users.created_at', Carbon::today())
            ->where('status_notifikasi_user.status', 'unread')
            ->orderByDesc('users.created_at')->limit(10)
            ->get();

        $produk = Produk::with(['foto'])
            ->whereHas('user', function ($query) use ($namalengkap) {
                $query->where('name', $namalengkap);
            })
            ->where('nama', $nama_produk)
            ->firstOrFail();

        // Get stock and min price dynamically
        $stok_produk = DB::table('detail_variant_produk')
            ->join('variant_produk', 'detail_variant_produk.id_variant_produk', '=', 'variant_produk.id')
            ->where('variant_produk.id_produk', $produk->id)
            ->sum('stok');

        return view('developers.detail-barang-sedangdisewa', [
            'title' => 'Detail Produk Sedang Disewa', 
            'name' => $namalengkap, 
            'nama_produk' => $nama_produk, 
            'user_baru_terdaftar' => $user_baru_terdaftar,
            'produk' => $produk,
            'stok_produk' => $stok_produk
        ]);
    }

    public function deleteSelectedProducts(Request $request)
    {
        $ids = $request->input('ids');
        Produk::whereIn('id', $ids)->delete();

        return back()->with('success', 'Produk terpilih telah dihapus.');
    }
}
