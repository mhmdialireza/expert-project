<?php

namespace App\Http\Requests\Todo;

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
//        dd(request()->all());
        return [
            'title' => ['required', 'string', 'min:3'],
            'description' => ['sometimes', 'required', 'string', 'min:3'],
            // 'priority' => ['required','in:1,2,3,4,5'],
            'folder_id' => ['required', 'string'],
            'is_done' => ['boolean', 'required'],
            'dark' => ['string', 'required'],
            'is_reminder_active' => ['in:on'],
            'reminder_datetime' => [
//                'nullable',
//                'required_if:is_reminder_active,on',//TODO: set better validation text
//                'date_format:Y-m-d H:i'
            ],
        ];
    }
}
