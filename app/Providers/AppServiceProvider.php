<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Comentario;
use App\Policies\ComentarioPolicy;
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
    
    protected $policies = [
        Comentario::class => ComentarioPolicy::class,
    ];

     public function boot(): void
    {
        $this->registerPolicies();
    }
}
