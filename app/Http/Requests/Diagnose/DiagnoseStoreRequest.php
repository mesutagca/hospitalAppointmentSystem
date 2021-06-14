<?php


namespace App\Http\Requests\Diagnose;

use Illuminate\Foundation\Http\FormRequest;

class DiagnoseStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return Gate::allows('create', Diagnose::class);//bool döner
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
            'name' => 'required|string|max:15',
        ];
    }
}
