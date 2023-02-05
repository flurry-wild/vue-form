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
        $interviewDate = str_replace("T", " ", stristr($this->interview_date, '.', true));;
        $this::merge(['interview_date' => date('Y-m-d H:i:s', strtotime($interviewDate))]);
        $this::merge(['marital_status' => filter_var($this->marital_status, FILTER_VALIDATE_BOOLEAN)]);

        return [
            'about' => 'required|string',
            'birthday' => 'required|dateformat:Y-m-d',
            'fio' => 'required|string',
            'interview_date' => 'required|date',
            'marital_status' => 'required|string|in:true,false'
        ];
    }
}
