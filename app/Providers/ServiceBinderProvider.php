<?php


namespace App\Providers;



use App\Services\AppointmentService;
use App\Services\BranchService;
use App\Services\Contracts\AppointmentServiceContract;
use App\Services\Contracts\BranchServiceContract;
use App\Services\Contracts\DiagnoseServiceContract;
use App\Services\Contracts\DoctorServiceContract;
use App\Services\Contracts\MedicineCompanyServiceContract;
use App\Services\Contracts\MedicineServiceContract;
use App\Services\Contracts\TreatmentserviceContract;
use App\Services\DiagnoseService;
use App\Services\DoctorService;
use App\Services\MedicineCompanyService;
use App\Services\MedicineService;
use App\Services\TreatmentService;
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
        $this->app->bind(DiagnoseServiceContract::class,DiagnoseService::class);
        $this->app->bind(MedicineServiceContract::class,MedicineService::class);
        $this->app->bind(MedicineCompanyServiceContract::class,MedicineCompanyService::class);
        $this->app->bind(AppointmentServiceContract::class,AppointmentService::class);
        $this->app->bind(DoctorServiceContract::class,DoctorService::class);
        $this->app->bind(TreatmentserviceContract::class,TreatmentService::class);


         }

}
