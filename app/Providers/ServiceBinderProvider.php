<?php


namespace App\Providers;



use App\Services\BranchService;
use App\Services\Contracts\BranchServiceContract;
use Illuminate\Support\ServiceProvider;

class ServiceBinderProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(BranchServiceContract::class,BranchService::class);

         }

}
