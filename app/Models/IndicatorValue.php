<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class IndicatorValue extends Model
{
    use CrudTrait, HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'indicatorValues';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

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
