<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool { return true; }

public function rules(): array
{
    return [
        'code' => 'required|unique:salles,code',
        'type' => 'required|in:SC,SM',
        'capacite' => 'nullable|integer'
    ];
}
}
