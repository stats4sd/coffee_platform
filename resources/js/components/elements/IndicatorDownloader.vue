<template>
    <div class="sticky-top d-flex align-content-end flex-column">
        <a
            id="download-icon"
            href="#"
            class="rounded-circle bg-primary downloader mx-4 mb-0 mt-4 font-weight-bold text-center d-flex align-items-center justify-content-center text-white align-self-end"
            @click="showDownloadOptions"
        >
            <h2 class="p-0 m-0">
                <i class="las la-download" />
            </h2>
        </a>
        <transition name="fade">
            <div
                v-if="displayPopover"
                class="arrow-up mx-4 download-centered custom-overlay align-self-end"
            />
        </transition>
        <div class="custom-overlay align-self-end">
            <transition name="fade">
                <b-card
                    v-if="displayPopover"
                    class="mx-4 mt-arrow border-0"
                    bg-variant="primary"
                    header-bg-variant="primary"
                    text-variant="white"
                    header-text-variant="white"
                >
                    <b>Indicators added to selection</b><br><br>
                    Click for options
                </b-card>
            </transition>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            'indicators': {
                type: Array,
                default: () => [],
            },
            'displayPopover': {
                type: Boolean,
                default: false,
            }
        },

        watch: {
            displayPopover(val) {
                if(val) setTimeout(() => {
                    this.$emit('hide')
                }, 4000);
            }
        },

        methods: {
            showDownloadOptions() {
                this.$emit('show-download-options')
            }
        }

    }
</script>