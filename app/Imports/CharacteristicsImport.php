<?php

namespace App\Imports;

use App\Models\Characteristic;
use Maatwebsite\Excel\Concerns\ToModel;

class CharacteristicsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Characteristic([
            //
        ]);
    }
}
