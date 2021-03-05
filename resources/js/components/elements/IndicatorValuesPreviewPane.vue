<template>
    <b-modal
        :id="id"
        centered
        size="lg"
        title="Indicator Values"
    >
        <b-table
            :items="values"
            :fields="fields"
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
                default: 'valuepreview'
            }
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