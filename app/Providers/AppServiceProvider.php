<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
    public function boot()
    {
        View::composer('admin.layouts.sidebar', function ($view) {
            $menus = collect();

            if (Auth::check()) {
                $user = Auth::user();
                $menus = $user->roles()
                    ->with('menus')
                    ->get()
                    ->pluck('menus')
                    ->flatten()
                    ->unique('id')
                    ->sortBy('order');
            }

            $view->with('menus', $menus);
        });

    }
}
