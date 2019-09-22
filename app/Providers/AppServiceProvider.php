<?php

namespace App\Providers;

use App\Composers\AlertComposer;
use App\Composers\AppNavComposer;
use App\Composers\KioskComposer;
use App\Composers\LayoutComposer;
use App\Markdown\Converter;
use App\Markdown\LeagueConverter;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\TelescopeServiceProvider;
use League\CommonMark\CommonMarkConverter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        view()->composer('layouts._navigation.application', AppNavComposer::class);
        view()->composer('*', LayoutComposer::class);
        view()->composer('kiosk', KioskComposer::class);
        view()->composer('notifications.kiosk._partials.sidenav', AlertComposer::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }

        $this->app->bind(Converter::class, function () {
            return new LeagueConverter(new CommonMarkConverter(['html_input' => 'escape']));
        });
    }
}
