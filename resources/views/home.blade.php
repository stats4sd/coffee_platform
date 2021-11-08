@extends('layouts.app')

@section('main')
        <div class="main-container">
    <div class="header mb-5">
        <img src="{{ url('images/home.jpg') }}" id="image_home_header" class="image_header"/>
        <div class ="text-block">
            <h1 class="mb-5">{{t('Connecting the data dots')}}</h1>
            <p class="d-none d-md-block">{{ t('Explore indicators and data visualizations about the economic,
                environmental, and social characteristics and implications of smallholder coffee farming in
                Guatemala, Honduras and Nicaragua.') }}
            </p>
            <div class="d-flex justify-content-center mt-5 mb-5">
                <a href="indicators"><button class="button-green">{{ t('Browse Indicators') }} <i class='las la-arrow-right'></i></button></a>
            </div>
        </div>
        <div id="caption">
            {{ t(' Farmer holding freshly picked coffee berries in Guatemala. Credit: Heifer International/Phillip Davis') }}
        </div>
    </div>


    <div class="container my-5 px-5 py-5">
            <h2 class="text-green mt-5 mt-sm-1">{{ t('What is it?') }}</h2>
        {!! t('<p>The State of the Smallholder Coffee Farmer is an open access data resource, designed to drive more informed,
        inclusive, and democratic decision making across the value chain.
    </p>
        <p>This interactive site brings together indicator data from a variety of sources, which can be used to draw a
            more holistic picture of smallholder coffee livelihoods, challenges and outcomes.
            These are available to explore and download from the <a href="indicators" style="color: #66AC47">Indicator
                Hub.</a>
        </p>') !!}
            <div class="d-flex justify-content-center mt-5 mb-5 pb-5">
            <a href="about"><button class="button-green">{{ t('Find Out More') }} <i class='las la-arrow-right'></i></button></a>
            </div>

        <div class="row">
            <div class="mt-lg-5 pt-lg-5 col-lg-6">
                <h2 class="text-green">{{ t('Report') }}</h2>
                <p>{{ t('Alongside the platform, a report describes key findings and the data collection process in detail.') }}
                </p>
                <div class="d-flex justify-content-center mt-5 mb-5">
                    <a href="reports"><button class="button-green">{{ t('View the Report') }} <i class='las la-arrow-right'></i></button></a>
                </div>
            </div>
            <div class="col-lg-6 mb-5">
                <img src="{{ url('images/home_report.jpg') }}" id="image_home_report"/>
                <div id="caption_small">
                    {{ t('Guatemalan farmer holding freshly picked coffee berries. Credit: Heifer International/Phillip
                    Davis') }}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
