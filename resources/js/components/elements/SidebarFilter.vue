<template>
    <li class="list-group-item p-0">
        <b-button
            v-b-toggle="'collapse-'+slug"
            variant="white"
            class="btn-flush d-flex justify-content-between align-items-center w-100 px-4 py-4"
        >
            <div>{{ title }}</div>
            <i class="las la-plus" />
        </b-button>
        <b-collapse
            :id="'collapse-'+slug"
            class="bg-light"
        >
            <b-checkbox-group
                :options="options"
                stacked
                class="px-4 py-2 padded-checkbox-group"
                @change="updateValue"
            />
        </b-collapse>
    </li>
</template>

<script>
    export default {
        props: {
            title: {
                type: String,
                default: 'Filter List',
            },
            options: {
                type: Array,
                default: () => [],
            },
        },
        computed: {
            // to account for possible spaces in the title
            slug() {
                return this.title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g,'')
            },
        },
        methods: {
            updateValue(value) {
                this.$emit('input', value)
            }

        }

    }
</script>