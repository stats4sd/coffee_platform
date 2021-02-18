<?php

namespace App\Imports;

use App\Models\Indicator;
use Maatwebsite\Excel\Concerns\ToModel;

class IndicatorsSheetImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Indicator([
            //
        ]);
    }
}
