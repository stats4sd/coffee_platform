<?php

namespace App\Models;

use App\Models\UnitType;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UpdatesMainSearchIndex;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use CrudTrait, HasFactory, UpdatesMainSearchIndex;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'units';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    protected $appends = [
        'conversion_rate',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    // Getter for Crud Column
    public function getConversionRateAttribute()
    {
        if ($this->unitType && $this->unitType->split_by_year) {
            return 'varies-by-year';
        }
        if ($this->from_standard) {
            return $this->from_standard . ':1';
        }
        if ($this->to_standard) {
            return '1:'.$this->to_standard;
        }
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
                'to_standard' => $year->pivot->to_standard,
            ];
        });
    }

    public function getConverstionRateForYear(Year $year)
    {
        return $this->years->firstWhere('id', $year->id)->pivot->to_standard;
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
        return $this->belongsToMany(Year::class)->withPivot('to_standard');
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
