<?php

namespace App\Http\Requests\Shop;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'address' => 'required',
            'menu_name.*' => 'required',
            'menu_price.*' => 'required'
        ];
    }

    public function shopName(): string {
        return $this->input('name');
    }

    public function address(): string {
        return $this->input('address');
    }

    public function menu(): iterable  {
        return $this->input('menu_name', []);
    }

    public function price(): iterable {
        return $this->input('menu_price', []);
    }

}
