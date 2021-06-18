<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Unit;
use App\Models\UnitType;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Validator;

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
        $unitType = UnitType::find(request()->unit_type_id);

        $splitByYear = $unitType ? $unitType->split_by_year : false;

        return [
            'unit' => ['required', 'max:255'],
            'unit_type_id' => ['required', 'exists:unit_types,id'],
            'to_standard' => [
                Rule::requiredIf(function () use ($splitByYear) {
                    return (!$splitByYear && request()->from_standard == null);
                }),
                'prohibited_unless:from_standard,null',
            ],
            'from_standard' => [
                Rule::requiredIf(function () use ($splitByYear) {
                    return (!$splitByYear && request()->to_standard == null);
                }),
                'prohibited_unless:to_standard,null'
            ],
            'conversion_years' => [
                Rule::requiredIf(function () use ($splitByYear) {
                    return $splitByYear;
                }),
                function ($attribute, $value, $fail) {
                    $years = json_decode($value, true);
                    if (!$years) {
                        return;
                    }
                    foreach ($years as $year) {
                        $validator = Validator::make((array) $year, [
                            'to_standard' => ['numeric','required'],
                            'year' => ['required', 'exists:years,year'],
                        ]);

                        if ($validator->fails()) {
                            $titleMessage = 'Some entries in the Year-by-year conversions are invalid. Please review the entries and the following errors:';
                            $messages = $validator->errors()->all();
                            array_unshift($messages, $titleMessage);

                            return $fail($messages);
                        }
                    }
                }
            ]
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
