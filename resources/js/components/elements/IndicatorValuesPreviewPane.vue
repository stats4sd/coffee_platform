<template>
    <b-modal
        :id="id"
        centered
        size="xl"
        title="Indicator Values"
        header-bg-variant="primary"
        header-text-variant="light"
    >
        <template
            #modal-title
        >
            <h2 class="font-weight-bold w-75">
                Indicator Values Preview
            </h2>
        </template>

        <h3
            v-if="indicator"
            class="py-4"
        >
            {{ indicator.code + " - " + indicator.name }}
        </h3>
        <b-table
            class="mt-4 mb-2"
            :items="values"
            :fields="fields"
            sticky-header
            thead-class="bg-light open-top"
        >
            <template #cell(source_public)="row">
                {{ row.item.source_public == 1 ? "Yes" : "No" }}
            </template>
            <template #cell(sample_size)="row">
                <span
                    :class="
                        row.item.sample_size && row.item.sample_size < 21
                            ? 'text-danger'
                            : ''
                    "
                >{{ row.item.sample_size }}
                    <small
                        v-if="row.item.sample_size && row.item.sample_size < 21"
                        class="mr-2"
                    >
                        (Note: Small sample!)
                    </small>
                </span>
            </template>
            <template #cell(value)="row">
                <span v-if="!showStandardUnit">{{ row.item.value }}</span>
                <span v-if="showStandardUnit">{{ row.item.conversion_rate ? (Math.round(row.item.converted_value * 100) / 100).toFixed(2) : '-' }}</span>
            </template>
            <template #cell(unit)="row">
                <span v-if="!showStandardUnit">{{ row.item.unit.name }}</span>
                <span v-if="showStandardUnit">{{ row.item.standard_unit }}</span>
            </template>
        </b-table>

        <template #modal-footer>
            <div>When downloading data to Excel, both original and standardised values will be included.</div>
            <b-button
                size="sm"
                variant="info"
                class="ml-2 pr-2 font-weight-bold"
                @click="toggleUnits"
            >
                <span v-if="!showStandardUnit">Show values in standardised units</span>
                <span v-if="showStandardUnit">Show values in original unit</span>
            </b-button>
            <b-button
                size="sm"
                :variant="selected ? 'info' : 'primary'"
                class="ml-2 pr-2 font-weight-bold"
                @click="toggleIndicatorSelection(indicator)"
            >
                <span v-if="!selected">
                    <i class="las la-plus" /> Add to selection
                </span>
                <span v-if="selected">
                    <i class="las la-check mr-4" /> selected
                </span>
            </b-button>
            <b-button
                size="sm"
                variant="primary"
                @click="downloadValues"
            >
                <i class="las la-download" />
            </b-button>
            </b-button>
        </template>
    </b-modal>
</template>

<script>
    export default {
        props: {
            values: {
                type: Array,
                default: () => []
            },
            id: {
                type: String,
                default: "valuepreview"
            },
            indicator: {
                type: Object,
                default: null
            },
            selected: {
                type: Boolean,
                default: null
            },
        },
        data() {
            return {
                showStandardUnit: false,
                fields: [
                    {
                        key: "geo_boundary.country.name",
                        label: "Country"
                    },
                    {
                        key: "all_years",
                        label: "Year"
                    },
                    "value",
                    {
                        key: "unit",
                        label: "Unit"
                    },
                    {
                        key: "sample_size",
                        label: "Sample size"
                    },
                    {
                        key: "gender.name",
                        label: "Gender"
                    },
                    {
                        key: "purpose_of_collection.name",
                        label: "Purpose of collection"
                    }
                ]
            };
        },

        methods: {
            downloadValues() {
                this.$emit("download", [this.indicator]);
            },
            toggleIndicatorSelection() {
                this.$emit("toggle-indicator", this.indicator);
            },
            toggleUnits() {
                this.showStandardUnit = !this.showStandardUnit;
            }

        }
    };
</script>