<?php

namespace App\Models;

use App\Models\Traits\UpdatesMainSearchIndex;
use App\Models\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use CrudTrait, HasFactory, HasTranslations;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'partners';
    protected $guarded = ['id'];

    protected $translatable = ['name'];

    public static function boot()
    {
        parent::boot();

        static::saved(function ($partner) {
            $partner->sources->each(function ($source) {
                $source->indicatorValues->searchable();
            });
        });
    }

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
    public function sources()
    {
        return $this->hasMany(Source::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
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
