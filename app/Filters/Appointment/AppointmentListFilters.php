<?php


namespace App\Filters\Appointment;


use App\Enums\UserTypes;
use App\Filters\BaseFilter\QueryFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AppointmentListFilters extends QueryFilters
{
    public function filterByAppointmentId($id): Builder
    {
        return $this->builder->where('appointments.id', 'LIKE', $id)
            ->orwhere('appointments.doctor_id', 'LIKE', $id)
            ->orwhere('appointments.patient_id', 'LIKE', $id);
    }

    public function filterBySearch($filter): Builder
    {
        return $this->builder->where(function (Builder $query) use ($filter) {
            $query->where('appointments.appointment_time', 'LIKE', '%' . $filter . '%');
        });
    }

    /**
     * @return Builder|null
     */
    protected function mandatoryFilters(): ?Builder
    {
        if (Auth::user()->type==UserTypes::PATIENT) {

            return $this->builder->where('patient_id', '=', Auth::user()->patient->id);
        }
        if (Auth::user()->type==UserTypes::DOCTOR) {
            return $this->builder->where('doctor_id', '=', Auth::user()->doctor->id);
        }

        return null;
    }

}
