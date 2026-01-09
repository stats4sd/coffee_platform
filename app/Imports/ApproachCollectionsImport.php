<?php

namespace App\Imports;

use App\Http\Requests\ApproachCollectionRequest;
use App\Models\ApproachCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ApproachCollectionsImport implements ToModel, WithBatchInserts, WithHeadingRow, WithValidation
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ApproachCollection([
            'name' => $row['name'],
        ]);
    }

    public function rules(): array
    {
        return (new ApproachCollectionRequest)->rules();

        // return [
        //     'name' => ['required', 'max:255'],
        // ];
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
