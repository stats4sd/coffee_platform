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
            'source.type',
            'source.partner',
            'user',
            'approachCollection',
            'purposeOfCollection',
            'smallholderDefinition',
            'gender',
            'unit',
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

    public function map($value) : array
    {
        return [
            $value->id,
            $value->indicator->subCharacteristic->characteristic_id,
            $value->indicator->subCharacteristic->characteristic->name,
            $value->indicator->sub_characteristic_id,
            $value->indicator->subCharacteristic->name,
            $value->indicator_id,
            $value->indicator->code,
            $value->indicator->definition,
            $value->geoBoundary->country_id,
            $value->geoBoundary->country->name,
            $value->geoBoundary->region_id,
            $value->geoBoundary->region->name,
            $value->geoBoundary->department_id,
            $value->geoBoundary->department->name,
            $value->geo_boundary_id,
            $value->geoBoundary->description,
            $value->all_years,
            $value->value,
            $value->unit_id,
            $value->unit->unit,
            $value->approach_collection_id,
            $value->approachCollection->name,
            $value->gender_id,
            $value->gender->name,
            $value->purpose_of_collection_id,
            $value->purposeOfCollection->name,
            $value->sample_size,
            $value->small_sample ? 'Small sample!' : '',
            $value->smallholder_definition_id,
            $value->smallholderDefinition->definition,
            $value->source_public ? 'Yes' : 'No',
            $value->source_public ? $value->source->name : 'Not available',
            $value->source_public ? $value->source->description : 'Not available',
            $value->source_public ? $value->source->type_id : 'Not available',
            $value->source_public ? $value->source->type->name : 'Not available',
            $value->source_public ? $value->source->partner_id : 'Not available',
            $value->source_public ? $value->source->partner->name : 'Not available',
            $value->user_id,
            $value->user ?  $value->user->name : 'null',
            $value->updated_at,
        ];
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
            'region_id',
            'region',
            'department_id',
            'department',
            'geo_boundary_id',
            'geo_boundary',
            'year(s)',
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
            'smallholder_definition_id',
            'smallholder_definition',
            'source_public',
            'source_name',
            'source_description',
            'source_type_id',
            'source_type',
            'source_partner_id',
            'source_partner',
            'user_id',
            'uploader',
            'last_updated'
        ];
    }
}
