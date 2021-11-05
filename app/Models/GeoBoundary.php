<?php

namespace App\Models;

use App\Models\Traits\UpdatesMainSearchIndex;
use App\Models\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class GeoBoundary extends Model
{
    use CrudTrait, HasFactory, UpdatesMainSearchIndex, HasTranslations;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'geo_boundaries';
    protected $guarded = ['id'];

    protected $translatable = ['description'];

    protected $with = ['country'];

    protected $appends = ['geo_description'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function indicatorValues()
    {
        return $this->hasMany(IndicatorValue::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function getGeoDescriptionAttribute()
    {
        $CountryName= $this->country_id ? Country::find($this->country_id)->name : 'null';
        $RegionName = $this->region_id ? Region::find($this->region_id)->name : 'null';
        $DepartmentName = $this->department_id ? Department::find($this->department_id)->name : 'null';
        $MuncipalityName = $this->munciplaity_id ? Municipality::find($this->muncipality_id)->name : 'null';
        return "{$CountryName} - {$RegionName} - {$DepartmentName} - {$MuncipalityName} - {$this->altitude} - {$this->description}";
    }
}
