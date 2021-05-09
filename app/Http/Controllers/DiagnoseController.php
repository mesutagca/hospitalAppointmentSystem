<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Repositories\Contracts\DiagnoseRepositoryContract;
use Illuminate\Http\Request;

class DiagnoseController extends Controller
{
    private DiagnoseRepositoryContract $diagnoseRepository;

    public function __construct(DiagnoseRepositoryContract $diagnoseRepository)
    {
        $this->diagnoseRepository=$diagnoseRepository;
    }

    public function index()
    {
        return view('diagnose',['diagnoses'=>$this->diagnoseRepository->getAll()]);
    }

    public function list()
    {
        return $this->diagnoseRepository->getAll();
    }

    public function show($diagnose_id)
    {
        return view('diagnose',['diagnoses'=>$this->diagnoseRepository->getById($diagnose_id)]);
    }

    public function store(Request $request)
    {
        if (true) {
            $data=['name'=>$request->name];
            $this->diagnoseRepository->create($data);
            return view('diagnose',['diagnoses'=>$this->diagnoseRepository->getAll()]);
        }
        return view('diagnose', [
            'ERROR'=>'yetkiniz yok  Bunu blade te göstereedim ',
            'diagnoses' => $this->diagnoseRepository->getAll()
        ]);
    }

    public function update($diagnose_id,Request $request)
    {
        if (User::isAdmin()) {
            $data=['name'=>$request->name];
            $this->diagnoseRepository->update($diagnose_id,$data);
            return view('diagnose',['diagnoses'=>$this->diagnoseRepository->getAll()]);
        }
        return view('diagnose', [
            'ERROR'=>'yetkiniz yok  Bunu blade te göstereedim ',
            'diagnoses' => $this->diagnoseRepository->getAll()
        ]);
    }

    public function delete($diagnose_id)
    {
        if (User::isAdmin()) {
            $this->diagnoseRepository->delete($diagnose_id);
            return view('diagnose',['diagnoses'=>$this->diagnoseRepository->getAll()]);
        }
        return view('diagnose', [
            'ERROR'=>'yetkiniz yok  Bunu blade te göstereedim ',
            'diagnoses' => $this->diagnoseRepository->getAll()
        ]);
    }
}
