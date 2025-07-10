<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use App\Models\Setting; 

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
        Config::set('mail.mailers.smtp.host', Setting::getValue('MAIL_HOST', config('mail.mailers.smtp.host')));
        Config::set('mail.mailers.smtp.port', Setting::getValue('MAIL_PORT', config('mail.mailers.smtp.port')));
        Config::set('mail.mailers.smtp.username', Setting::getValue('MAIL_USERNAME', config('mail.mailers.smtp.username')));
        Config::set('mail.mailers.smtp.password', Setting::getValue('MAIL_PASSWORD', config('mail.mailers.smtp.password')));
        Config::set('mail.mailers.smtp.encryption', Setting::getValue('MAIL_ENCRYPTION', config('mail.mailers.smtp.encryption')));
        Config::set('mail.default', Setting::getValue('MAIL_MAILER', config('mail.default')));
        Config::set('mail.from.address', Setting::getValue('MAIL_FROM_ADDRESS', config('mail.from.address')));
        Config::set('mail.from.name', Setting::getValue('MAIL_FROM_NAME', config('mail.from.name')));
    }
}
