<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StatusTaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status_task_id' => ['required', 'integer', 'exists:status_tasks,id'],
            'id' => ['required', 'integer', Rule::exists('tasks')->where(function ($query) {
                $query->where('user_id', auth()->user()->id);
            })]
        ];
    }
}
