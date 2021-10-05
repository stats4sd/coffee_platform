<template>

    <div class="d-md-flex d-block">
    <div class="d-block">
        <div class="full-height sidebar shadow sticky-top">
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
            <div class="d-flex flex-column ">
                <ul class="list-group" style=" border-radius: 0% !important">
                    <sidebar-filter
                        v-model="selectedCountries"
                        title="Country"
                        :options="countries"
                    />
                    <sidebar-filter
                        v-model="selectedYears"
                        title="Year"
                        :options="years"
                        display-field="year"
                        value-field="id"
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
                    <sidebar-filter
                        v-model="selectedGenders"
                        title="Gender"
                        :options="genders"
                    />
                    <sidebar-filter
                        v-model="selectedScopes"
                        title="Scope"
                        :options="scopes"
                    />
                </ul>
            </div>
        </div>
        </div>
        <div class="flex-grow-1">
            <indicator-downloader
                :display-popover="downloadPopoverVisible"
                @hide="downloadPopoverVisible = false"
                @show-download-options="showDownloadOptions"
            />
            <indicator-download-options
                :visible="downloadOptionsVisible"
                :indicators="
                    indicatorsForSelection.filter((indicator) =>
                        selectedIndicators.includes(indicator.id)
                    )
                "
                :processing="processing"
                :processingXls="processingXls"
                :processingPdf="processingPdf"
                @hidden="downloadOptionsVisible = false"
                @remove-indicator="removeIndicator"
                @download-xlsx="downloadValues(selectedIndicators)"
                @download-pdf="downloadReport(selectedIndicators)"
            />
            <div style="position:relative;bottom:70px;">
            <div class="pt-4 px-lots pb-4">
                <h1 class="text-center pb-4">
                    Search or Browse Indicators
                </h1>
             
                <b-input-group class="mb-3 mx-4">
                    <template #append>
                        <b-input-group-text>
                            <i class="las la-search" />
                        </b-input-group-text>

                        <!-- Add clear button with inline Javascript -->
                        <b-input-group-text onClick="document.getElementById('__BVID__33').value = ''; document.getElementById('__BVID__33').focus(); ">
                            <i class="las la-times"></i>
                        </b-input-group-text>
                    </template>
                    <b-form-input
                        class="bg-light"
                        placeholder="Search for indicators"
                        @input="searchIndicators"                        
                    />
                </b-input-group>

                <h2 class="py-3">
                        Categories
                    </h2>
                <!-- <characteristics> -->
                <div class="d-flex flex-wrap pb-4">










                    <select-with-images
                        v-model="selectedCharacteristic"
                        :options="characteristics"
                        :something-selected="selectedCharacteristic ? true : false"
                        @input="resetSubCharacteristics"
                    />

                    
                </div>
                
                <!-- </characteristics> -->
                <!-- <sub-characteristics> -->




                <div v-if="selectedCharacteristic">

                    <h2 class="py-3">
                      Subcategories
                    </h2>
                    <div class="d-flex flex-wrap ">

                        <b-form-checkbox-group
                            v-model="selectedSubCharacteristics"
                            :options="
                                subCharacteristics.filter(
                                    (sub) =>
                                        sub.characteristic_id ===
                                        selectedCharacteristic
                                )
                            "
                            text-field="name"
                            button-variant="primary"
                            value-field="id"
                            buttons
                            class="ungrouped-buttons subcategories"
                            @change="forceSingle"
                        />
                    </div>
                </div>
            </div>

            <div class="bg-light pt-4 flex-grow-1">
                <div class="container py-4 px-5">
                    <!-- </sub-characteristics> -->

                    <!-- </indicator-main> -->
                    <!-- <results-section> -->

                    <div class="d-flex py-4">
                        <ul
                            class="text-small list-style-none border border-top-0 border-left-0 border-bottom-0 border-secondary pr-4 mr-4"
                            style="width: 35%; max-width: 24rem !important; min-width: 12rem; padding-left: 0.8rem;"
                        >
                            <li class="d-flex justify-content-between mb-1">
                                <div>Indicators Found:</div>
                                <div class="ml-1 font-weight-bold">
                                    {{ indicatorsForDisplay.length }}
                                </div>
                            </li>
                            <li class="d-flex justify-content-between">
                                <div>Indicator Values Found:</div>
                                <div class="ml-1 font-weight-bold">
                                    {{ filteredIndicatorValuesForDisplay.length }}
                                </div>
                            </li>
                        </ul>
                        <div class="flex-grow-1 ml-auto mr-5">
                            Indicator values can be previewed or downloaded individually. Indicators added to selection can be reviewed on the download icon in the top right corner.
                        </div>
                    </div>






                <!-- Add clear button with inline Javascript -->
                <input type="button" name="btnClearKeyword" id="btnClearKeyword" value="Clear Keyword" tabindex="-1" class="btn ml-2 pr-2 font-weight-bold btn-select btn-primary btn-sm" onClick="document.getElementById('__BVID__33').value = ''; document.getElementById('__BVID__33').focus(); ">






                    <b-table
                        :items="indicatorsForDisplay"
                        :fields="indicatorFields"
                        :busy="loading"
                        :sort-by.sync="sortBy"
                        :sort-desc.sync="sortDesc"
                        sticky-header
                        class="pb-4"
                        thead-class="bg-light open-top"
                    >
                        <template #cell(actions)="row">
                            <div
                                class="d-flex justify-content-start align-items-center"
                            >
                                <b-button
                                    size="sm"
                                    variant="primary"
                                    class="ml-2 font-weight-bold"
                                    @click="showValues(row.item)"
                                >
                                    <i class="las la-eye" />
                                </b-button>
                                <b-button
                                    size="sm"
                                    :variant="
                                        selectedIndicators.includes(row.item.id)
                                            ? 'info'
                                            : 'primary'
                                    "
                                    class="ml-2 pr-2 font-weight-bold btn-select"
                                    @click="toggleIndicatorSelection(row.item)"
                                >
                                    <span
                                        v-if="
                                            !selectedIndicators.includes(
                                                row.item.id
                                            )
                                        "
                                    >
                                        <i class="las la-plus" /> Add to
                                        selection
                                    </span>
                                    <span
                                        v-if="
                                            selectedIndicators.includes(
                                                row.item.id
                                            )
                                        "
                                    >
                                        <i class="las la-check mr-5" /> selected
                                    </span>
                                </b-button>
                                <b-button
                                    size="sm"
                                    variant="primary"
                                    class="ml-2 font-weight-bold"
                                    @click="downloadValues([row.item.id])"
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

        <indicator-values-preview-pane
            id="valuePreviewModal"
            :values="viewedIndicator.values || []"
            :indicator="viewedIndicator"
            :selected="selectedIndicators.includes(viewedIndicator.id)"
            @download="downloadValues"
            @toggle-indicator="toggleIndicatorSelection"
        />
    </div>
</template>

<script>
    import SelectWithImages from "./elements/SelectWithImages";
    import SidebarFilter from "./elements/SidebarFilter";
    import IndicatorValuesPreviewPane from "./elements/IndicatorValuesPreviewPane";
    import IndicatorDownloader from "./elements/IndicatorDownloader";
    import IndicatorDownloadOptions from "./elements/IndicatorDownloadOptions";
    import axios from "axios";

    export default {
        components: {
            SelectWithImages,
            SidebarFilter,
            IndicatorValuesPreviewPane,
            IndicatorDownloader,
            IndicatorDownloadOptions
        },

        data() {
            return {
                sortBy: 'code',
                sortDesc: false,
                processing: false,
                processingXls: false,
                processingPdf: false,
                loading: false,
                downloadOptionsVisible: false,
                downloadPopoverVisible: false,
                // Indicator table
                allIndicatorValues: [],
                indicatorFields: [
                    {
                        key: "code",
                        label: "Code",
                        sortable: true,
                    },
                    {
                        key: "name",
                        label: "Indicator",
                        sortable: true,
                    },
                    {
                        key: "actions",
                        label: "Actions",
                        class: "w-33 w-sm-50"
                    }
                ],

                // Filters
                countries: [],
                genders: [],
                years: [],
                types: [],
                purposes: [],
                scopes: [],

                selectedCountries: [],
                selectedGenders: [],
                selectedYears: [],
                selectedTypes: [],
                selectedPurposes: [],
                selectedScopes: [],

                characteristics: [],
                subCharacteristics: [],

                selectedCharacteristic: null,
                // There should only ever be 1 of these, but it's easier to use checkboxes to allow toggle on/off
                selectedSubCharacteristics: [],

                viewedIndicator: {},
                selectedIndicators: []
            };
        },
        computed: {
            //Indicators for display in the table should be filtered by the chosen characteristic + sub characteristic
            indicatorsForDisplay() {
                return this.prepareIndicators('filteredIndicatorValuesForDisplay')
            },

            // Indicators used to show the 'selected indicators' should NOT be filtered by characteristic / sub characteristic
            indicatorsForSelection() {
                return this.prepareIndicators('filteredIndicatorValuesForSelection')
            },
            filteredIndicatorValuesForDisplay() {
                return this.filterIndicatorsByCharacteristics(this.allIndicatorValues);
            },
            filteredIndicatorValuesForSelection() {
                return this.filterIndicators(this.allIndicatorValues);
            }
        },

        mounted() {
            this.getIndicatorValues();
            this.getCountries();
            this.getGenders();
            this.getScopes();
            this.getYears();
            this.getTypes();
            this.getPurposes();
            this.getCharacteristics();
            this.getSubCharacteristics();
        },
        methods: {
            getIndicatorValues() {
                var url = "/indicators/search?by-indicator";

                if (this.searchTerm) {
                    url += "&search='" + this.searchTerm + "'";
                }

                // if(this.activeFilters) {
                //     this.activeFilters.forEach((filter) => {
                //         url += `&${encodeURIComponent(filter.type)}=${encodeURIComponent(filter.value)}`
                //     })
                // }
                this.loading = true;
                axios
                    .get(url)
                    .then(result => {
                        this.allIndicatorValues = result.data;
                    })
                    .finally(() => (this.loading = false));
            },

            searchIndicators: _.debounce(function(value) {
                this.searchTerm = value;

                this.getIndicatorValues();
            }, 500),

            filterIndicators(values) {
                if (this.selectedCountries.length > 0) {
                    console.log("prefilter", values);
                    values = values.filter(value =>
                        this.selectedCountries.includes(value.country_id)
                    );
                    console.log("postfilter", values);
                }

                if (this.selectedGenders.length > 0) {
                    console.log("prefilter", values);
                    values = values.filter(value =>
                        this.selectedGenders.includes(value.gender_id)
                    );
                    console.log("postfilter", values);
                }

                if (this.selectedScopes.length > 0) {
                    console.log("prefilter", values);
                    values = values.filter(value =>
                        this.selectedScopes.includes(value.scope_id)
                    );
                    console.log("postfilter", values);
                }

                if (this.selectedYears.length > 0) {
                    values = values.filter(value =>
                        // check each year the value is linked to:
                        this.selectedYears.some(selected => value.years.map(year => year.id).includes(selected))
                    );
                }

                if (this.selectedTypes.length > 0) {
                    values = values.filter(value =>
                        (this.selectedTypes.includes(value.type_id))
                    );
                }
                if (this.selectedPurposes.length > 0) {
                    values = values.filter(value =>
                        this.selectedPurposes.includes(value.purpose_of_collection_id)
                    );
                }

                return values;
            },

            filterIndicatorsByCharacteristics(values) {
                values = this.filterIndicators(values)

                if (this.selectedSubCharacteristics.length > 0) {
                    values = values.filter(value =>
                        this.selectedSubCharacteristics.includes(
                            value.sub_characteristic_id
                        )
                    );
                }

                if (this.selectedCharacteristic) {
                    values = values.filter(
                        value =>
                            this.selectedCharacteristic === value.characteristic_id
                    );
                }
                return values;
            },

            getCountries() {
                axios
                    .get("/country")
                    .then(result => (this.countries = result.data));
            },

            getGenders() {
                axios
                    .get("/gender")
                    .then(result => (this.genders = result.data));
            },

            getScopes() {
                axios
                    .get("/scope")
                    .then(result => (this.scopes = result.data));
            },

            getYears() {
                axios.get("/year").then(result => (this.years = result.data));
            },

            getTypes() {
                axios.get("/type").then(result => (this.types = result.data));
            },

            getPurposes() {
                axios
                    .get("/purposeofcollection")
                    .then(result => (this.purposes = result.data));
            },

            getCharacteristics() {
                axios
                    .get("/characteristic")
                    .then(result => (this.characteristics = result.data));
            },

            getSubCharacteristics() {
                axios
                    .get("/subcharacteristic")
                    .then(result => (this.subCharacteristics = result.data));
            },

            forceSingle() {
                if (this.selectedSubCharacteristics.length > 1) {
                    this.selectedSubCharacteristics.shift();
                }
            },

            resetSubCharacteristics() {
                this.selectedSubCharacteristics = [];
            },

            showValues(indicator) {
                this.viewedIndicator = indicator;
                this.$bvModal.show("valuePreviewModal");
            },

            downloadValues(selectedIndicators) {
                this.processing = true;
                this.processingXls = true;
                axios
                    .post("indicators/download", {
                        indicators: selectedIndicators,
                        countries: this.selectedCountries,
                        years: this.selectedYears,
                        types: this.selectedTypes,
                        purposes: this.selectedPurposes,
                        genders: this.selectedGenders,
                        scopes: this.selectedScopes,
                    })
                    .then(result => {
                        this.makeAndClickLink(result.data);
                        this.processing = false;
                        this.processingXls = false;
                    });
            },

            downloadReport(selectedIndicators) {

                selectedIndicators = selectedIndicators.map(id => Number(id));
                this.processing = true;
                this.processingPdf = true;
                this.$bvToast.toast(
                    `Your download is being prepared. This may take some time - please leave this window open.`,
                    {
                        toaster: "b-toaster-top-center"
                    }
                );

                var indicatorValues = this.filteredIndicatorValuesForSelection.filter((value) => {
                    return selectedIndicators.includes(value.indicator_id);
                });

                axios
                    .post("indicators/report", {
                        indicator_values: indicatorValues,
                        indicators: selectedIndicators,
                        countries: this.selectedCountries,
                        years: this.selectedYears,
                        types: this.selectedTypes,
                        purposes: this.selectedPurposes,
                        genders: this.selectedGenders,
                        scopes: this.selectedScopes
                    })
                    .then(result => {
                        this.makeAndClickLink(result.data);
                        this.processing = false;                        
                        this.processingPdf = false;
                    });
            },

            makeAndClickLink(link) {
                const a = document.createElement("a");
                a.style.display = "none";
                a.href = link;
                var filename = link.split("/");
                filename = filename[filename.length - 1];
                a.download = filename;
                document.body.appendChild(a);
                a.click();
            },
            toggleIndicatorSelection(indicator) {
                if (this.selectedIndicators.includes(indicator.id)) {
                    this.removeIndicator(indicator);
                } else {
                    this.addIndicatortoSelection(indicator);
                }
            },

            addIndicatortoSelection(indicator) {
                if (this.selectedIndicators.includes(indicator)) {
                    console.log("already selected");
                } else {
                    this.selectedIndicators.push(indicator.id);
                    this.downloadPopoverVisible = true;
                }
            },

            removeIndicator(indicator) {
                var index = this.selectedIndicators.indexOf(indicator.id);
                this.selectedIndicators.splice(index, 1);
            },

            showDownloadOptions() {
                console.log("showing download options");
                this.downloadOptionsVisible = true;
            },

            // All the filters happen at the indicatorValue level.
            // So we should build the list of indicators up from the filteredIndicatorValues
            prepareIndicators(filterComputedValue) {
                if (this[filterComputedValue].length < 0) return [];

                var valuesByIndicator = this[filterComputedValue].reduce(
                    (result, indicatorValue) => {
                        result[indicatorValue.indicator_id] =
                            result[indicatorValue.indicator_id] || [];

                        result[indicatorValue.indicator_id].push(indicatorValue);
                        return result;
                    },
                    Object.create(null)
                );

                var indicators = Object.keys(valuesByIndicator).map(
                    indicator_id => {
                        return {
                            id: indicator_id,
                            code: valuesByIndicator[indicator_id][0].indicator.code,
                            name:
                                valuesByIndicator[indicator_id][0].indicator
                                    .name,
                            values: valuesByIndicator[indicator_id],
                            subCharacteristic: valuesByIndicator[indicator_id][0].indicator.sub_characteristic.characteristic_label,
                        };
                    }
                );

                return indicators;
            },
        }
    };
</script>
