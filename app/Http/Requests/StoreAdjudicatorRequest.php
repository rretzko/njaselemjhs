<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAdjudicatorRequest extends FormRequest
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
            'ensemble_id' => ['required','numeric',Rule::exists('ensembles','id')],
            'room_id' => ['required','numeric',Rule::exists('rooms','id')],
            'voiceparts' =>['required','min:1','array'],
            'voiceparts.*' => ['required','numeric',Rule::exists('voiceparts','id')],
            'directors' => ['required','min:1','array'],
            'directors.*' => ['required','numeric',Rule::exists('directors','user_id')],
        ];
    }
}
