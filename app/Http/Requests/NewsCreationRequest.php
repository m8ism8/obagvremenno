<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsCreationRequest extends FormRequest
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
            'news' => 'array',
            'news.*.title' => 'string',
            'news.*.subtitle' => 'string',
            'news.*.show' => 'boolean',
            'news.*.text' => 'string',
            'news.*.image' => 'string',
        ];
    }
}
