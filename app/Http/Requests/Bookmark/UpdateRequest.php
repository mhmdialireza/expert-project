<?php

namespace App\Http\Requests\Bookmark;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'url' => ['active_url', 'required', 'string'],
            'description' => ['sometimes', 'string', 'min:3'],
            'folder_id' => ['required', 'string'],
            'dark' => ['string', 'required'],
        ];
    }
}
