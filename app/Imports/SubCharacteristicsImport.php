<?php

namespace App\Imports;

use App\Models\SubCharacteristic;
use Maatwebsite\Excel\Concerns\ToModel;

class SubCharacteristicsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SubCharacteristic([
            //
        ]);
    }
}
