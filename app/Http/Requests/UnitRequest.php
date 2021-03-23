<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Unit;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'unit' => ['required', 'max:255'],
            'unit_type_id' => ['required', 'exists:unit_types,id'],
            'to_standard' => ['required_without:from_standard', 'prohibited_unless:from_standard,null'],
            'from_standard' => ['required_without:to_standard','prohibited_unless:to_standard,null'],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'to_standard.prohibited_unless' => 'Please only enter one option for converting to standard units.',
            'from_standard.prohibited_unless' => 'Please only enter one option for converting to standard units.',
        ];
    }
}
