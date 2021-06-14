<?php

namespace App\Providers;

use App\Repositories\AppointmentRepository;
use App\Repositories\BranchRepository;
use App\Repositories\Contracts\AppointmentRepositoryContract;
use App\Repositories\Contracts\BranchRepositoryContract;
use App\Repositories\Contracts\DiagnoseRepositoryContract;
use App\Repositories\Contracts\DoctorRepositoryContract;
use App\Repositories\Contracts\MedicineCompanyRepositoryContract;
use App\Repositories\Contracts\MedicineRepositoryContract;
use App\Repositories\Contracts\PatientrepositoryContract;
use App\Repositories\Contracts\TreatmentRepositoryContract;
use App\Repositories\DiagnoseRepository;
use App\Repositories\DoctorRepository;
use App\Repositories\MedicineCompanyRepository;
use App\Repositories\MedicineRepository;
use App\Repositories\PatientRepository;
use App\Repositories\TreatmentRepository;
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
        $this->app->bind(AppointmentRepositoryContract::class,AppointmentRepository::class);
        $this->app->bind(DoctorRepositoryContract::class,DoctorRepository::class);
        $this->app->bind(PatientrepositoryContract::class,PatientRepository::class);
        $this->app->bind(TreatmentRepositoryContract::class,TreatmentRepository::class);
    }
}
