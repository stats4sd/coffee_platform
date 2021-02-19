<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class IndicatorValueRequest extends FormRequest
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
            'indicator_id' => ['required', 'exists:indicators,id'],
            'value' => ['required', 'numeric'],
            'source_id' => ['nullable','exists:sources,id'],
            'geo_boundary_id' => ['required','exists:geo_boundaries,id'],
            'unit_id' => ['required','exists:units,id'],
            'gender_id' => ['required','exists:genders,id'],
            'sample_size' => ['required','integer'],
            'smallholder_definition_id' => ['required','exists:smallholder_definitions,id'],
            'user_id' => ['required','exists:users,id'],
            'purpose_of_collection_id' => ['required','exists:purpose_of_collections,id'],
            'approach_collection_id' => ['required','exists:approach_collections,id'],
            'scope' => ['nullable'],
            'year' => ['required', 'integer', 'min:1900', 'digits:4'],
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
