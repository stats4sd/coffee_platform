<template>
    <div class="d-md-flex d-block">
        <!-- <indicator-sidebar> -->
        <div class="full-height sidebar shadow">
            <div class="sidebar-header bg-primary p-4 mb-0 text-white">
                <h2 class="p-0 m-0">
                    Filters
                    <span
                        class="sidebar-icon"
                    ><i
                        class="las la-filter"
                    /></span>
                </h2>
            </div>
            <div class="d-flex flex-column">
                <ul class="list-group">
                    <sidebar-filter
                        v-model="selectedCountries"
                        title="Country"
                        :options="countries"
                    />
                    <sidebar-filter
                        v-model="selectedYears"
                        title="Years"
                        :options="years"
                        display-field="year"
                        value-field="year"
                    />
                    <sidebar-filter
                        v-model="selectedTypes"
                        title="Source Type"
                        :options="types"
                    />
                    <sidebar-filter
                        v-model="selectedPurposes"
                        title="Purpose"
                        :options="purposes"
                    />
                </ul>
            </div>
        </div>
        <!-- </indicator-sidebar> -->
        <!-- <indicator-main> -->
        <div class="flex-grow-1">
            <div
                class="pt-lots px-lots pb-4"
            >
                <h1 class="text-center pb-4">
                    Search or Browse Indicators
                </h1>
                <b-input-group class="mb-3">
                    <template #append>
                        <b-input-group-text>
                            <i class="las la-search" />
                        </b-input-group-text>
                    </template>
                    <b-form-input
                        class="bg-light"
                        placeholder="Search for indicators"
                        @input="searchIndicators"
                    />
                </b-input-group>
                <p class="pb-4 pt-2">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos
                    sed vitae fugit quas facilis, dolore cupiditate, quia
                    voluptatum dolorum amet excepturi, consectetur omnis? Neque
                    labore inventore tempore voluptas, nostrum non!
                </p>
                <!-- <characteristics> -->
                <div class="d-flex flex-wrap pb-4">
                    <select-with-images
                        v-model="selectedCharacteristic"
                        :options="characteristics"
                        @input="resetSubCharacteristics"
                    />
                </div>
                <!-- </characteristics> -->
                <!-- <sub-characteristics> -->
                <h2 class="pt-3">
                    Subcharacteristics
                </h2>
                <div class="d-flex flex-wrap">
                    <b-form-checkbox-group
                        v-model="selectedSubCharacteristics"
                        :options="subCharacteristics.filter(sub => sub.characteristic_id === selectedCharacteristic)"
                        text-field="name"
                        button-variant="primary"
                        value-field="id"
                        buttons
                        class="ungrouped-buttons"
                        @change="forceSingle"
                    />
                </div>
            </div>

            <div class="bg-light pt-4 flex-grow-1">
                <div class="container py-4">
                    <!-- </sub-characteristics> -->

                    <!-- </indicator-main> -->
                    <!-- <results-section> -->

                    <h5>Indicator Count: {{ indicators.length }}</h5>
                    <div class="py-4">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                        Quisquam, error rerum quas repellendus magnam sapiente
                        maiores dolorem facilis voluptatibus natus perspiciatis
                        tempore blanditiis obcaecati praesentium non fugit harum
                        distinctio dolores.
                    </div>

                    <b-table
                        :items="indicators"
                        :fields="indicatorFields"
                        sticky-header
                        class="pb-4"
                        thead-class="bg-light open-top"
                    >
                        <template #cell(actions)>
                            <div class="d-flex justify-content-start align-items-center">
                                <b-button
                                    size="sm"
                                    variant="primary"
                                    class="ml-2 font-weight-bold"
                                >
                                    <i class="las la-eye" />
                                </b-button>
                                <b-button
                                    size="sm"
                                    variant="primary"
                                    class="ml-2 font-weight-bold"
                                >
                                    <i class="las la-plus" /> Add to Selection
                                </b-button>
                                <b-button
                                    size="sm"
                                    variant="primary"
                                    class="ml-2 font-weight-bold"
                                >
                                    <i class="las la-download" />
                                </b-button>
                            </div>
                        </template>
                        <template #cell(code)="data">
                            <b>{{ data.value }}</b>
                        </template>
                    </b-table>
                    <!-- </results-section> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SelectWithImages from "./elements/SelectWithImages";
    import SidebarFilter from "./elements/SidebarFilter"

    export default {
        components: {
            SelectWithImages,
            SidebarFilter
        },

        data() {
            return {

                // Indicator table
                allIndicatorValues: [],
                indicatorFields: [
                    {
                        key: 'code',
                        label: 'indicator',
                    },
                    {
                        key: 'definition',
                        label: 'description',
                    },
                    {
                        key: 'actions',
                        label: 'Actions',
                        class: 'w-33 w-sm-50'
                    },
                ],

                // Filters
                countries: [],
                years: [],
                types: [],
                purposes: [],

                selectedCountries: [],
                selectedYears: [],
                selectedTypes: [],
                selectedPurposes: [],
                characteristics: [],
                subCharacteristics: [],

                selectedCharacteristic: null,

                // There should only ever be 1 of these, but it's easier to use checkboxes to allow toggle on/off
                selectedSubCharacteristics: [],
            };
        },
        computed: {
            indicators() {
                if(this.filteredIndicatorValues.length < 0) return [];

                var valuesByIndicator = this.filteredIndicatorValues.reduce((result, indicatorValue) => {
                    result[indicatorValue.indicator_id] = result[indicatorValue.indicator_id] || []

                    result[indicatorValue.indicator_id].push(indicatorValue);
                    return result;
                }, Object.create(null))

                var indicators = Object.keys(valuesByIndicator).map((indicator_id) => {

                    return {

                        code: valuesByIndicator[indicator_id][0].indicator.code,
                        description: valuesByIndicator[indicator_id][0].indicator.description,
                        values: valuesByIndicator[indicator_id],
                    }
                });

                return indicators;

            },
            filteredIndicatorValues() {
                return this.filterIndicators(this.allIndicatorValues);
            }
        },

        mounted() {
            this.getIndicatorValues();
            this.getCountries()
            this.getYears()
            this.getTypes()
            this.getPurposes()
            this.getCharacteristics()
            this.getSubCharacteristics()
        },
        methods: {
            getIndicatorValues() {
                var url = "/indicators/search?by-indicator"

                if(this.searchTerm) {
                    url += "&search='"+this.searchTerm+"'"
                }

                // if(this.activeFilters) {
                //     this.activeFilters.forEach((filter) => {
                //         url += `&${encodeURIComponent(filter.type)}=${encodeURIComponent(filter.value)}`
                //     })
                // }

                axios.get(url).then(result => {
                    this.allIndicatorValues = result.data
                });
            },

            searchIndicators: _.debounce(function (value) {

                this.searchTerm = value;

                this.getIndicatorValues()
            }, 500),

            filterIndicators(values) {
                if(this.selectedCountries.length > 0) {
                    console.log('prefilter', values)
                    values = values.filter((value) => this.selectedCountries.includes(value.country_id))
                    console.log('postfilter', values)
                }

                if(this.selectedYears.length > 0) {
                    values = values.filter((value) => this.selectedYears.includes(value.year))
                }

                if(this.selectedTypes.length > 0) {
                    values = values.filter((value) => this.selectedTypes.includes(value.type_id))
                }
                if(this.selectedPurposes.length > 0) {
                    values = values.filter((value) => this.selectedPurposes.includes(value.purpose_id))
                }

                if(this.selectedSubCharacteristics.length > 0) {
                    values = values.filter((value) => this.selectedSubCharacteristics.includes(value.sub_characteristic_id))
                }

                if(this.selectedCharacteristic) {
                    values = values.filter((value) => this.selectedCharacteristic === value.characteristic_id)
                }
                return values
            },

            getCountries() {
                axios.get('/country').then(result => this.countries = result.data)
            },

            getYears() {
                axios.get('/year').then(result => this.years = result.data)
            },

            getTypes() {
                axios.get('/type').then(result => this.types = result.data)
            },

            getPurposes() {
                axios.get('/purposeofcollection').then(result => this.purposes = result.data)
            },

            getCharacteristics() {
                axios.get('/characteristic').then(result => this.characteristics = result.data)
            },

            getSubCharacteristics() {
                axios.get('/subcharacteristic').then(result => this.subCharacteristics = result.data)
            },

            forceSingle() {
                if(this.selectedSubCharacteristics.length > 1) {
                    this.selectedSubCharacteristics.shift()
                }
            },

            resetSubCharacteristics() {
                this.selectedSubCharacteristics = [];
            },

        }
    };
</script>
