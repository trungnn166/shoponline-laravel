<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'image' => 'image',
            'content' => 'required',
            'description' => 'required'
        ];
    }

    public function messages() {
        return [
            'name.required' => '(*) Tên không được để trống',
            'category_id.required' => '(*) Danh mục không được để trống',
            'brand_id.required' => '(*) Thương hiệu không được để trống',
            'image.image' => '(*) Nhập đúng định dạng ảnh.',
            'content.required' => '(*) Nội dung không được để trống',
            'description.required' => '(*) Mô tả không được để trống',

        ];
    }
}
