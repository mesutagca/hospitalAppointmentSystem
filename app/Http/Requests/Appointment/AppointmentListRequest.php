<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'=>'integer|max:3',
            'doctor_id'=>'integer|max:3',
            'patient_id'=>'integer|max:3',
            'appointment_time'=>"date_format('d-m-Y'))",
        ];
    }
}
