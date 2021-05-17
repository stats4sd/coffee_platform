<template>
    <div class="d-flex flex-wrap justify-content-center">
        <div
            v-for="option in allOptions"
            :key="option.value"
        >
            <b-card
                no-body
                class="select-card dark-gradient m-2"
                border-variant="primary"
                :class="option.value === value ? 'selected' : ''"
                @click="clicked(option.value)"
            >
                <b-card-img
                    :src="option.image"
                />
                <div class="card-caption text-white font-weight-bold">
                    {{ option.text }}
                </div>
            </b-card>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            multiple: {
                type: Boolean,
                default: false,
            },
            options: {
                type: Array,
                default: () => [],
            },
            value: {
                type: Number,
                default: null,
            },
            displayField: {
                type: String,
                default: null,
            },
            valueField: {
                type: String,
                default: null,
            },
        },
        computed: {
            allOptions() {
                if(this.options.length === 0) return [];

                return this.makeOptions();
            }
        },
        methods: {

            clicked(value) {
                if(value === this.value) {
                    value = null
                }
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

                var imageField = this.imageField || null

                if(!imageField) {
                    if(typeof(this.options[0]['cover_image']) !== 'undefined') {
                        imageField = 'cover_image'
                    } else if (typeof(this.options[0]['avatar']) !== 'undefined') {
                        imageField = 'avatar'
                    } else if (typeof(this.options[0]['image']) !== 'undefined') {
                        imageField = 'image'
                    }
                }

                var options = this.options.map((option) => {
                    return {
                        value: option[valueField],
                        text: option[displayField],
                        image: imageField ? option[imageField] : 'https://via.placeholder.com/200x100',
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