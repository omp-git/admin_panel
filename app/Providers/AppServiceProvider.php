<?php

namespace App\Providers;

use App\FormFields\IconFormField;
use App\FormFields\LinkFormField;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Facades\Voyager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Voyager::addFormField(LinkFormField::class);
        Voyager::addFormField(IconFormField::class);


        Voyager::useModel('User', \App\Admin::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('VoyagerAuth', function () {
            return Auth::guard('admin');
        });
    }
}
