<?php

namespace App\Models\Traits;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations as BaseHasTranslations;

trait HasTranslations
{
    use BaseHasTranslations;
    /**
     * OVERRIDE default toArray() to return the translations based on the current locale
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, \App::getLocale());
        }
        return $attributes;
    }
}
