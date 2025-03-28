<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
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
    Validator::replacer('after_or_equal', function ($message, $attribute, $rule, $parameters) {
        // Si el parámetro es "tomorrow", lo cambiamos por "mañana"
        if (isset($parameters[0]) && $parameters[0] === 'tomorrow') {
            $parameters[0] = 'mañana';
        }
        return str_replace(':date', $parameters[0], $message);
    });
}
}
