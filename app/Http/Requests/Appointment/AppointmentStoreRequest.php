<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentStoreRequest extends FormRequest
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
            'doctor_id'=>'integer|exists:doctors,id',
            'appointment_time'=>'date' ,
            'disease_detail'=>'string|min:3|max:255',
            //'disease_documents'=>'mimes:pdf,jpg,png'
           ];
    }
}
