<?php

namespace App\Http\Controllers;

use App\Http\Requests\Treatment\TreatmentListRequest;
use App\Http\Requests\Treatment\TreatmentStoreRequest;
use App\Models\Appointment;
use App\Models\Folder;
use App\Models\Treatment;
use App\Services\Contracts\AppointmentServiceContract;
use App\Services\Contracts\TreatmentserviceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TreatmentController extends Controller
{
    private TreatmentserviceContract $treatmentService;
    private AppointmentServiceContract $appointmentService;

    public function __construct(TreatmentserviceContract $treatmentService,AppointmentServiceContract $appointmentService)
    {
        $this->treatmentService=$treatmentService;
        $this->appointmentService=$appointmentService;
    }

    public function treatPatient(TreatmentStoreRequest $request,$appointment_id)
    {

        /** @var Appointment $appointment */
        $appointment = $this->appointmentService->show($request, $appointment_id);
        $this->authorize('treatPatient', $appointment);
        /** @var Folder $folder */
        $folder=$appointment->folder();

        if($appointment->folder->id>0){
           $this->treatmentService->updateTreatPatient($request, $folder);
        }
        $this->treatmentService->treatPatient($request,$folder );
        return Redirect::back();
    }

    public function downloadRecipeMedicines(TreatmentListRequest $request, $treatment_id,$recipe_id)
    {
        /** @var Treatment $treatment */
        $treatment = $this->treatmentService->show($request, $treatment_id);
        $this->authorize('downloadRecipeMedicines', $treatment);
        $this->treatmentService->downloadRecipeMedicines($request,$treatment,$recipe_id);
    }

    public function deleteRecipeMedicines(Request $request, $treatment_id,$recipe_id)
    {
        /** @var Treatment $treatment */
        $treatment= $this->treatmentService->show($request,$treatment_id);
        $this->authorize('deleteRecipeMedicines', $treatment);
        $this->treatmentService->deleteRecipeMedicines($request,$treatment,$recipe_id);
    }
}
