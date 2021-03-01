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
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IndicatorValue[] $indicatorValues
 * @property-read int|null $indicator_values_count
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
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubCharacteristic[] $subCharacteristic
 * @property-read int|null $sub_characteristic_count
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic query()
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
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GeoBoundary[] $geoBoundaries
 * @property-read int|null $geo_boundaries_count
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
 * App\Models\Gender
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IndicatorValue[] $indicatorValues
 * @property-read int|null $indicator_values_count
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
 * @property int $country_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Country $country
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IndicatorValue[] $indicatorValues
 * @property-read int|null $indicator_values_count
 * @method static \Illuminate\Database\Eloquent\Builder|GeoBoundary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoBoundary newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoBoundary query()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoBoundary whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoBoundary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoBoundary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoBoundary whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoBoundary whereUpdatedAt($value)
 */
	class GeoBoundary extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Indicator
 *
 * @property int $id
 * @property int $sub_characteristic_id
 * @property string $code
 * @property string $definition
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $characteristic_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IndicatorValue[] $indicatorValues
 * @property-read int|null $indicator_values_count
 * @property-read \App\Models\SubCharacteristic $subCharacteristic
 * @method static \Illuminate\Database\Eloquent\Builder|Indicator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Indicator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Indicator query()
 * @method static \Illuminate\Database\Eloquent\Builder|Indicator whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Indicator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Indicator whereDefinition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Indicator whereId($value)
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
 * @property string|null $year
 * @property int $geo_boundary_id
 * @property int $unit_id
 * @property int $gender_id
 * @property int|null $sample_size
 * @property int $smallholder_definition_id
 * @property int $user_id
 * @property int $purpose_of_collection_id
 * @property int $approach_collection_id
 * @property string|null $scope
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ApproachCollection $approachCollection
 * @property-read \App\Models\Gender $gender
 * @property-read \App\Models\GeoBoundary $geoBoundary
 * @property-read \App\Models\Indicator $indicator
 * @property-read \App\Models\PurposeOfCollection $purposeOfCollection
 * @property-read \App\Models\SmallholderDefinition $smallholderDefinition
 * @property-read \App\Models\Source $source
 * @property-read \App\Models\Unit $unit
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereApproachCollectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereGenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereGeoBoundaryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereIndicatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue wherePurposeOfCollectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereSampleSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereScope($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereSmallholderDefinitionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IndicatorValue whereYear($value)
 */
	class IndicatorValue extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Partner
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Source[] $sources
 * @property-read int|null $sources_count
 * @method static \Illuminate\Database\Eloquent\Builder|Partner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereUpdatedAt($value)
 */
	class Partner extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PurposeOfCollection
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IndicatorValue[] $indicatorValues
 * @property-read int|null $indicator_values_count
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
 * App\Models\SmallholderDefinition
 *
 * @property int $id
 * @property string $definition
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IndicatorValue[] $indicatorValues
 * @property-read int|null $indicator_values_count
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
 * @property string $name
 * @property string|null $reference
 * @property int $type_id
 * @property int $partner_id
 * @property string $description
 * @property array|null $file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IndicatorValue[] $indicatorValues
 * @property-read int|null $indicator_values_count
 * @property-read \App\Models\Partner $partner
 * @property-read \App\Models\Type $type
 * @method static \Illuminate\Database\Eloquent\Builder|Source newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Source newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Source query()
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source wherePartnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereTypeId($value)
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
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Characteristic $characteristic
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Indicator[] $indicators
 * @property-read int|null $indicators_count
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
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Source[] $sources
 * @property-read int|null $sources_count
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
 * @property string $unit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IndicatorValue[] $indicatorValues
 * @property-read int|null $indicator_values_count
 * @method static \Illuminate\Database\Eloquent\Builder|Unit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Unit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Unit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereUpdatedAt($value)
 */
	class Unit extends \Eloquent {}
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

