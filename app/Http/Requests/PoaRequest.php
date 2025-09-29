<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PoaRequest extends FormRequest
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
			'meta' => 'required|string',
			'direcc_id' => 'required',
			'depar_id' => 'required',
			'fecha_ini' => 'required|string',
			'fecha_fin' => 'required|string',
			'valor' => 'required',
        ];
    }
}
