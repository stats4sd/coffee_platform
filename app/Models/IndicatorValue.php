<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndicatorValue extends Model
{
    use CrudTrait, HasFactory, Searchable;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'indicator_values';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    protected $with = [
        'indicator',
        'unit',
    ];

    protected $appends = [
        'sub_characteristic_id',
        'characteristic_id',
        'type_id',
        'partner_id',
        'country_id',
        'converted_attribute',
        'standard_unit',
        'conversion_rate'
    ];


    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function toSearchableArray()
    {
        // handling attributes and relations seperately to avoid issue where an array cannot be tokenised by Scout.
        $array = $this->attributesToArray();

        //for full-text search;
        $array['indicator'] = $this->indicator;
        $array['subCharacteristic'] = $this->indicator->subCharacteristic;
        $array['characteristic'] = $this->indicator->subCharacteristic->characteristic;
        $array['source'] = $this->source;
        $array['type'] = $this->source->type;
        $array['partner'] = $this->source->partner;

        $array['user'] = $this->user;
        $array['approachCollection'] = $this->approachCollection;
        $array['purposeOfCollection'] = $this->purposeOfCollection;
        $array['smallholderDefinition'] = $this->smallholderDefinition;
        $array['gender'] = $this->gender;
        $array['unit'] = $this->unit;

        $array['geoBoundary'] = $this->geoBoundary;
        $array['country'] = $this->geoBoundary->country->name;


        // for filters
        $array['sub_characteristic_id'] = $this->indicator->sub_characteristic_id;
        $array['characteristic_id'] = $this->indicator->subCharacteristic->characteristic_id;
        $array['type_id'] = $this->source->type_id;
        $array['partner_id'] = $this->source->partner_id;
        $array['country_id'] = $this->country_id;


        return $array;
    }

    public function getSubCharacteristicIdAttribute()
    {
        return $this->indicator ? $this->indicator->sub_characteristic_id : null;
    }

    public function getCharacteristicIdAttribute()
    {
        return $this->indicator ? $this->indicator->subCharacteristic->characteristic_id : null;
    }

    public function getTypeIdAttribute()
    {
        return $this->source ? $this->source->type_id : null;
    }

    public function getPartnerIdAttribute()
    {
        return $this->source ? $this->source->partner_id : null;
    }

    public function getCountryIdAttribute()
    {
        return $this->geoBoundary->country_id;
    }

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

    public function geoBoundary()
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

    public function smallholderDefinition()
    {
        return $this->belongsTo(SmallholderDefinition::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purposeOfCollection()
    {
        return $this->belongsTo(PurposeOfCollection::class);
    }

    public function approachCollection()
    {
        return $this->belongsTo(ApproachCollection::class);
    }
}
