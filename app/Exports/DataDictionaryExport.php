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
            ['variable', t('description')],
            ['code', t('Platform indicator code')],
            ['name', t('Platform indicator name')],
            ['indicator_name_original', t('Original indicator name by source')],
            ['country', t('The country the indicator refers to')],
            ['year', t('The year(s) the indicator refers to')],
            ['gender', t('Gender disaggregation')],
            ['value_original', t('Original indicator value')],
            ['unit_original', t('Original unit of measurement')],
            ['value_standard', t('Standardized indicator value')],
            ['unit_standard', t('Standardized unit of measurement')],
            ['conversion_rate', t('Conversion rate used to standardize')],
            ['purpose', t('Purpose of data collection')],
            ['sample_size', t('Sample size')],
            ['definition_original', t('Original indicator definition specified by source')],
            ['region', t('The region the indicator refers to')],
            ['department', t('THe department the indicator refers to')],
            ['municipality', t('The municipality the indicator refers to')],
            ['altitude', t('The altitude the indicator refers to')],
            ['other_location_info', t('Other location information')],
            ['source_partner', t('Source partner: name of organization/author of the source ')],
            ['source_partner_type', t('Source partner type')],
            ['source_name', t('Source name')],
            ['source_reference', t('Source reference')],
            ['source_description', t('Source description')],
            ['approach', t('Data collection approach')],
            ['scope', t('Scope of the indicator: nationally representative or not')],
            ['smallholder_definition', t('Smallholder definition')],
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
