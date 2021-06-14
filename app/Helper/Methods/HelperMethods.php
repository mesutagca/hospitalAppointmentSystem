<?php


namespace App\Helper\Methods;

use App\Enums\MenuItems;
use App\Enums\UserTypes;
use App\Models\MedicineCompany;

class HelperMethods
{
    public static function CompanyIdToName($data)
    {
        foreach ($data as $medicine) {
            $company_name = MedicineCompany::find($medicine->medicine_company_id)->name;
            $medicine->medicine_company_id = $company_name;
        }
        return $data;
    }

    public static function getMenuItems(): array
    {
        $returnArray = [];
        $returnArray[] = self::prepareMenuItem(MenuItems::DASHBOARD);

        if (Auth()->User()->type == UserTypes::ADMIN) {
            $returnArray[] = self::prepareMenuItem(MenuItems::MEDICINE_COMPANY);
            $returnArray[] = self::prepareMenuItem(MenuItems::MEDICINE);
            $returnArray[] = self::prepareMenuItem(MenuItems::DIAGNOSE);
            $returnArray[] = self::prepareMenuItem(MenuItems::BRANCH);
        }
        if (Auth()->User()->type == UserTypes::DOCTOR) {

            $returnArray[] = self::prepareMenuItem(MenuItems::APPOINTMENT);
        }
        if (Auth()->User()->type == UserTypes::PATIENT) {

            $returnArray[] = self::prepareMenuItem(MenuItems::APPOINTMENT);
        }
        return $returnArray;
    }

    public static function prepareMenuItem(string $menu): array
    {
        return [
            "title" => $menu,
            "url" => route($menu . ".index"),
            "isActive" => request()->routeIs($menu . ".index"),
        ];
    }

}
