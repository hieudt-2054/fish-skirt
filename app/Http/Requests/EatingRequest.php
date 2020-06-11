<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EatingRequest extends FormRequest
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
            '*.thucpham_id' => ['required'],
            '*.sogram' => ['required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            '*.thucpham_id.required' => 'Vui lòng chọn sản phẩm',
            '*.sogram.required' => 'Số gram phải là số',
            '*.sogram.numeric' => 'Vui lòng nhập số gram',
        ];
    }
}
