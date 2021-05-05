<?php

namespace App\Http\Controllers;

use App\Models\MedicineCompany;
use App\Models\User;
use Illuminate\Http\Request;

class MedicineCompanyController extends Controller
{
    public function index()
    {
        return view('medCamp', ['medcompanies' => MedicineCompany::all()]);
    }

    public function list()
    {
        return MedicineCompany::all();
    }

    public function show($id)
    {
        $medCompany=MedicineCompany::find($id);
        echo $medCompany->name.'<br>'.$medCompany->address;
    }

    public function store(Request $request)
    {
        if(User::isAdmin()) {
            $newCompany = MedicineCompany::create([
                'name' => $request->name,
                'address' => $request->address
            ]);
        }
            echo 'yetkiniz yok yinede çıkmadı';
            sleep(1);
            return redirect()->route('dashboard');
    }

    public function update(Request $request,$id)
    {
        MedicineCompany::where('id', $id)
            ->update(
                [
                    'name' => $request->name,
                    'address'=>$request->address,
                ]);
    }





}
