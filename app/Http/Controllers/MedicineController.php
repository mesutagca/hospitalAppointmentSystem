<?php

namespace App\Http\Controllers;

use App\Helper\Methods\HelperMethods;
use App\Http\Requests\Medicine\MedicineListRequest;
use App\Http\Requests\Medicine\MedicineStoreRequest;
use App\Http\Resources\Medicine\MedicineResource;
use App\Models\Medicine;
use App\Models\MedicineCompany;
use App\Models\User;
use App\Repositories\Contracts\MedicineCompanyRepositoryContract;
use App\Repositories\Contracts\MedicineRepositoryContract;
use App\Services\Contracts\MedicineServiceContract;
use Illuminate\Auth\Access\Gate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MedicineController extends Controller
{
    private MedicineServiceContract $medicineService;



    public function __construct(MedicineServiceContract $medicineService)
    {
        $this->medicineService=$medicineService;

    }

    public function index(MedicineListRequest $request)
    {
        $this->authorize('index', Medicine::class);
         return view('medicine');
    }

    public function list(MedicineListRequest $request)
    {
        $this->authorize('list', Medicine::class);
        return MedicineResource::collection($this->medicineService->list($request))
            ->response()
            ->setStatusCode(200);
    }

    public function show(MedicineListRequest $request, $medicine_id):JsonResponse
    {
        $this->authorize('show',Medicine::class);
        $medicine=$this->medicineService->show($request, $medicine_id);
        return MedicineResource::make($medicine)
            ->response()
            ->setStatusCode(200);
    }

    public function store(MedicineStoreRequest $request)
    {
        $this->authorize('store', Medicine::class);
        $this->medicineService->store($request);
        return Redirect::back();
    }


    public function update(MedicineStoreRequest $request, $medicine_id)
    {
        /** @var Medicine $medicine  */
        $medicine=$this->medicineService->show($request, $medicine_id);
        $this->authorize('update',$medicine);
        return $this->medicineService->update($request, $medicine);
    }

    public function delete(Request $request, $medicine_id)
    {
        /** @var Medicine $medicine */
        $medicine = $this->medicineService->show($request, $medicine_id);
        $this->authorize('delete', $medicine);
        return $this->medicineService->delete($medicine);
    }

}
