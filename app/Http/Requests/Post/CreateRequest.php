<?php

namespace App\Http\Requests\Post;

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
            'post' => 'required|max:140',
            'shop_id' => 'required|exists:shops,id',
            'images' => 'array|max:4',
            'images.*' => 'required|image|mimes:jpeg,png,gif|max:2048'
        ];
    }

    public function postContent(): string {
        return $this->input('post');
    }

    public function userId(): int {
        return $this->user()->id;
    }

    public function shopId(): int {
        return $this->input('shop_id');
    }

    public function images(): array {
        return $this->file('images', []);

    }
}
