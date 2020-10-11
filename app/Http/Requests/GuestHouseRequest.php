<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class GuestHouseRequest extends FormRequest
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
            'name' => 'required|regex:/^([a-zA-Z ]{3,})+$/|unique:guest_houses',
            'slogan' => 'regex:/^([a-zA-Z ]{3,})+$/',
            'city' => 'required|regex:/^([a-zA-Z]{3,})+$/',
            'sector' => 'required|regex:/^([a-zA-Z]{3,})+$/',
            'logo' => 'max:10000|mimes:png,svg'
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
