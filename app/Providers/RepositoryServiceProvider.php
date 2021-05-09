<?php

namespace App\Providers;

use App\Repositories\BranchRepository;
use App\Repositories\Contracts\BranchRepositoryContract;
use App\Repositories\Contracts\DiagnoseRepositoryContract;
use App\Repositories\Contracts\MedicineCompanyRepositoryContract;
use App\Repositories\Contracts\MedicineRepositoryContract;
use App\Repositories\DiagnoseRepository;
use App\Repositories\MedicineCompanyRepository;
use App\Repositories\MedicineRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(MedicineCompanyRepositoryContract::class,MedicineCompanyRepository::class);
        $this->app->bind(MedicineRepositoryContract::class,MedicineRepository::class);
        $this->app->bind(DiagnoseRepositoryContract::class,DiagnoseRepository::class);
        $this->app->bind(BranchRepositoryContract::class,BranchRepository::class);
    }
}
