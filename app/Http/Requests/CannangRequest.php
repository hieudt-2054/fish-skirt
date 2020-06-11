<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CannangRequest extends FormRequest
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
            '*.socan' => ['required','numeric']
        ];
    }

    public function messages()
    {
        return [
            '*.socan.required' => 'Trường số cân là bắt buộc',
            '*.socan.numeric' => 'Số cân phải là số',
        ];
    }
}
