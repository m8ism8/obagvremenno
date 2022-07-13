<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesCreationRequest extends FormRequest
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
            'sales' => 'present|array',
            'sales.*.title' => 'string',
            'sales.*.show' => 'boolean',
            'sales.*.is_main' => 'boolean' ,
            'sales.*.preview_image' => 'string',
            'sales.*.text' => 'string',
            'sales.*.image' => 'string',
            'products' => 'array',
            'products.*.id' => 'numeric'
        ];
    }
}
