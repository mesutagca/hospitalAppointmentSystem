<?php

namespace App\Http\Controllers;

use App\Helper\Methods\HelperMethods;
use App\Http\Requests\Medicine\MedicineListRequest;
use App\Http\Requests\MedicineCompany\MedicineCompanyListRequest;
use App\Http\Requests\MedicineCompany\MedicineCompanyStoreRequest;
use App\Http\Resources\MedicineCompany\MedicineCompanyResource;
use App\Models\MedicineCompany;
use App\Models\User;
use App\Repositories\Contracts\MedicineCompanyRepositoryContract;
use App\Services\Contracts\MedicineCompanyServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MedicineCompanyController extends Controller
{
    private MedicineCompanyServiceContract  $medicineCompanyService;

    public function __construct(MedicineCompanyServiceContract $medicineCompanyService)
    {
        $this->medicineCompanyService=$medicineCompanyService;
        //$this->middleware('subscribed')->except('store');
    }
    public function index(MedicineCompanyListRequest $request)
    {
        $this->authorize('index', MedicineCompany::class);
        return view('medCamp');
    }

    public function list(MedicineCompanyListRequest $request)
    {
        $this->authorize('list', MedicineCompany::class);
        return MedicineCompanyResource::collection( $this->medicineCompanyService->list($request))
            ->response()
            ->setStatusCode(200);
    }
    public function show(MedicineCompanyListRequest $request, $medicineCompany_id):JsonResponse
    {
        $this->authorize('show', MedicineCompany::class);
        $branch=$this->medicineCompanyService->show($request,$medicineCompany_id);
        return MedicineCompanyResource::make($branch)
            ->response()
            ->setStatusCode(200);
    }

    public function store(MedicineCompanyStoreRequest $request)
    {
        $this->authorize('store', MedicineCompany::class);
        //Gate::authorize('create', MedicineCompany::class);
        $this->medicineCompanyService->store($request);
        return Redirect::back();
    }

    public function update(MedicineCompanyStoreRequest $request,  $medicineCompany_id)
    {
        /** @var MedicineCompany $medicineCompany */
        $medicineCompany=$this->medicineCompanyService->show($request, $medicineCompany_id);
        $this->authorize('update', $medicineCompany );
        return $this->medicineCompanyService->update($request, $medicineCompany);
    }

    public function delete(Request $request, $medicineCompany_id)
    {
        /** @var MedicineCompany $medicineCompany */
        $medicineCompany = $this->medicineCompanyService->show($request, $medicineCompany_id);
        $this->authorize('delete', $medicineCompany);
        return $this->medicineCompanyService->delete($medicineCompany);
    }
}
