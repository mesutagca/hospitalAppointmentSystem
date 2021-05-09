<?php

namespace App\Http\Controllers;


use App\Http\Requests\Branch\BranchListRequest;
use App\Http\Requests\Branch\BranchStoreRequest;
use App\Models\User;
use App\Repositories\Contracts\BranchRepositoryContract;
use App\Services\Contracts\BranchServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BranchController extends Controller
{
    private BranchRepositoryContract $branchRepository;

    public function __construct(BranchRepositoryContract $branchRepository)
    {
        $this->branchRepository=$branchRepository;
    }

    public function index(BranchListRequest $request)
    { //dd(Auth::user());
        return view('branch',['branches'=>$this->branchRepository->getAll($request)]);
    }

    public function list()
    {
        return $this->branchService->getAll();
    }

    public function show($branch_id)
    {//toArray()
        return view('branch',['branches'=>$this->branchService->show($branch_id)]);
    }

    public function store(BranchStoreRequest $request)
    {

            $this->branchService->store($request);
            return Redirect::back();
    }

    public function update($branch_id,Request $request)
    {

        if (User::isAdmin()) {
            $data=['name'=>$request->name];
            $this->branchService->update($branch_id,$data);
            return view('branch',['branches'=>$this->branchService->getAll()]);
        }
        return view('branch', [
            'ERROR'=>'yetkiniz yok  Bunu blade te göstereedim ',
            'branches'=>$this->branchService->getAll()
        ]);
    }

    public function delete($branch_id)
    {
        if (User::isAdmin()) {
            $this->branchService->delete($branch_id);
            return view('branch',['branches'=>$this->branchService->getAll()]);
        }
        return view('branch', [
            'ERROR'=>'yetkiniz yok  Bunu blade te göstereedim ',
            'branches'=>$this->branchService->getAll()
        ]);
    }
}
