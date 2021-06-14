<?php

namespace App\Http\Requests\Medicine;

use Illuminate\Foundation\Http\FormRequest;

class MedicineListRequest extends FormRequest
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
            'name'=>'min:3',
            'barcode'=>'max:14',
            'active_ingredient'=>'string|min:3',
        ];
    }
}
