<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
     * ex:
     * "name" => "2019 Elementary and Junior High School Honors Choir - 27th Annual"
     * "short_name" => "2019 Elem/Jr HS Honors"
     * "start_date" => "2018-02-01"
     * "end_date" => "2019-01-31"
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => ['required', 'string'],
            "short_name" => ['required' , 'string'],
            "start_date" => ['required', 'date'],
            "end_date" => ['required', 'date'],
        ];
    }
}
