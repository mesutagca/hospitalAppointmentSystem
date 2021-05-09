<?php

namespace App\Http\Controllers;

use App\Helper\Methods\HelperMethods;
use App\Models\MedicineCompany;
use App\Models\User;
use App\Repositories\Contracts\MedicineCompanyRepositoryContract;
use Illuminate\Http\Request;

class MedicineCompanyController extends Controller
{
    private MedicineCompanyRepositoryContract  $medicineCompanyRepository;

    public function __construct(MedicineCompanyRepositoryContract $medicineCompanyRepository)
    {
        $this->medicineCompanyRepository=$medicineCompanyRepository;
        //$this->middleware('subscribed')->except('store');
    }

    public function index()
    {
        return view('medCamp', ['medcompanies' => $this->medicineCompanyRepository->getAll()]);
    }

    public function list()
    {
        return $this->medicineCompanyRepository->getAll();
    }

    public function show($id)
    {
        return view('medCamp', ['medcompanies' =>$this->medicineCompanyRepository->getById($id)]);
    }

    public function store(Request $request)
    {
        if(auth()->user()->isAdmin()) {
            $data=HelperMethods::companyDataToModel($request);
            $this->medicineCompanyRepository->create($data);
            return view('medCamp', ['medcompanies' => $this->medicineCompanyRepository->getAll()]);
        }
        return view('medCamp', [
            'ERROR'=>'yetkiniz yok  Bunu blade te göstereedim ',
            'medcompanies' => $this->medicineCompanyRepository->getAll()
        ]);
    }

    public function update(Request $request,$id)
    {
        if(User::isAdmin()) {
            $data=HelperMethods::companyDataToModel($request);
            return view('medCamp', ['medcompanies' => $this->medicineCompanyRepository->getAll()]);
        }
        return view('medCamp', [
            'ERROR'=>'yetkiniz yok  Bunu blade te göstereedim ',
            'medcompanies' => $this->medicineCompanyRepository->getAll()
        ]);
    }

    public function delete($id)
    {
        if(User::isAdmin()) {
            $this->medicineCompanyRepository->delete($id);
        }
        return view('medCamp', [
            'ERROR'=>'yetkiniz yok  Bunu blade te göstereedim ',
            'medcompanies' => $this->medicineCompanyRepository->getAll()
        ]);
    }
}
