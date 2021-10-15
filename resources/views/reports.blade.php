@extends('layouts.app')

@section('main')
<div class="main-container">
    <div class="header mb-5">
        <img src="images/report.jpg" id="image_report" class="image_header" />
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
            <div class="col-md-4 col-lg-5 text-center d-none d-md-block">
            <div class="my-auto">
                <a href="docs/State of the Smallholder Coffee Farmer.pdf" target="_blank"><button class="button-green" id="report_button">View Report <i
                            class='las la-arrow-right'></i></button></a>
            </div>
</div>
            <div id="caption">
                Guatemalan farmer with his coffee plants. Credit: Heifer International/Phillip Davis
            </div>
        </div>
    </div>


    @endsection