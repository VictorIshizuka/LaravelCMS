<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Page;
use App\Models\Setting;

class PageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //menus
        $frontMenu = [
            '/' => 'home'
        ];

        $pages = Page::all();
        foreach ($pages as $page) {
            $frontMenu[$page->slug] = $page->title;
        }

        View::share('front_menu', $frontMenu);

        //configuracoes
        $config = [];
        $settings = Setting::all();
        foreach ($settings as $setting) {
            $config[$setting->name] = $setting->content;
        }

        View::share('config', $config);
    }
}
