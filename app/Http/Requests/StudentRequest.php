<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
          "first" => ['required', 'string'],
          "last" => ['required', 'string'],
          "grade" => ['required', 'numeric'],
          "ensemble_id" => ['required', 'numeric'],
          "voicepart_id" => ['required', 'numeric'],
          "guardian_first" => ['required', 'string'],
          "guardian_last" => ['required', 'string'],
          "guardian_email" => ['required', 'email'],
          "guardian_phone1" => ['required', 'string'],
          "guardian_phone2" => ['nullable', 'string'],
          "contract" => ['required', 'numeric'],
        ];
    }
}
