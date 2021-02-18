<?php

namespace App\Imports;

use App\Models\ApproachCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ApproachCollectionsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ApproachCollection([
            'name' => $row['name'],
        ]);
    }
}
