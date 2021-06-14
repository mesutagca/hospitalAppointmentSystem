<?php

namespace App\Http\Controllers;


use App\Http\Requests\Doctor\DoctorListRequest;
use App\Http\Requests\Doctor\DoctorStoreRequest;
use App\Http\Resources\Doctor\DoctorResource;
use App\Models\Doctor;
use App\Services\Contracts\DoctorServiceContract;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DoctorController extends Controller
{
    private DoctorServiceContract $doctorService;

    public function __construct(DoctorServiceContract $doctorService)
    {
        $this->doctorService=$doctorService;
    }


    public function index(DoctorListRequest $request)
    {
        $this->authorize('index', Doctor::class);
        return view('doctor');
    }

    public function list(DoctorListRequest $request)
    {
        $this->authorize('list', Doctor::class);
        return DoctorResource::collection( $this->doctorService->list($request))
            ->response()
            ->setStatusCode(200);
    }

    public function show(DoctorListRequest $request, $doctor_id):JsonResponse
    {
        $this->authorize('show', Doctor::class);
        $doctor=$this->doctorService->show($request,$doctor_id);
        return DoctorResource::make($doctor)
            ->response()
            ->setStatusCode(200);
    }

    public function store(DoctorStoreRequest $request)
    {
        $this->authorize('store', Doctor::class);
        //Gate::authorize('create', Doctor::class);
        $this->doctorService->store($request);
        return Redirect::back();
    }

    public function update(DoctorStoreRequest $request,  $doctor_id)
    {
        /** @var Doctor $doctor */
        $doctor=$this->doctorService->show($request, $doctor_id);
        $this->authorize('update', $doctor );
        return $this->doctorService->update($request, $doctor);
    }

    public function delete(Request $request, $doctor_id)
    {
        /** @var Doctor $doctor */
        $doctor = $this->doctorService->show($request, $doctor_id);
        $this->authorize('delete', Doctor::class);
        return $this->doctorService->delete($doctor);
    }
}
