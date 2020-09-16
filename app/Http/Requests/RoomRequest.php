<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class RoomRequest extends FormRequest
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
            'room_name' => ['required', 'regex:/^([a-zA-Z0-9@_.-]{3,})+$/'],
            'room_type' => ['required', 'regex:/^single$|^couple$|^timely$/'],
            'comment' => 'string'
        ];
    }
    return [
        'room_name' => ['required', 'regex:/^([a-zA-Z0-9@_.-]{3,})+$/'],
        'room_type' => ['required', 'regex:/^single$|^couple$|^timely$/'],
        'status' => ['required', 'regex:/^inactive$|^active$/'],
        'comment' => 'string'
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
