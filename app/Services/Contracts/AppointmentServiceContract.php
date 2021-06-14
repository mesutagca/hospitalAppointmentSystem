<?php


namespace App\Services\Contracts;

use App\Http\Requests\Appointment\AppointmentListRequest;
use App\Http\Requests\Appointment\AppointmentStoreRequest;


use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface AppointmentServiceContract
{
    public function list(AppointmentListRequest $request);

    public function show(Request $request, int $appointmentId): ?Model;

    public function store(AppointmentStoreRequest $request): ?Model;

    public function update(AppointmentStoreRequest $request, Appointment $appointment): ?Model;

    public function delete(?Model $appointment): ?bool;

    public function deletePatientDocument(?Model $appointment,$patient_path): ?bool;


}
