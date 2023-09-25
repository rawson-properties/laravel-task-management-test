<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * This method is used to register any services or bindings
     * that your application needs. In this case, we are binding
     * the User model to a singleton instance representing
     * the currently authenticated user.
     */
    public function register(): void
    {
        // Bind the User model to a singleton instance
        $this->app->singleton(User::class, function () {
            // Return the currently authenticated user
            return User::find(Auth::id());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * This method is used to perform any additional bootstrapping
     * or setup for your application services. In this case,
     * we don't have any specific tasks to perform during
     * bootstrapping, so it's left empty.
     */
    public function boot(): void
    {
        //
    }
}
