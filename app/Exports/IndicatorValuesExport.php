<?php

namespace App\Exports;

use App\Models\IndicatorValue;
use App\Exports\IndicatorValuesWorkbookExport;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class IndicatorValuesExport implements FromCollection, WithHeadings, WithMapping, WithStrictNullComparison, WithTitle, WithStyles, ShouldAutoSize, WithColumnWidths
{
    public function __construct($indicators, $countries, $years, $types, $purposes, $genders, $scopes)
    {
        $this->indicators = $indicators;
        $this->countries = $countries;
        $this->years = $years;
        $this->types = $types;
        $this->purposes = $purposes;
        $this->genders = $genders;
        $this->scopes = $scopes;
    }

    public function collection()
    {
        $query = IndicatorValue::with([
            'indicator.subCharacteristic.characteristic',
            'source.partner',
            'source',
            'user',
            'approachCollection',
            'purposeOfCollection',
            'smallholderDefinition',
            'gender',
            'scope',
            'unit',
            'unit.unitType',
            'years',
        ]);

        if ($this->indicators) {
            $query = $query->whereIn('indicator_id', $this->indicators);
        }

        if ($this->countries) {
            $query = $query->whereHas('geoBoundary', function (Builder $query) {
                $query->whereIn('country_id', $this->countries);
            });
        }

        if ($this->years) {
            $query = $query->whereHas('years', function (Builder $query) {
                $query->whereIn('years.id', $this->years);
            });
        }

        if ($this->types) {
            $query = $query->whereHas('source', function (Builder $query) {
                $query->whereHas('partner', function (Builder $query) {
                    $query->whereIn('partners.type_id', $this->types);
                });
            });
        }

        if ($this->purposes) {
            $query = $query->whereHas('purposeOfCollection', function (Builder $query) {
                $query->whereIn('purpose_of_collections.id', $this->purposes);
            });
        }

        if ($this->genders) {
            $query = $query->whereHas('gender', function (Builder $query) {
                $query->whereIn('genders.id', $this->genders);
            });
        }

        if ($this->scopes) {
            $query = $query->whereHas('scope', function (Builder $query) {
                $query->whereIn('scopes.id', $this->scopes);
            });
        }

        return $query->get();
    }

    public function map($value) : array
    {
        return [
            $value->indicator->code,
            $value->indicator->name,
            $value->indicator_name_original,
            $value->geoBoundary->country ? $value->geoBoundary->country->name : 'null',
            $value->all_years,
            $value->gender->name,
            $value->value,
            $value->unit->name,
            $value->converted_value,
            $value->standard_unit,
            $value->conversion_rate,
            $value->purposeOfCollection->name,
            $value->sample_size,
            $value->definition,
            $value->geoBoundary->region ? $value->geoBoundary->region->name : 'null',
            $value->geoBoundary->department ? $value->geoBoundary->department->name : 'null',
            $value->geoBoundary->muncipality ? $value->geoBoundary->muncipality->name : 'null',
            $value->geoBoundary->altitude ? $value->geoBoundary->altitude : 'null',
            $value->geoBoundary->description,
            $value->source->is_not_public ? 'Not available' : $value->source->partner->name,
            $value->source->is_not_public ? 'Not available' : ($value->source->partner->type ? $value->source->partner->type->name : "null"),
            $value->source->is_not_public ? 'Not available' : $value->source->name,
            $value->source->is_not_public ? 'Not available' : $value->source->reference,
            $value->source->is_not_public ? 'Not available' : $value->source->description,
            $value->approachCollection->name,
            $value->scope ? $value->scope->name : 'null',
            $value->smallholderDefinition ? $value->smallholderDefinition->definition : 'null',
        ];
    }

    public function headings() : array
    {
        return [
            'code',
            'name',
            'indicator_name_original',
            'country',
            'year',
            'gender',
            'value_original',
            'unit_original',
            'value_standard',
            'unit_standard',
            'conversion_rate',
            'purpose',
            'sample_size',
            'definition_original',
            'region',
            'department',
            'muncipality',
            'altitude',
            'other_location_info',
            'source_partner',
            'source_partner_type',
            'source_name',
            'source_reference',
            'source_description',
            'approach',
            'scope',
            'smallholder_definition',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'indicator_values';
    }

    public function styles(Worksheet $sheet)
    {
        $h1 = [
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => '48A18E'],
            ],
        ];

        return [
            1 => $h1
        ];
    }

    public function columnWidths(): array
    {
        return [
            'B' => 50,
            'C' => 50,
            'G' => 14,
            'I' => 14,
            'N' => 35
        ];
    }
}
