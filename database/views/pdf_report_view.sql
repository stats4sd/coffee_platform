SELECT
indicator_values.id AS 'ID',
indicator_values.indicator_id AS 'Indicator code',
indicators.code AS 'Indicator',
countries.name AS 'Country',
indicator_values.year AS 'Year',
indicator_values.value AS 'Value',
genders.name AS 'Gender',
IF (indicator_values.gender_id IS NOT NULL, 'TRUE', 'FALSE') AS 'GenderSplit',
purpose_of_collections.name AS 'Purpose',
partners.name AS 'Partner',
sources.name AS 'Source',
sources.reference AS 'URL',
approach_collections.name AS 'Approach',
indicator_values.sample_size AS 'Sample Size',
types.name AS 'Source Type',
geo_boundaries.name AS 'Geo-boundaries',
indicators.definition AS 'Indicator definition',
units.unit AS 'Unit',
sub_characteristics.name AS 'Indicator Group',
smallholder_definitions.definition AS 'Smallholder Definition'
FROM indicator_values
LEFT JOIN indicators ON indicators.id = indicator_values.indicator_id
LEFT JOIN geo_boundaries ON geo_boundaries.id = indicator_values.geo_boundary_id
LEFT JOIN countries ON countries.id = geo_boundaries.country_id
LEFT JOIN genders ON genders.id = indicator_values.gender_id
LEFT JOIN purpose_of_collections ON purpose_of_collections.id = indicator_values.purpose_of_collection_id
LEFT JOIN sources ON sources.id = indicator_values.source_id
LEFT JOIN partners ON partners.id = sources.partner_id
LEFT JOIN approach_collections ON approach_collections.id = indicator_values.approach_collection_id
LEFT JOIN types ON types.id = sources.type_id
LEFT JOIN units ON units.id = indicator_values.unit_id
LEFT JOIN sub_characteristics ON sub_characteristics.id = indicators.sub_characteristic_id
LEFT JOIN smallholder_definitions ON smallholder_definitions.id = indicator_values.smallholder_definition_id;