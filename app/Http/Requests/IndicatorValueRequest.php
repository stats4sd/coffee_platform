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
            'indicator_id' => 'required',
            'value' => 'required',
            // 'source_id' => 'required',
            'geo_boundary_id' => 'required',
            'unit_id' => 'required',
            'gender_id' => 'required',
            'sample_size' => 'required',
            'smallholder_definition_id' => 'required',
            'user_id' => 'required',
            'purpose_of_collection_id' => 'required',
            'approach_collection_id' => 'required',
            'scope' => 'required',
            'year' => 'required|integer|min:1900|digits:4'
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
