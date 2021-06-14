<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appointment\AppointmentListRequest;

use App\Models\Appointment;
use App\Models\PatientDocument;
use App\Policies\PatientDocumentPolicy;
use App\Services\Contracts\AppointmentServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PatientDocumentController extends Controller
{
    private AppointmentServiceContract $appointmentService;

    public function __construct(AppointmentServiceContract $appointmentService)
    {
        $this->appointmentService=$appointmentService;
    }

    public function download(AppointmentListRequest $request, $appointment_id, $patient_path)
    {
        /** @var Appointment $appointment */
        $appointment=$this->appointmentService->show($request,$appointment_id);
        $path='/PatientDocuments/'.$appointment->patient_id.'/'.$patient_path;
        //Gate::authorize('documentDownload', PatientDocument::class);
        return Storage::download($path);
    }

    public function delete(Request $request, $appointment_id,$patient_path)
    {
        /** @var Appointment $appointment */
        $appointment = $this->appointmentService->show($request, $appointment_id);
        Gate::authorize('documentDelete', $appointment);
        $this->appointmentService->deletePatientDocument($appointment,$patient_path);

    }
}
