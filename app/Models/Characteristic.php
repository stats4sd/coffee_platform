<?php

namespace App\Models;

use App\Models\Traits\HasUploadFields;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Characteristic extends Model
{
    use CrudTrait, HasFactory, HasUploadFields;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'characteristics';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = [];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    public static function boot()
    {
        parent::boot();

        static::saved(function ($characteristic) {
            $characteristic->subCharacteristics->each(function ($subCharacteristic) {
                $subCharacteristic->indicators->each(function ($indicator) {
                    $indicator->indicatorValues->searchable();
                });
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
    public function subCharacteristics()
    {
        return $this->hasMany(SubCharacteristic::class);
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
    public function getCoverImageAttribute($value)
    {
        return Storage::disk('public')->url($value);
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setCoverImageAttribute($value)
    {
        $attribute_name = "cover_image";
        $disk = "public";
        $destination_path = "characteristics/";

        $this->uploadImageWithNames($value, $attribute_name, $disk, $destination_path);
    }
}
