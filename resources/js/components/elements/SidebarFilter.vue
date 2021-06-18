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
                :options="allOptions"
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
            displayField: {
                type: String,
                default: null
            },
            valueField: {
                type: String,
                default: null,
            },
        },
        computed: {
            // to account for possible spaces in the title
            slug() {
                return this.title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g,'')
            },
            allOptions() {
                if(this.options.length === 0) return [];

                return this.makeOptions();
            }
        },
        methods: {
            updateValue(value) {
                this.$emit('input', value)
            },

            makeOptions() {
                var displayField = this.displayField || null

                console.log('options', this.options[0])
                // if display field is not explicitly set, make some sensible guesses:
                if(!displayField) {
                    if(typeof(this.options[0]['name']) !== 'undefined') {
                        displayField = 'name'
                    } else if (typeof(this.options[0]['label']) !== 'undefined') {
                        displayField = 'label'
                    } else if (typeof(this.options[0]['code']) !== 'undefined') {
                        displayField = 'code'
                    } else {
                        console.log(`## WARNING: No display Field has been found. Sidebar filter with title ${this.title} may not display correctly`)
                    }
                }

                var valueField = this.valueField || null

                if(!valueField) {
                    if(typeof(this.options[0]['id']) !== 'undefined') {
                        valueField = 'id'
                    } else if (typeof(this.options[0]['code']) !== 'undefined') {
                        valueField = 'code'
                    } else {
                        console.log(`## WARNING: No value Field has been found. Sidebar filter with title ${this.title} may not function correctly`)
                    }
                }

                var options = this.options.map((option) => {
                    return {
                        value: option[valueField],
                        text: option[displayField],
                    }
                })

                if(this.numericsort) {
                    options.sort((a,b) => a.text-b.text)
                } else {
                    options.sort((a,b) => (a.text > b.text) ? 1 : -1)
                }

                return options


            }

        }

    }
</script>