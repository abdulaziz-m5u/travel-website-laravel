<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        switch($this->method()) {
            case 'POST' : {
                return [
                    'title' => 'required',
                    'excerpt' => 'required',
                    'image' => ['required', 'image', 'mimes:png,jpg,jpeg'],
                    'description' => 'required',
                    'category_id' => 'required'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'title' => 'required',
                    'excerpt' => 'required',
                    'image' => ['image', 'mimes:png,jpg,jpeg'],
                    'description' => 'required',
                    'category_id' => 'required'
                ];
            }
        }
    }
}
