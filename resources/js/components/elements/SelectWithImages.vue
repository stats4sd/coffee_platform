<template>
    <div class="d-flex flex-wrap justify-content-center">
        <image-option
            v-for="option in options"
            :key="option.id"
        >
            <b-card
                no-body
                class="select-card dark-gradient m-2"
                border-variant="primary"
                :class="option.id === value ? 'selected' : ''"
                @click="$emit('input', option.id)"
            >
                <b-card-img
                    :src="option.image"
                />
                <div class="card-caption text-white font-weight-bold">
                    {{ option.label }}
                </div>
            </b-card>
        </image-option>
    </div>
</template>
<script>
    export default {
        props: {
            'multiple': {
                type: Boolean,
                default: false,
            },
            'options': {
                type: Array,
                default: () => [],
            },
            'value': {
                type: Number,
                default: null,
            },
        },
    }
</script>