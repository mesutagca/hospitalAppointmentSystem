<?php

namespace App\Http\Controllers;

use App\Http\Requests\Diagnose\DiagnoseListRequest;
use App\Http\Requests\Diagnose\DiagnoseStoreRequest;
use App\Http\Resources\Diagnose\DiagnoseResource;
use App\Models\Diagnose;
use App\Repositories\Contracts\DiagnoseRepositoryContract;
use App\Services\Contracts\DiagnoseServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Redirect;

class DiagnoseController extends Controller
{
    private DiagnoseServiceContract $diagnoseService;

    public function __construct(DiagnoseServiceContract $diagnoseService)
    {
        $this->diagnoseService=$diagnoseService;
    }

    public function index(DiagnoseListRequest $request)
    {
        $this->authorize('index', Diagnose::class);
        return view('diagnose');
    }

    public function list(DiagnoseListRequest $request)
    {
        $this->authorize('list', Diagnose::class);
        return DiagnoseResource::collection( $this->diagnoseService->list($request))
            ->response()
            ->setStatusCode(200);
    }

    public function show(DiagnoseListRequest $request, $diagnose_id):JsonResponse
    {
    $this->authorize('show',Diagnose::class);
    $diagnose=$this->diagnoseService->show($request, $diagnose_id);
    return DiagnoseResource::make($diagnose)
        ->response()
        ->setStatusCode(200);
    }

    public function store(DiagnoseStoreRequest $request)
    {
        $this->authorize('store',Diagnose::class);
        $this->diagnoseService->store($request);
        return Redirect::back();
    }

    public function update(DiagnoseStoreRequest $request, $diagnose_id)
    {
        /** @var Diagnose $diagnose */
        $diagnose=$this->diagnoseService->show($request, $diagnose_id);
        $this->authorize('update', $diagnose );
        return $this->diagnoseService->update($request, $diagnose);
    }

    public function delete(Request $request, $diagnose_id)
    {
        /** @var Diagnose $diagnose */
        $diagnose = $this->diagnoseService->show($request, $diagnose_id);
        $this->authorize('delete', $diagnose);
        return $this->diagnoseService->delete($diagnose);
    }
}
