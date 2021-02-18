<?php

namespace App\Exports;

use App\Models\ApproachCollection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApproachCollectionsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ApproachCollection::select('id', 'name')->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'name'
        ];
    }
}
