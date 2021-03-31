<?php

namespace App\Models\Traits;

trait UpdatesMainSearchIndex
{
    public static function boot()
    {
        parent::boot();

        static::saved(function ($item) {
            if ($item->indicatorValues) {
                $item->indicatorValues->searchable();
            }
        });
    }
}
