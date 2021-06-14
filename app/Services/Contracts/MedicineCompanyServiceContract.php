<?php


namespace App\Services\Contracts;


use App\Http\Requests\MedicineCompany\MedicineCompanyListRequest;
use App\Http\Requests\MedicineCompany\MedicineCompanyStoreRequest;
use App\Models\MedicineCompany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface MedicineCompanyServiceContract
{
    public function list(MedicineCompanyListRequest $request);

    public function show(Request $request, int $medicineCompanyId): ?Model;

    public function store(MedicineCompanyStoreRequest $request): ?Model;

    public function update(MedicineCompanyStoreRequest $request, MedicineCompany $medicineCompany): ?Model;

    public function delete(?Model $medicineCompany): ?bool;

}
