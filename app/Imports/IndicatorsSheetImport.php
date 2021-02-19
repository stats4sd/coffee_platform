<?php

namespace App\Imports;

use App\Models\Indicator;
use App\Models\Characteristic;
use Illuminate\Validation\Rule;
use App\Models\SubCharacteristic;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class IndicatorsSheetImport implements ToCollection, WithHeadingRow, WithValidation, WithBatchInserts
{
    public function collection(Collection $collection)
    {
        // ddd($collection);

        Validator::make($collection->toArray(), $this->rules())->validate();

        foreach ($collection as $row) {

            // Assuming that characteristics and subcharacteristics have unique names,
            // and indicators have unique codes...

            $characteristic = Characteristic::firstOrCreate([
                'name' => $row['characteristic'],
            ]);

            $subCharacteristic = SubCharacteristic::firstOrCreate([
                'name' => $row['sub_characteristic'],
            ], [
                'characteristic_id' => $characteristic->id,
            ]);

            $indicator = Indicator::firstOrCreate([
                'code' => $row['code']
            ], [
                'definition' => $row['definition'],
                'sub_characteristic_id' => $subCharacteristic->id,
            ]);
        }
    }

    public function rules(): array
    {
        return [

            '*.code' => ['required', 'string', 'max:255'],
            '*.definition' => ['required', 'string'],
            '*.sub_characteristic' => ['required', 'string', 'max:255'], // expecting name of sub-characteristic
            '*.characteristic' => ['required', 'string', 'max:255'], // expecting name of characteristic
        ];
    }



    public function batchSize(): int
    {
        return 10000;
    }
}
