<?php

namespace App\Providers;

use Illuminate\Support\Facades\Crypt;
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
        $database = env('DB_DATABASE_ENCRYPTED');
        $username = env('DB_USERNAME_ENCRYPTED');
        $password = env('DB_PASSWORD_ENCRYPTED');

        // Verificar si las variables están configuradas antes de intentar desencriptar
        if ($database && $username && $password) {
            config([
                'database.connections.mysql.database' => Crypt::decryptString($database),
                'database.connections.mysql.username' => Crypt::decryptString($username),
                'database.connections.mysql.password' => Crypt::decryptString($password),
            ]);
        }
    }
}
