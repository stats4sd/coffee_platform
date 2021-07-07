<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DataDictionaryExport implements FromCollection, WithTitle, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return new Collection([
            ['variable', 'description'],
            ['code', 'Platform indicator code'],
            ['name', 'Platform indicator name'],
            ['indicator_name_original', 'Original indicator name by source'],
            ['country', 'The country the indicator refers to'],
            ['year', 'The year(s) the indicator refers to'],
            ['gender', 'Gender disaggregation'],
            ['value_original', 'Original indicator value'],
            ['unit_original', 'Original unit of measurement'],
            ['value_standard', 'Standardized indicator value'],
            ['unit_standard', 'Standardized unit of measurement'],
            ['conversion_rate', 'Conversion rate used to standardize'],
            ['purpose', 'Purpose of data collection'],
            ['sample_size', 'Sample size'],
            ['definition_original', 'Original indicator definition specified by source'],
            ['region', 'The region the indicator refers to'],
            ['department', 'THe department the indicator refers to'],
            ['muncipality', 'The muncipality the indicator refers to'],
            ['altitude', 'The altitude the indicator refers to'],
            ['other_location_info', 'Other location information'],
            ['source_partner', 'Source partner: name of organization/author of the source '],
            ['source_partner_type', 'Source partner type'],
            ['source_name', 'Source name'],
            ['source_reference', 'Source reference'],
            ['source_description', 'Source description'],
            ['approach', 'Data collection approach'],
            ['scope', 'Scope of the indicator: nationally representative or not'],
            ['smallholder_definition', 'Smallholder definition'],
        ]);
    }

        /**
     * @return string
     */
    public function title(): string
    {
        return 'variables';
    }

    public function styles(Worksheet $sheet)
    {
        $wrap = [
            'alignment' => [
                'wrapText' => true
            ],
        ];

        $h1 = [
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'B2D23E'],
            ],
        ];

        return [
            1 => $h1
        ];
    }

}
