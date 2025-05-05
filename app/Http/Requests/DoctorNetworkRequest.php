<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorNetworkRequest extends FormRequest
{
    public function authorize(): bool
    {
        // temporary as nothing was specified on the doc
        return true;
    }

    public function rules(): array
    {
        return [
            'specialization' => ['required', 'string'],
            'min_yoe' => ['nullable', 'sometimes', 'integer', 'min:0'],
            'max_yoe' => ['nullable', 'sometimes', 'integer', 'min:0', 'gte:min_yoe'],
        ];
    }
}
