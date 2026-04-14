<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * @userPhoto($foto)
         *
         * Menghasilkan nilai src foto profil yang fleksibel:
         * - Jika $foto adalah URL eksternal (http/https) → digunakan langsung
         * - Jika $foto adalah nama file lokal → dibungkus asset() ke path profil
         * - Jika $foto null/kosong → fallback ke placeholder default
         *
         * Contoh pemakaian di Blade:
         *   <img src="@userPhoto($item->foto)" alt="">
         *   <img src="@userPhoto(session('foto'))" alt="">
         */
        Blade::directive('userPhoto', function (string $expression): string {
            return "<?php echo (function(\$foto) {
                if (empty(\$foto)) {
                    return asset('assets/image/customers/profile/man.png');
                }
                if (str_starts_with(\$foto, 'http://') || str_starts_with(\$foto, 'https://')) {
                    return e(\$foto);
                }
                return asset('assets/image/customers/profile/' . \$foto);
            })($expression); ?>";
        });
    }
}
