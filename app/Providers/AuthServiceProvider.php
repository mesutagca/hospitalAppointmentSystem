<?php

namespace App\Providers;

use App\Auth\Guards\CustomGuard;
use App\Models\Branch;
use App\Policies\BranchPolicy;
use App\Services\AuthenticationService;
use App\Services\Contracts\AuthenticationServiceContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
      Branch::class => BranchPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Auth::extend('custom', function () {
            return new CustomGuard();
        });

        $this->registerPolicies();
    }
}
