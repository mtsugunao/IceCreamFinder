<?php

namespace App\Http\Requests\Shop;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'address' => 'required'
        ];
    }

    public function shopName(): string {
        return $this->input('name');
    }

    public function address(): string {
        return $this->input('address');
    }

    public function id(): int {
        return (int) $this->route('shopId');
    }
}
