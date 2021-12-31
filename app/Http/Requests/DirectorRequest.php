<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DirectorRequest extends FormRequest
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
            'first' => ['required','string'],
            'last' => ['required','string'],
            'email' => ['required', 'email',Rule::unique('users')->ignore($this->director->user)],
            'phone' => ['required','string'],
            'address1' => ['required','string'],
            'address2' => ['nullable','string'],
            'city' => ['required','string'],
            'state_abbr' => ['required','string'],
            'postal_code' => ['required','string'],
            'country' => ['required','string'],
            'school' => ['required','string'],
            'saddress1' => ['required','string'],
            'saddress2' => ['nullable','string'],
            'scity' => ['required','string'],
            'sstate_abbr' => ['required','string'],
            'spostal_code' => ['required','string'],
            'membership' => ['required','string'],
            'elem_student_count' => ['required','numeric'],
            'jhs_student_count' => ['required','numeric'],
        ];
    }
}
