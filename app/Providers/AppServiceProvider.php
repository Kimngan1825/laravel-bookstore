<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
/* Bước 1: Thêm dòng này vào đầu file */
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Bước 2: Thêm dòng này vào hàm boot */
        Schema::defaultStringLength(191);
    }
}