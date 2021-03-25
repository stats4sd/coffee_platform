<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\GeoBoundary;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class GeoBoundaryRequest extends FormRequest
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
            'description' => ['required', 'max:255', Rule::unique('geo_boundaries', 'description')->ignore(GeoBoundary::find(request()->id))],
            'country_id' => ['nullable', 'exists:countries,id'],
            'region_id' => ['nullable', 'exists:regions,id'],
            'department_id' => ['nullable', 'exists:departments,id'],
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
            //
        ];
    }
}
