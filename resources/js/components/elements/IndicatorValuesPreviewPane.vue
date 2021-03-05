<template>
    <b-modal
        :id="id"
        centered
        size="xl"
        title="Indicator Values"
        header-bg-variant="primary"
        header-text-variant="light"
    >
        <template #modal-title>
            <h2 class="font-weight-bold">
                Indicator Values Preview
            </h2>
        </template>

        <h3
            v-if="indicator"
            class="py-4"
        >
            {{ indicator.code + ' - ' + indicator.definition }}
        </h3>
        <b-table
            class="mt-4 mb-2"
            :items="values"
            :fields="fields"
            sticky-header
            thead-class="bg-light open-top"
        />
    </b-modal>
</template>

<script>
    export default {
        props: {
            values: {
                type: Array,
                default: () => [],
            },
            id: {
                type: String,
                default: 'valuepreview',
            },
            indicator: {
                type: Object,
                default: null,
            },
        },
        data() {
            return {
                fields: [
                    {
                        key: 'geo_boundary.country.name',
                        label: 'Country',
                    },
                    'year',
                    'value',
                    {
                        key: 'unit.unit',
                        label: 'Unit'
                    },
                    'scope',
                ]
            }
        }

    }
</script>