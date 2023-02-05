<?php

namespace App\Http\Requests\Todo;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:3'],
            'description' => ['sometimes', 'required', 'string', 'min:3'],
            // 'priority' => ['required','in:1,2,3,4,5'],
            'folder_id' => ['required', 'string'],
            'is_done' => ['boolean', 'required'],
            'dark' => ['string', 'required'],
        ];
    }
}
