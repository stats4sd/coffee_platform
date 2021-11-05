<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class SubCharacteristic extends Model
{
    use CrudTrait, HasFactory, HasTranslations;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'sub_characteristics';
    protected $guarded = ['id'];
    protected $appends = [
        'characteristic_label',
    ];

    protected $translations = ['name'];

    public static function boot()
    {
        parent::boot();

        static::saved(function ($subCharacteristic) {
            $subCharacteristic->indicators->each(function ($indicator) {
                $indicator->indicatorValues->searchable();
            });
        });
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getCharacteristicLabelAttribute()
    {
        return $this->characteristic ? $this->characteristic->name . " (" . $this->name . ")" : null;
    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function characteristic()
    {
        return $this->belongsTo(Characteristic::class);
    }

    public function indicators()
    {
        return $this->hasMany(Indicator::class);
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
