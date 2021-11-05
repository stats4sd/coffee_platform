<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\ApproachCollection
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IndicatorValue[] $indicatorValues
 * @property-read int|null $indicator_values_count
 * @method static \Database\Factories\ApproachCollectionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ApproachCollection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApproachCollection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApproachCollection query()
 * @method static \Illuminate\Database\Eloquent\Builder|ApproachCollection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApproachCollection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApproachCollection whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApproachCollection whereUpdatedAt($value)
 */
	class ApproachCollection extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Characteristic
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $cover_image
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubCharacteristic[] $subCharacteristics
 * @property-read int|null $sub_characteristics_count
 * @method static \Database\Factories\CharacteristicFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic query()
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic whereCoverImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic whereUpdatedAt($value)
 */
	class Characteristic extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Country
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GeoBoundary[] $geoBoundaries
 * @property-read int|null $geo_boundaries_count
 * @property-read array $translations
 * @method static \Database\Factories\CountryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereUpdatedAt($value)
 */
	class Country extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Department
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GeoBoundary[] $geoBoundaries
 * @property-read int|null $geo_boundaries_count
 * @property-read array $translations
 * @method static \Database\Factories\DepartmentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department query()
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereUpdatedAt($value)
 */
	class Department extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Gender
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IndicatorValue[] $indicatorValues
 * @property-read int|null $indicator_values_count
 * @method static \Database\Factories\GenderFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Gender newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gender newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gender query()
 * @method static \Illuminate\Database\Eloquent\Builder|Gender whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gender whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gender whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gender whereUpdatedAt($value)
 */
	class Gender extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GeoBoundary
 *
 * @property int $id
 * @property int|null $country_id
 * @property int|null $region_id
 * @property int|null $department_id
 * @property int|null $muncipality_id
 * @property array|null $description
 * @property string|null $altitude
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Country|null $country
 * @property-read \App\Models\Department|null $department
 * @property-read mixed $geo_description
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IndicatorValue[] $indicatorValues
 * @property-read int|null $indicator_values_count
 * @property-read \App\Models\Municipality $municipality
 * @property-read \App\Models\Region|null $region
 * @method static \Database\Factories\GeoBoundaryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoBoundary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoBoundary newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoBoundary query()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoBoundary whereAltitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoBoundary whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoBoundary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoBoundary whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoBoundary whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoBoundary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoBoundary whereMuncipalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoBoundary whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoBoundary whereUpdatedAt($value)
 */
	class GeoBoundary extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Group
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IndicatorValue[] $indicatorValues
 * @property-read int|null $indicator_values_count
 * @method static \Database\Factories\GroupFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Group newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Group query()
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereUpdatedAt($value)
 */
	class Group extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Indicator
 *
 * @property int $id
 * @property int $sub_characteristic_id
 * @property string $code
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $characteristic_id
 * @property-read mixed $characteristic_name
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IndicatorValue[] $indicatorValues
 * @property-read int|null $indicator_values_count
 * @property-read \App\Models\SubCharacteristic $subCharacteristic
 * @method static \Database\Factories\IndicatorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Indicator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Indicator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Indicator query()
 * @method static \Illuminate\Database\Eloquent\Builder|Indicator whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Indicator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Indicator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Indicator whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Indicator whereSubCharacteristicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Indicator whereUpdatedAt($value)
 */
	class Indicator extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\IndicatorValue
 *
 * @property int $id
 * @property int $indicator_id
 * @property string|null $value
 * @property int $source_id
 * @property int $geo_boundary_id
 * @property int $unit_id
 * @property int $gender_id
 * @property int|null $sample_size
 * @property int|null $smallholder_definition_id
 * @property int $user_id
 * @property int $purpose_of_collection_id
 * @property int $approach_collection_id
 * @property int|null $scope_id
 * @property int|null $group_id
 * @property int $calculated_by_us
 * @property string|null $definition
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $indicator_name_original
 * @property-read \App\Models\ApproachCollection $approachCollection
 * @property-read \App\Models\Gender $gender
 * @property-read \App\Models\GeoBoundary $geoBoundary
 * @property-read mixed $all_years
 * @property-read mixed $characteristic_id
 * @property-read mixed $conversion_rate
 * @property-read mixed $converted_value
 * @property-read mixed $country_id
 * @property-read mixed $department
 * @property-read mixed $original_unit
 * @property-read mixed $partner_id
 * @property-read mixed $region
 * @property-read mixed $small_sample
 * @property-read mixed $standard_unit
 * @property-read mixed $sub_characteristic_id
 * @property-read mixed $type_id
 * @property-read \App\Models\Group|null $group
 * @property-read \App\Models\Indicator $indicator
 * @property-read \App\Models\PurposeOfCollection $purposeOfCollection
 * @property-read \App\Models\SmallholderDefinition|null $smallholderDefinition
 * @property-read \App\Models\Source $source
 * @property-read \App\Models\Unit $unit
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Year[] $years
 * @property-read int|null $years_count
 * @method static \Database\Factories\IndicatorValueFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereApproachCollectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereCalculatedByUs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereDefinition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereGenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereGeoBoundaryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereIndicatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereIndicatorNameOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue wherePurposeOfCollectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereSampleSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereScopeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereSmallholderDefinitionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereValue($value)
 */
	class IndicatorValue extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Municipality
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GeoBoundary[] $geoBoundaries
 * @property-read int|null $geo_boundaries_count
 * @property-read array $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality query()
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality whereUpdatedAt($value)
 */
	class Municipality extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Partner
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $type_id
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Source[] $sources
 * @property-read int|null $sources_count
 * @property-read \App\Models\Type|null $type
 * @method static \Database\Factories\PartnerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereUpdatedAt($value)
 */
	class Partner extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PurposeOfCollection
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IndicatorValue[] $indicatorValues
 * @property-read int|null $indicator_values_count
 * @method static \Database\Factories\PurposeOfCollectionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PurposeOfCollection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurposeOfCollection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurposeOfCollection query()
 * @method static \Illuminate\Database\Eloquent\Builder|PurposeOfCollection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurposeOfCollection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurposeOfCollection whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurposeOfCollection whereUpdatedAt($value)
 */
	class PurposeOfCollection extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Region
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GeoBoundary[] $geoBoundaries
 * @property-read int|null $geo_boundaries_count
 * @property-read array $translations
 * @method static \Database\Factories\RegionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region query()
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereUpdatedAt($value)
 */
	class Region extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Scope
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IndicatorValue[] $indicatorValues
 * @property-read int|null $indicator_values_count
 * @method static \Database\Factories\ScopeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Scope newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Scope newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Scope query()
 * @method static \Illuminate\Database\Eloquent\Builder|Scope whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Scope whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Scope whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Scope whereUpdatedAt($value)
 */
	class Scope extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SmallholderDefinition
 *
 * @property int $id
 * @property array $definition
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IndicatorValue[] $indicatorValues
 * @property-read int|null $indicator_values_count
 * @method static \Database\Factories\SmallholderDefinitionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|SmallholderDefinition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SmallholderDefinition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SmallholderDefinition query()
 * @method static \Illuminate\Database\Eloquent\Builder|SmallholderDefinition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmallholderDefinition whereDefinition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmallholderDefinition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmallholderDefinition whereUpdatedAt($value)
 */
	class SmallholderDefinition extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Source
 *
 * @property int $id
 * @property array $name
 * @property array|null $reference
 * @property int $partner_id
 * @property int $is_not_public
 * @property array|null $description
 * @property array|null $file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IndicatorValue[] $indicatorValues
 * @property-read int|null $indicator_values_count
 * @property-read \App\Models\Partner $partner
 * @method static \Database\Factories\SourceFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Source newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Source newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Source query()
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereIsNotPublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source wherePartnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereUpdatedAt($value)
 */
	class Source extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SubCharacteristic
 *
 * @property int $id
 * @property int $characteristic_id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Characteristic $characteristic
 * @property-read mixed $characteristic_label
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Indicator[] $indicators
 * @property-read int|null $indicators_count
 * @method static \Database\Factories\SubCharacteristicFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCharacteristic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCharacteristic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCharacteristic query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCharacteristic whereCharacteristicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCharacteristic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCharacteristic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCharacteristic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCharacteristic whereUpdatedAt($value)
 */
	class SubCharacteristic extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Type
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Partner[] $partners
 * @property-read int|null $partners_count
 * @method static \Database\Factories\TypeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Type newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Type newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Type query()
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereUpdatedAt($value)
 */
	class Type extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Unit
 *
 * @property int $id
 * @property array $unit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $unit_type_id
 * @property string|null $to_standard
 * @property string|null $from_standard
 * @property-read mixed $conversion_rate
 * @property-read mixed $conversion_years
 * @property-read mixed $name
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IndicatorValue[] $indicatorValues
 * @property-read int|null $indicator_values_count
 * @property-read \App\Models\UnitType $unitType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Year[] $years
 * @property-read int|null $years_count
 * @method static \Database\Factories\UnitFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Unit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Unit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereFromStandard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereToStandard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereUnitTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereUpdatedAt($value)
 */
	class Unit extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UnitType
 *
 * @property int $id
 * @property array $name
 * @property array $standard_unit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $split_by_year
 * @property-read mixed $name_with_unit
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit[] $units
 * @property-read int|null $units_count
 * @method static \Database\Factories\UnitTypeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UnitType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UnitType query()
 * @method static \Illuminate\Database\Eloquent\Builder|UnitType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitType whereSplitByYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitType whereStandardUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitType whereUpdatedAt($value)
 */
	class UnitType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IndicatorValue[] $indicatorValues
 * @property-read int|null $indicator_values_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Year
 *
 * @property int $id
 * @property string $year
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IndicatorValue[] $indicatorValues
 * @property-read int|null $indicator_values_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit[] $units
 * @property-read int|null $units_count
 * @method static \Database\Factories\YearFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Year newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Year newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Year query()
 * @method static \Illuminate\Database\Eloquent\Builder|Year whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Year whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Year whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Year whereYear($value)
 */
	class Year extends \Eloquent {}
}

