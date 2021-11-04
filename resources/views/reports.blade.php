@extends('layouts.app')

@section('main')
<div class="main-container">
    <div class="header mb-5">
        <img src="{{ url('images/report.jpg') }}" id="image_report" class="image_header" />
        <div class="row justify-contents-left">
            <div class="col-md-5 col-lg-4 box-green">
                <div class=" report-text ml-md-4 mr-5 mt-xl-4">

                    <h2 style="color:black">Report</h2>
                    <p>Alongside the platform, a report has been produced, describing the key findings and data collection process in detail.
                    </p>
                    <p>In this report, you can also read more about our efforts to identify data gaps and envision how
                        we could improve
                        data collection and sharing among a variety of actors along the coffee value chain, including
                        the farmers and
                        their organizations.
                    </p>
                </div>
            </div>
            <div id="caption">
                Guatemalan farmer with his coffee plants. Credit: Heifer International/Phillip Davis
            </div>
        </div>
    </div>
    <div class="container px-4 my-5 px-5 py-5">
        <h2 class="mt-5 text-green">Download the report</h2>
        <p> The report is currently available to download in English and will be released in Spanish soon.</p>
            <div class="d-flex justify-content-left mt-5 mb-5">
                <a href="docs/State of the Smallholder Coffee Farmer.pdf" target="_blank"><button class="button-green">Download in English <i
                    class='las la-arrow-down'></i></button></a>
            </div>
    </div>
</div>


    @endsection
