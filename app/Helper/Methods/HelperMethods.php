<?php


namespace App\Helper\Methods;

use App\Models\Medicine;
use App\Models\MedicineCompany;
use Illuminate\Http\Request;

class HelperMethods
{
    public static function CompanyIdToName($data)
    {
        foreach ($data as $medicine)
        {
            $company_name=MedicineCompany::find($medicine->medicine_company_id)->name;
            $medicine->medicine_company_id=$company_name;
        }
        return $data;
    }

    public static function medicineDataToModel(Request $request)
    {
        $data = [
            'name' => $request->name,
            'medicine_company_id' => $request->medicine_company_id,
            'active_ingredient' => $request->active_ingredient,
            'barcode' => $request->barcode,
        ];
        return $data;
    }

    public static function companyDataToModel(Request $request)
    {
        $data = [
            'name' => $request->name,
            'address' => $request->address,
        ];
        return $data;
    }

}
