<?php

namespace App\Exports;

use App\Models\IndicatorValue;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class IndicatorValuesExport implements FromQuery, WithHeadings, WithMapping
{
    public $indicators = null;
    public $countries = null;
    public $years = null;
    public $types = null;
    public $purposes = null;


    // Setters
    public function forIndicators(array $indicators)
    {
        $this->indicators = count($indicators) > 0 ? $indicators : null;

        return $this;
    }

    public function forCountries(array $countries)
    {
        $this->countries = count($countries) > 0 ? $countries : null;
        return $this;
    }

    public function forYears(array $years)
    {
        $this->years = count($years) > 0 ? $years : null;
        return $this;
    }

    public function forTypes(array $types)
    {
        $this->types = count($types) > 0 ? $types : null;
        return $this;
    }

    public function forPurposes(array $purposes)
    {
        $this->purposes = count($purposes) > 0 ? $purposes : null;
        return $this;
    }

    public function query()
    {
        $query = IndicatorValue::with([
            'indicator.subCharacteristic.characteristic',
            'source.partner',
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

        return $query;
    }

    public function map($value) : array
    {
        return [
            $value->indicator->code,
            $value->indicator->name,
            $value->geoBoundary->country ? $value->geoBoundary->country->name : 'null',
            $value->all_years,
            $value->converted_value,
            $value->standard_unit,
            $value->value,
            $value->unit->unit,
            $value->gender->name,
            $value->sample_size,
            $value->purposeOfCollection->name,
            $value->definition,
            $value->geoBoundary->region ? $value->geoBoundary->region->name : 'null',
            $value->geoBoundary->department ? $value->geoBoundary->department->name : 'null',
            $value->geoBoundary->muncipality ? $value->geoBoundary->muncipality->name : 'null',
            $value->geoBoundary->altitude ? $value->geoBoundary->altitude : 'null',
            $value->geoBoundary->description,
            $value->is_not_public ? 'Not available' : $value->source->partner->name,
            $value->is_not_public ? 'Not available' : ($value->source->partner->type ? $value->source->partner->type->name : "null"),
            $value->is_not_public ? 'Not available' : $value->source->name,
            $value->is_not_public ? 'Not available' : $value->source->reference,
            $value->is_not_public ? 'Not available' : $value->source->description,
            $value->approachCollection->name,
            $value->scope ? $value->scope->name : 'null',
            $value->smallholderDefinition ? $value->smallholderDefinition->definition : 'null',
        ];
    }

    public function headings() : array
    {
        return [
            'indicator_code',
            'indicator_name',
            'country',
            'year',
            'indicator_value',
            'unit',
            'indicator_value_original',
            'unit_original',
            'gender',
            'sample_size',
            'purpose_of_collection',
            'indicator_definition_by_source',
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
            'approach_to_collection',
            'scope',
            'smallholder_definition',
        ];
    }
}
