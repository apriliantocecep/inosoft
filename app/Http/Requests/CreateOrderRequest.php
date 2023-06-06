<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'kendaraan_id' => ['required', 'exists:App\Models\Kendaraan,_id'],
            'qty' => ['required', 'integer', 'min:1'],
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $content = [
            'error' => true,
            'data' => [
                'message' => $validator->errors()->first(),
            ]
        ];

        $response = new \Illuminate\Http\Response($content, 422);
        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
