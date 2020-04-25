<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectForm extends FormRequest
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
            'name'=>'required|min:3',
            'type'=>'required',
            'category'=>'required',
            'step'=>'required|integer',
            'client'=>'required|min:3',
            'date_start' => 'date|required',
            'date_end' => 'date|required',
            'deadline' => 'date|required',
            'status'=>'required',
            'version'=>'required',
        ];
    }
}
