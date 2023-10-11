<?php

namespace App\Providers;

use App\Data\Car;
use App\Data\Brand;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

// menagkifkan deferrable, untuk mengatur service mana saja yang akan di load (jika memang dibutuhkan)
// tambahkan : implements DeferrableProvider
// dan buat method provides()
class CarServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        HelloService::class => HelloServiceIndonesia::class
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // jika tanda function deferred, service ini tidak akan dieksekusi
        // coba jalankan aplikasi ini versi web, lalu untuk mencobanya
        // comment provides() dan hapus implements DeferrableProvider lalu php artisan clear-compled dan reload halaman
        // uncomment provides() dan tambahkan implements DeferrableProvider lalu php artisan clear-compled dan reload halaman
//        var_dump("Service Provider");


        // misal di service provider ini kita akan meregistrasikan Car dan Brand
        $this->app->singleton(Brand::class, function($app){
            return new Brand();
        });

        $this->app->singleton(Car::class, function($app){
           return new Car($app->make(Brand::class));
        });

        // Bindings dan Singletons Properties, digunakan untuk kasus yang sederhana
        // Contoh kode di property $singletons
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function provides()
    {
        // kasih tau service mana saja yang dibutuhkan
        return [HelloService::class, Brand::class, Car::class];

        // hapus bootstrap/cache/service.php dengan command
        // php artisan clear-compled
        // tujuannya untuk menghapus compiled class termasuk serive provider
        // sehingga service provider tidak selalu dipanggil ketika ada fitur
        // yang tidak membutuhkan service provider tersebut
    }
}
