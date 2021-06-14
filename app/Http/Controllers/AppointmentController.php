<?php

namespace App\Http\Controllers;

use App\Enums\UserTypes;
use App\Http\Requests\Appointment\AppointmentListRequest;
use App\Http\Requests\Appointment\AppointmentStoreRequest;
use App\Http\Resources\Appointment\AppointmentResource;
use App\Models\Appointment;
use App\Services\Contracts\AppointmentServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class AppointmentController extends Controller
{
        private AppointmentServiceContract $appointmentService;

        public function __construct(AppointmentServiceContract $appointmentService)
        {
            $this->appointmentService=$appointmentService;
        }


        public function index(AppointmentListRequest $request)
        {
           $this->authorize('index', Appointment::class);
           return view('appointment');
        }

        public function list(AppointmentListRequest $request)
        {
            $this->authorize('list', Appointment::class);
            return AppointmentResource::collection( $this->appointmentService->list($request))
                ->response()
                ->setStatusCode(200);
        }

        public function show(AppointmentListRequest $request, $appointment_id):JsonResponse
        {
            $this->authorize('show', Appointment::class);
            $appointment=$this->appointmentService->show($request,$appointment_id);


            return AppointmentResource::make($appointment)
                ->response()
                ->setStatusCode(200);
        }

        public function store(AppointmentStoreRequest $request)
        {
           $this->authorize('store', Appointment::class);
            //Gate::authorize('create', Appointment::class);
                $this->appointmentService->store($request);
                return Redirect::back();
        }

        public function update(AppointmentStoreRequest $request,  $appointment_id)
        {
            /** @var Appointment $appointment */
            $appointment=$this->appointmentService->show($request, $appointment_id);
            $this->authorize('update', $appointment );
            $this->appointmentService->update($request, $appointment);
            return Redirect::back();
        }

        public function delete(Request $request, $appointment_id)
        {
            /** @var Appointment $appointment */
            $appointment = $this->appointmentService->show($request, $appointment_id);
            $this->authorize('delete', Appointment::class);
            return $this->appointmentService->delete($appointment);
        }
}
