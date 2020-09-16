<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class GuestRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if($request->isMethod('post')) {
        return [
        'first_name' => 'required|regex:/^([a-zA-Z]{3,})+$/',
        'last_name' => 'required|regex:/^([a-zA-Z]{3,})+$/',
        'phone_number' => 'required|regex:/[0-9]/',
        'email' => 'regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/',
        'arrival_time' => 'required',
        'departure_time' => 'required',
        'arrival_date' => 'required',
        'departure_date' => 'required',
        'room_fk' => 'regex:/[0-9]/',
        'nationality' => 'required|regex:/^([a-zA-Z]{3,})+$/',
        'id_type' => 'required|regex:/^([a-zA-Z]{3,})+$/',
        'id_number' => 'required|regex:/[0-9]/',
        'extra_note' => 'regex:/^([a-zA-Z]{3,})+$/'
        ];
    }
    return [
        'first_name' => 'required|regex:/^([a-zA-Z]{3,})+$/',
        'last_name' => 'required|regex:/^([a-zA-Z]{3,})+$/',
        'phone_number' => 'required|regex:/[0-9]/',
        'email' => 'regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/',
        'arrival_time' => 'required',
        'departure_time' => 'required',
        'arrival_date' => 'required',
        'departure_date' => 'required',
        'room_fk' => 'regex:/[0-9]/',
        'status' => ['required', 'regex:/^active$|^inactive$/'],
        'nationality' => 'required|regex:/^([a-zA-Z]{3,})+$/',
        'id_type' => 'required|regex:/^([a-zA-Z]{3,})+$/',
        'id_number' => 'required|regex:/[0-9]/',
        'extra_note' => 'regex:/^([a-zA-Z]{3,})+$/'
        ];

    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(response()->json([
            'errors' => $errors
        ], Response::HTTP_BAD_REQUEST));
    }
}
