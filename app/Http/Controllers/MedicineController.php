<?php

namespace App\Http\Controllers;

use App\Helper\Methods\HelperMethods;
use App\Models\Medicine;
use App\Models\MedicineCompany;
use App\Models\User;
use App\Repositories\Contracts\MedicineCompanyRepositoryContract;
use App\Repositories\Contracts\MedicineRepositoryContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicineController extends Controller
{
    private MedicineRepositoryContract $medicineRepository;
    private MedicineCompanyRepositoryContract  $medicineCompanyRepository;


    public function __construct(MedicineRepositoryContract $medicineRepository,MedicineCompanyRepositoryContract $medicineCompanyRepository)
    {
        $this->medicineRepository=$medicineRepository;
        $this->medicineCompanyRepository=$medicineCompanyRepository;
    }

    public function index()
    {
        $data=$this->medicineRepository->getAll();
        return view('medicine',['medicines'=>HelperMethods::CompanyIdToName($data)]);
    }

    public function list()
    {
        return $this->medicineRepository->getAll();
    }

    public function show($medicine_id)
    {
        $data=$this->medicineRepository->getById($medicine_id);
        return view('medicine',['medicines'=>HelperMethods::CompanyIdToName($data)]);
    }

    public function store(Request $request)
    {
        if (User::isAdmin()) {
            $data=HelperMethods::medicineDataToModel($request);
            $this->medicineRepository->create($data);
        return view('medicine', ['medicines' => $this->medicineRepository->getAll()]);
    }
        return view('medicine', [
            'ERROR'=>'yetkiniz yok  Bunu blade te göstereedim ',
            'medicines' => $this->medicineRepository->getAll()
        ]);
    }

    public function update($medicine_id,Request $request)
    {
        if (User::isAdmin()) {
            $data=HelperMethods::medicineDataToModel($request);
            $this->medicineRepository->update($medicine_id,$data);
            return view('medicine', ['medicines' => $this->medicineRepository->getAll()]);
        }
        return view('medicine', [
            'ERROR'=>'yetkiniz yok  Bunu blade te göstereedim ',
            'medicines' => $this->medicineRepository->getAll()
        ]);
    }

    public function delete($medicine_id)
    {
        if (User::isAdmin()) {
            $this->medicineRepository->delete($medicine_id);
            return view('medicine', ['medicines' => $this->medicineRepository->getAll()]);
        }
        return view('medicine', [
            'ERROR'=>'yetkiniz yok  Bunu blade te göstereedim ',
            'medicines' => $this->medicineRepository->getAll()
        ]);
    }

}
