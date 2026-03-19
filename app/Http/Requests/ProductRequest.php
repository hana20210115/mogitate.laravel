<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'required|mimes:png,jpeg',
            'name' =>'required',
            'price'=>'required|numeric|between:0,10000',
            'seasons'=>'required|array',
            'description'=>'required|max:120',
        ];
    }

    public function messages(): array
    {
        return [
            'image.required' => '商品画像を登録してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力して下さい',
            'price.numeric' => '数値で入力して下さい',
            'price.between' => '0~10000円以内で入力してください',
            'seasons.required' => '季節を選択してください',
            'seasons.array' => '季節は配列でなければなりません。',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
        ];
    }

}
