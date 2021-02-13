<?php


namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class ToggleTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'completed' => [
                'required',
                'boolean',
            ]
        ];
    }
}
