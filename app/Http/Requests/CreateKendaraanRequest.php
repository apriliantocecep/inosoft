<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateKendaraanRequest extends FormRequest
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
            'nama' => [
                'required',
                'min:3'
            ],
            'tahun_keluaran' => [
                'required',
                'digits:4',
                'integer',
                'min:1990',
            ],
            'warna' => [
                'required',
            ],
            'harga' => [
                'required',
                'numeric'
            ],
            'mesin' => [
                'required',
            ],
            'tipe_suspensi' => [
                'required',
            ],
            'tipe_transmisi' => [
                'required',
            ],
            'kapasitas_penumpang' => [
                'required',
            ],
            'tipe' => [
                'required',
            ],
            'jenis' => [
                'required',
                Rule::in(['motor', 'mobil'])
            ],
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
