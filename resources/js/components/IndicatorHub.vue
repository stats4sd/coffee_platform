<template>
    <div class="d-md-flex d-block">
        <indicator-sidebar
            class="full-height sidebar shadow"
        >
            <div class="sidebar-header bg-primary p-2 pl-4 mb-0 text-white">
                <h2>Filters <span class="sidebar-icon"><i class="las la-filter" /></span></h2>
            </div>
            <div class="d-flex flex-column">
                <ul class="list-group">
                    <li class="list-group-item">
                        Indicator Tags
                    </li>
                    <li class="list-group-item">
                        Country
                    </li>
                    <li class="list-group-item">
                        Period
                    </li>
                    <li class="list-group-item">
                        Source Type
                    </li>
                    <li class="list-group-item">
                        Scope
                    </li>
                    <li class="list-group-item">
                        Purpose
                    </li>
                </ul>
            </div>
        </indicator-sidebar>
        <div>
            <indicator-main class="flex-grow-1 p-4 bg-white">
                <div class="row" />
                <h1>Search or Browse Indicators</h1>
                <b-input-group class="mb-3">
                    <template #append>
                        <b-input-group-text><i class="las la-search" /></b-input-group-text>
                    </template>
                    <b-form-input placeholder="Search for indicators" />
                </b-input-group>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos sed vitae fugit quas facilis, dolore cupiditate, quia voluptatum dolorum amet excepturi, consectetur omnis? Neque labore inventore tempore voluptas, nostrum non!</p>
                <characteristics>
                    <div class="d-flex flex-wrap">
                        <b-card
                            no-body
                            class="select-card dark-gradient"
                            border-variant="primary"
                        >
                            <b-card-img
                                src="https://loremflickr.com/200/100"
                            />
                            <div class="card-caption text-white font-weight-bold">
                                Key Characteristics
                            </div>
                        </b-card>
                    </div>
                </characteristics>
                <sub-characteristics>
                    <h2>Subcharacteristics</h2>
                    <div class="d-flex flex-wrap">
                        <b-button variant="primary">
                            Household demographics
                        </b-button>
                        <b-button variant="primary">
                            Farm charactersistics
                        </b-button>
                        <b-button variant="primary">
                            Another subcategory
                        </b-button>
                        <b-button variant="primary">
                            And another one
                        </b-button>
                    </div>
                </sub-characteristics>
            </indicator-main>
            <results-section>
                <div class="mt-4">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, error rerum quas repellendus magnam sapiente maiores dolorem facilis voluptatibus natus perspiciatis tempore blanditiis obcaecati praesentium non fugit harum distinctio dolores.
                </div>
            </results-section>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
