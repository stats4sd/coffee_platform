<template>
    <div class="d-md-flex d-block">
        <!-- <indicator-sidebar> -->
        <div class="full-height sidebar shadow">
            <div class="sidebar-header bg-primary p-2 pl-4 mb-0 text-white">
                <h2>
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
                        v-model="selectedtypes"
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
        <div>
            <!-- <indicator-main> -->

            <div class="flex-grow-1 p-4 bg-white">
                <div class="row" />
                <h1>Search or Browse Indicators</h1>
                <b-input-group class="mb-3">
                    <template #append>
                        <b-input-group-text>
                            <i class="las la-search" />
                        </b-input-group-text>
                    </template>
                    <b-form-input
                        placeholder="Search for indicators"
                        @input="searchIndicators"
                    />
                </b-input-group>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos
                    sed vitae fugit quas facilis, dolore cupiditate, quia
                    voluptatum dolorum amet excepturi, consectetur omnis? Neque
                    labore inventore tempore voluptas, nostrum non!
                </p>
                <!-- <characteristics> -->
                <div class="d-flex flex-wrap">
                    <select-with-images
                        v-model="selectedCharacteristic"
                        :options="characteristics"
                    />
                </div>
                <!-- </characteristics> -->
                <!-- <sub-characteristics> -->
                <h2>Subcharacteristics</h2>
                <div class="d-flex flex-wrap">
                    <div
                        v-for="subCharacteristic in subCharacteristics"
                        :key="subCharacteristic.id"
                    >
                        <b-button
                            v-if="
                                subCharacteristic.characteristic_id ==
                                    selectedCharacteristic
                            "
                            variant="primary"
                            class="m-2"
                        >
                            {{ subCharacteristic.label }}
                        </b-button>
                    </div>
                </div>
                <!-- </sub-characteristics> -->

                <!-- </indicator-main> -->
                <!-- <results-section> -->
                <div class="mt-4">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                    Quisquam, error rerum quas repellendus magnam sapiente
                    maiores dolorem facilis voluptatibus natus perspiciatis
                    tempore blanditiis obcaecati praesentium non fugit harum
                    distinctio dolores.
                </div>

                <h4>No. of Indicators Returned: {{ indicators.length }}</h4>

                <b-table
                    :items="indicators"
                    :fields="indicatorFields"
                >
                    <template #cell(actions)="row">
                        <div class="d-flex justify-content-start">
                            <b-button
                                size="sm"
                                variant="primary"
                                class="mx-2"
                            >
                                <i class="las la-eye" />
                            </b-button>
                            <b-button
                                size="sm"
                                variant="primary"
                                class="mx-2"
                            >
                                <i class="las la-plus" /> Add to Selection
                            </b-button>
                            <b-button
                                size="sm"
                                variant="primary"
                                class="mx-2"
                            >
                                <i class="las la-download" />
                            </b-button>
                        </div>
                    </template>
                </b-table>
                <!-- </results-section> -->
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
                indicators: [],
                indicatorFields: [
                    'code',
                    'definition',
                    {
                        key: 'actions',
                        label: 'Actions',
                        class: 'w-25 w-sm-50'
                    },
                ],

                // Filters
                countries: [],
                years: [],
                types: [],
                purposes: [],

                selectedCountries: [],
                selectedYears: [],
                selectedtypes: [],
                selectedPurposes: [],

                characteristics: [],
                subCharacteristics: [],

                selectedCharacteristic: null,
                selectedSubCharacteristic: null,
            };
        },

        mounted() {
            this.getIndicatorValues();
            this.getCountries()
            this.getYears()
            this.getTypes()
            this.getPurposes()
        },

        methods: {
            getIndicatorValues() {
                var url = "/indicators/search?by-indicator"

                if(this.searchTerm) {
                    url += "&search='"+this.searchTerm+"'"
                }

                axios.get(url).then(result => {
                    var values = result.data;
                    this.indicators = values;
                    console.log(values);
                });
            },

            searchIndicators: _.debounce(function (value) {

                this.searchTerm = value;

                this.getIndicatorValues()
            }, 500),

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

        }
    };
</script>
