<template>
    <b-modal
        id="download-modal"
        :visible="visible"
        size="lg"
        centered
        header-bg-variant="primary"
        header-text-variant="white"
        content-class="rounded-0"
        scrollable
        hide-footer
        header-class="rounded-0 d-flex justify-content-between align-items-center"
        header-close-content="&times;"
        @hidden="$emit('hidden')"
    >
        <template #modal-header>
            <h2 class="mb-0">
                Download Indicators
            </h2>
            <button
                class="btn btn-link text-white"
                @click="close"
            >
                <h2 class="mb-0">
                    &times;
                </h2>
            </button>
        </template>
        <div class="d-flex h-100 p-3">
            <div class="w-50 d-flex flex-column">
                <h3 class="text-center">
                    Selected Indicators<br>
                </h3>
                <small class="text-center">(Scroll for more)</small>
                <div class="overflow-auto flex-grow-1">
                    <b-alert
                        v-for="indicator in indicators"
                        :key="indicator.id"
                        show
                        variant="secondary"
                        dismissible
                        @dismissed="$emit('remove-indicator', indicator)"
                    >
                        {{ indicator.code }}:  {{ indicator.definition }}
                    </b-alert>
                </div>
            </div>
            <div class="w-50">
                <h3 class="text-center">
                    Download Options:
                </h3>
                <div class="d-flex flex-column justify-content-space align-items-center">
                    <div class="w-50 align-self-center d-flex flex-column align-items-center my-4">
                        <b-img
                            src="/images/table-graphic.png"
                            center
                            alt="table image"
                            class="w-75"
                        />
                        <div class="w-100 text-center mb-2">
                            All seclected indicator data in .xlsx format
                        </div>
                        <a
                            href="#"
                            class="btn btn-primary btn-lg"
                            @click="$emit('download-xlsx')"
                        >Download XLSX</a>
                    </div>
                    <div class="w-50 align-self-center d-flex flex-column align-items-center my-4">
                        <b-img
                            src="/images/graph-graphic.png"
                            center
                            class="w-75"
                            alt="graph image"
                        />
                        <div class="w-100 text-center mb-2">
                            Generate a graphical summary of values
                        </div>
                        <a
                            href="#"
                            class="btn btn-primary btn-lg"
                            @click="$emit('download-pdf')"
                        >Download PDF</a>
                    </div>
                </div>
            </div>
        </div>
    </b-modal>
</template>

<script>
    export default {
        props: {
            indicators: {
                type: Array,
                default: () => [],
            },
            visible: Boolean,
        },

        methods: {
            close() {
                this.$bvModal.hide('download-modal');
            },

        }
    }
</script>