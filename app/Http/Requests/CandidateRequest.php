<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateRequest extends FormRequest
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
            'about' => 'required|string',
            'birthday' => 'required|date',
            'fio' => 'required|string',
            'interview_date' => 'required|date',
            'marital_status' => 'required|string|in:true,false'
        ];
    }
}
