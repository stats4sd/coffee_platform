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
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function toSearchableArray()
    {
        $array = $this->toArray();
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

        return $array;
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
