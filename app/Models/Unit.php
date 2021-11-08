<?php

namespace App\Models;

use App\Models\UnitType;
use App\Models\Traits\HasTranslations;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UpdatesMainSearchIndex;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use CrudTrait, HasFactory, UpdatesMainSearchIndex, HasTranslations;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'units';
    protected $guarded = ['id'];
    protected $appends = [
        'conversion_rate',
        'name',
    ];

    protected $translatable = ['unit'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    // Unit name without appended "-customtype" for front-end
    public function getNameAttribute()
    {
        return Str::before($this->unit, '-');
    }

    public function getConversionRate(Year $year = null)
    {
        if ($this->unitType && $this->unitType->split_by_year) {
            if ($year == null) {
                return 'varies-by-year';
            }
            return $this->clean_num($this->getConverstionRateForYear($year));
        }

        if ($this->from_standard) {
            return $this->clean_num(1 / $this->from_standard);
        }

        if ($this->to_standard) {
            return $this->clean_num($this->to_standard);
        }
    }

    public function getConversionRateAttribute()
    {
        return $this->getConversionRate(null);
    }


    // Getter for Crud Field
    public function getConversionYearsAttribute()
    {
        if ($this->unitType && !$this->unitType->split_by_year) {
            return null;
        }

        return $this->years->map(function ($year) {
            return [
                'year' => $year->year,
                'to_standard' => $this->clean_num($year->pivot->to_standard),
            ];
        });
    }

    public function getConverstionRateForYear(Year $year)
    {
        if ($year = $this->years->firstWhere('id', $year->id)) {
            return $year->pivot->to_standard;
        }

        return null;
    }

    public function clean_num($value)
    {
        $pos = strpos($value, '.');
        if ($pos === false) { // it is integer number
            return $value;
        } else { // it is decimal number
            return rtrim(rtrim($value, '0'), '.');
        }
    }



    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function indicatorValues()
    {
        return $this->hasMany(IndicatorValue::class);
    }

    public function unitType()
    {
        return $this->belongsTo(UnitType::class);
    }

    public function years()
    {
        return $this->belongsToMany(Year::class, '_link_unit_year')->withPivot('to_standard');
    }

    public function standardUnit()
    {
        return $this->hasOne(UnitType::class, 'standard_unit');
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
}
