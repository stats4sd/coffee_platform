<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

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
        'converted_value',
        'standard_unit',
        'conversion_rate',
        'all_years',
        'small_sample',
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
        $array['code'] = $this->indicator->code;
        $array['name'] = $this->indicator->name;
        $array['indicator_name_original'] = $this->indicator_name_original;
        $array['unit_original'] = $this->getOriginalUnitAttribute();
        $array['unit_standard'] = $this->getStandardUnitAttribute();
        $array['definition_original'] = $this->definition;
        $array['region'] = $this->getRegionAttribute();
        $array['department'] = $this->getDepartmentAttribute();

        return $array;
    }

    public function getSmallSampleAttribute()
    {
        return $this->sample_size < 21;
    }


    public function getAllYearsAttribute()
    {
        return $this->years->map(function ($year) {
            return $year->year;
        })->join(' - ');
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
        return $this->source ? $this->source->partner->type_id : null;
    }

    public function getPartnerIdAttribute()
    {
        return $this->source ? $this->source->partner_id : null;
    }

    public function getCountryIdAttribute()
    {
        return $this->geoBoundary ? $this->geoBoundary->country_id : null;
    }

    public function getRegionAttribute()
    {
        if ($this->geoBoundary != null && $this->geoBoundary->region != null)
        {
            return $this->geoBoundary->region->name;
        }
        else 
        {
            return null;
        }
    }

    public function getDepartmentAttribute()
    {
        if ($this->geoBoundary != null && $this->geoBoundary->department != null)
        {
            return $this->geoBoundary->department->name;
        }
        else 
        {
            return null;
        }
    }

    public function getConversionRateAttribute()
    {
        return $this->unit ? $this->unit->getConversionRate($this->years->last()) : null;
    }

    public function getOriginalUnitAttribute()
    {
        if (!empty($this->unit->unitType)) {
            return $this->unit->name;
        } else {
            return null;
        }
    }

    public function getStandardUnitAttribute()
    {
        if (!empty($this->unit)) {
            return $this->unit->unitType->standard_unit;
        } else {
            return null;
        }
    }

    public function getConvertedValueAttribute()
    {
        return round($this->value * $this->conversion_rate, 2) + 0;
    }

    public function getValueAttribute($value)
    {
        return $value + 0; // trick to force removal of excess zeros from the decimal stored in the db.
    }

    // TODO: understand the mathematical difference between "20" and "20.0" and if this difference is important in this platform...
    // public function getPrecisionAttribute()
    // {
    //     $value = $this->value + 0;

    //     if (Str::contains($value, '.')) {
    //         return Str::length(Str::afterLast($value, '.'));
    //     }

    //     return 0;
    // }







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

    public function scope()
    {
        return $this->belongsTo(Scope::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function years()
    {
        return $this->belongsToMany(Year::class, '_link_years_indicator_values');
    }
}
