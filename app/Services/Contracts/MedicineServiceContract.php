<?php


namespace App\Services\Contracts;


use App\Http\Requests\Medicine\MedicineListRequest;
use App\Http\Requests\Medicine\MedicineStoreRequest;
use App\Models\Medicine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface MedicineServiceContract
{
    public function list(MedicineListRequest $request);

    public function show(Request $request, int $medicineId): ?Model;

    public function store(MedicineStoreRequest $request): ?Model;

    public function update(MedicineStoreRequest $request, Medicine $medicine): ?Model;

    public function delete(?Model $medicine): ?bool;

}
