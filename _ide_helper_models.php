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

