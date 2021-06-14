<?php


namespace App\Services\Contracts;

use App\Http\Requests\Doctor\DoctorListRequest;
use App\Http\Requests\Doctor\DoctorStoreRequest;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface DoctorServiceContract
{
    public function list(DoctorListRequest $request);

    public function show(Request $request, int $doctorId): ?Model;

    public function store(DoctorStoreRequest $request): ?Model;

    public function update(DoctorStoreRequest $request, Doctor $doctor): ?Model;

    public function delete(?Model $doctor): ?bool;

}
