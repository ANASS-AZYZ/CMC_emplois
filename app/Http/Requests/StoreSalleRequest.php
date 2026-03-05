<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalleRequest extends FormRequest
{
    
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

