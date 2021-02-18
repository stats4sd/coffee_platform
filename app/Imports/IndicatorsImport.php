<?php

namespace App\Imports;

use App\Models\Indicator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class IndicatorsImport implements WithMultipleSheets
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function sheets(): array
    {
        return [
            'characteristics' => CharacteristicsImport::class,
            'sub-characteristics' => SubCharacteristicsImport::class,
            'indicators' => IndicatorSheetImport::class,
        ];
    }
}
