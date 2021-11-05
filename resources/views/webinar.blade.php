@extends('layouts.app')

@section('main')
<div class="main-container">

    <div class="header">
        <img src="{{ url('images/webinar.jpeg') }}" id="image_webinar_header" class="image_header" />
        <div class="row justify-content-left">
            <div class="col-md-5 col-lg-4 box-green">
                <div class="report-text ml-md-4 mr-5 mt-xl-5">
                    <h2 style="color:black">{{t('Webinar')}}</h2>
                    <p>{{ t('On October 20th 2021, the State of the Smallholder Coffee Farmer held a live webinar and Q&A to
                        launch the open access platform coffeesmallholder.org and accompanying
                        report, State of the Smallholder Coffee Farmer: An Initiative Towards a More Equitable and
                        Democratic Information Landscape.') }}
                    </p>
                </div>
            </div>
            <div id="caption">
                {{ t('Coffee plantation at dusk in Chiapas, México. Credit: Janica Anderzén') }}
            </div>
        </div>
    </div>

    <div class="container px-4 my-5 px-5 py-5">
        <h2 class="mt-5 text-green" {{ t('>Missed the live webinar?') }}</h2>
        <p>{{ t('The full recording (passcode: ahJ0iG$K) and presentation slides are now available.') }}</p>

        <div class="d-flex justify-content-center flex-column flex-sm-row mt-5 mb-5">
            <a href="https://corusinternational-org.zoom.us/rec/share/a9FAKO75o5c2Wp9Eyx5rLAywmTgZ5VJMFCCyd8IO4w1O3xiwcvcWS1pzcfcyMf7F.2-C4Aanayum8dJ-c" target="_blank"><button class="button-green mr-3">
                {{ t('Watch the webinar') }} <i
                    class='las la-arrow-right'></i></button></a>
            <p> </p>
            <a href="docs/State_of_the_Smallholder_Coffee_Farmer_webinar_presentation.pdf" target="_blank"><button class="button-green">
                {{ t('Download presentation') }} <i
                    class='las la-arrow-down'></i></button></a>
        </div>
        <div class="row pt-4">
            <img src="{{ url('images/webinar_graphic.jpg') }}" id="image_webinar"/>
        </div>
        <div class="justify-content-center mt-5 mb-5">
            {{ t('<h2 class="mt-5 text-green">Panelists</h2>
            <ul><strong>Rick Peyser,</strong> Senior Manager for Coffee and Cocoa, Lutheran World Relief</ul>
            <ul><strong>Carlos Barahona,</strong> Managing Director at Statistics for Sustainable Development (Stats4SD)
            </ul>
            <ul><strong>Janica Anderzén,</strong> PhD candidate in Agroecology, Agroecology & Livelihoods Collaborative,
                University of Vermont
            </ul>
            <ul><strong>Ernesto Méndez,</strong> Professor of Agroecology and Co-Director, Agroecology & Livelihoods
                Collaborative (ALC) at University of Vermont
            </ul>
            <ul><strong>Ciara McHugh,</strong> Statistician at Statistics for Sustainable Development (Stats4SD)</ul>
            <ul><strong>Cory Gilman,</strong> Strategic Initiatives Manager: Coffee and Commodities at Heifer
                International
            </ul>') }}
        </div>
    </div>
</div>
@endsection
