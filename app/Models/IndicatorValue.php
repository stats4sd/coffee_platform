<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class IndicatorValue extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'indicator_values';
    protected $guarded = ['id'];
    protected $appends = [
        'converted_attribute',
        'standard_unit',
        'conversion_rate'
    ];


    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getConversionRateAttribute()
    {
        return $this->unit->conversion_rate;
    }


    public function getStandardUnitAttribute()
    {
        return $this->unit->unitType->standard_unit;
    }

    public function getConvertedValueAttribute()
    {
        if ($this->unit->to_standard) {
            return $this->value * $this->unit->to_standard;
        }

        if ($this->unit->from_standard) {
            return $this->value / $this->unit->from_standard;
        }
    }



    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function indicator()
    {
        return $this->belongsTo(Indicator::class);
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function geo_boundary()
    {
        return $this->belongsTo(GeoBoundary::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function smallholder_definition()
    {
        return $this->belongsTo(SmallholderDefinition::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purpose_of_collection()
    {
        return $this->belongsTo(PurposeOfCollection::class);
    }

    public function approach_collection()
    {
        return $this->belongsTo(ApproachCollection::class);
    }
}
