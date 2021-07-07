<?php

namespace App\Exports;

use App\Models\IndicatorValue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class IndicatorValuesWorkbookExport implements WithMultipleSheets
{
    public $indicators = null;
    public $countries = null;
    public $years = null;
    public $types = null;
    public $purposes = null;
    public $genders = null;
    public $scopes = null;
    
    // Setters
    public function forIndicators(array $indicators)
    {
        $this->indicators = count($indicators) > 0 ? $indicators : null;

        return $this;
    }

    public function forCountries(array $countries)
    {
        $this->countries = count($countries) > 0 ? $countries : null;
        return $this;
    }

    public function forYears(array $years)
    {
        $this->years = count($years) > 0 ? $years : null;
        return $this;
    }

    public function forTypes(array $types)
    {
        $this->types = count($types) > 0 ? $types : null;
        return $this;
    }

    public function forPurposes(array $purposes)
    {
        $this->purposes = count($purposes) > 0 ? $purposes : null;
        return $this;
    }

    public function forGenders(array $genders)
    {
        $this->genders = count($genders) > 0 ? $genders : null;
        return $this;
    }

    public function forScopes(array $scopes)
    {
        $this->scopes = count($scopes) > 0 ? $scopes : null;
        return $this;
    }
                                
    /**
    * @return array
    */
    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new DataDictionaryExport();
        $sheets[] = new IndicatorValuesExport($this->indicators,
        $this->countries,
        $this->years,
        $this->types,
        $this->purposes,
        $this->genders,
        $this->scopes);
        return $sheets;
    }
}









    