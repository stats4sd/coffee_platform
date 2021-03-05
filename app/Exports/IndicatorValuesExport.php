<?php

namespace App\Exports;

use App\Models\IndicatorValue;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IndicatorValuesExport implements FromQuery, WithHeadings
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
        $query = IndicatorValue::select(
            'indicator_values.id',
            'characteristics.id',
            'characteristics.name',
            'sub_characteristics.id',
            'sub_characteristics.name',
            'indicators.id',
            'indicators.code',
            'indicators.definition',
            'countries.id',
            'countries.name',
            'geo_boundaries.id',
            'geo_boundaries.name',
            'indicator_values.year',
            'indicator_values.value',
            'indicator_values.unit_id',
            'units.unit',
            'indicator_values.approach_collection_id',
            'approach_collections.name',
            'indicator_values.gender_id',
            'genders.name',
            'indicator_values.purpose_of_collection_id',
            'purpose_of_collections.name',
            'indicator_values.sample_size',
            'indicator_values.scope',
            'indicator_values.smallholder_definition_id',
            'smallholder_definitions.definition',
            'indicator_values.user_id',
            'users.name',
            'indicator_values.updated_at',
        )
        ->join('indicators', 'indicators.id', '=', 'indicator_values.indicator_id')
        ->join('sub_characteristics', 'sub_characteristics.id', '=', 'indicators.sub_characteristic_id')
        ->join('characteristics', 'characteristics.id', '=', 'sub_characteristics.characteristic_id')
        ->join('geo_boundaries', 'geo_boundaries.id', '=', 'indicator_values.geo_boundary_id')
        ->join('countries', 'countries.id', '=', 'geo_boundaries.country_id')
        ->join('units', 'units.id', '=', 'indicator_values.unit_id')
        ->join('approach_collections', 'approach_collections.id', '=', 'indicator_values.approach_collection_id')
        ->join('genders', 'genders.id', '=', 'indicator_values.gender_id')
        ->join('purpose_of_collections', 'purpose_of_collections.id', '=', 'indicator_values.purpose_of_collection_id')
        ->join('smallholder_definitions', 'smallholder_definitions.id', '=', 'indicator_values.smallholder_definition_id')
        ->join('users', 'users.id', '=', 'indicator_values.user_id');


        if ($this->indicators) {
            $query = $query->whereIn('indicator_id', $this->indicators);
        }

        if ($this->countries) {
            $query = $query->whereHas('geoBoundary', function (Builder $query) {
                $query->whereIn('country_id', $this->countries);
            });
        }

        if ($this->years) {
            $query = $query->whereIn('year', $this->years);
        }

        if ($this->types) {
            $query = $query->whereHas('source', function (Builder $query) {
                $query->whereIn('type_id', $this->types);
            });
        }

        if ($this->purposes) {
            $query = $query->whereHas('purposeOfCollection', function (Builder $query) {
                $query->whereIn('purpose_of_collections.id', $this->purposes);
            });
        }

        return $query;
    }

    public function headings() : array
    {
        return [
            'id',
            'characteristic_id',
            'characteristic',
            'sub_characteristic_id',
            'sub_characteristic',
            'indicator_id',
            'indicator_code',
            'indicator_definition',
            'country_id',
            'country',
            'geo_boundary_id',
            'geo_boundary',
            'year',
            'value',
            'unit_id',
            'unit',
            'approach_collection_id',
            'approach_to_collection',
            'gender_id',
            'gender disaggregation',
            'purpose_of_collection_id',
            'purpose_of_collection',
            'sample_size',
            'scope',
            'smallholder_definition_id',
            'smallholder_definition',
            'user_id',
            'uploader',
            'last_updated'
        ];
    }
}
