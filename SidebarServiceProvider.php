<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SidebarServiceProvider extends ServiceProvider
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
        View::composer('layouts.sidebar', function ($view) {
            if (Schema::hasTable('menus') && Menu::count() > 0) {
                $menus = Menu::with('children')->whereNull('parent_id')->orderBy('order')->get();
            } else {
                $menus = collect(config('sidebar'))->map(function ($item) {
                    $item['children'] = collect($item['children'] ?? [])->map(function ($child) {
                        return (object) $child;
                    });
                    return (object) $item;
                });
            }

            $view->with('menus', $menus);
        });

    }
}
