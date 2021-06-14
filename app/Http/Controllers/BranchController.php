<?php

namespace App\Http\Controllers;

use App\Http\Requests\Branch\BranchListRequest;
use App\Http\Requests\Branch\BranchStoreRequest;
use App\Http\Resources\Branch\BranchResource;
use App\Models\Branch;
use App\Services\Contracts\BranchServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

class BranchController extends Controller
{
    private BranchServiceContract $branchService;

    public function __construct(BranchServiceContract $branchService)
    {
        $this->branchService=$branchService;
    }


    public function index(BranchListRequest $request)
    {
       $this->authorize('index', Branch::class);
       return view('branch');
    }

    public function list(BranchListRequest $request)
    {
        $this->authorize('list', Branch::class);
        return BranchResource::collection( $this->branchService->list($request))
            ->response()
            ->setStatusCode(200);
    }

    public function show(BranchListRequest $request, $branch_id):JsonResponse
    {
        $this->authorize('show', Branch::class);
        $branch=$this->branchService->show($request,$branch_id);
        return BranchResource::make($branch)
            ->response()
            ->setStatusCode(200);
    }

    public function store(BranchStoreRequest $request)
    {
       $this->authorize('store', Branch::class);
        //Gate::authorize('create', Branch::class);
            $this->branchService->store($request);
            return Redirect::back();
    }

    public function update(BranchStoreRequest $request,  $branch_id)
    {
        /** @var Branch $branch */
        $branch=$this->branchService->show($request, $branch_id);
        $this->authorize('update', $branch );
        return $this->branchService->update($request, $branch);
    }

    public function delete(Request $request, $branch_id)
    {
        /** @var Branch $branch */
        $branch = $this->branchService->show($request, $branch_id);
        $this->authorize('delete', Branch::class);
        return $this->branchService->delete($branch);
    }
}
