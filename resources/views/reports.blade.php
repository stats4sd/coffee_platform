@extends('layouts.app')

@section('main')

<div class="header">
        <img src="images/report.jpg" id="image_report"/>
        <div id="caption">
            Photo Credit: Phillip Davis 2020
        </div>
        <div class="container px-4">
            <div class="row">
                <div class="col-lg-6">
                    <h2 style="color:black">Reports</h2>
                    <p>Alongside the platform, the project has produced a report, describing the data collection
                        process and key findings in detail.
                    </p>
                    <p>In this report, you can also read more about our efforts to identify data gaps and envision how we could imporve
                        data collection and sharing among a variety of actors along the coffee value chain, including the farmers and
                        their organizatins.
                    </p>
                </div>
                <div>
                    <button href="partners" class="button-green" id="about_button">Download 2021 Report
                    <!-- <i class="fa fa-long-arrow-right" style="font-size:24px"></i></a> -->
                    </button>
                </div>
            </div>    
        </div>
    </div>
</div>

<div class="container px-4">
            <h2 id="text-green">Previous Reports</h2>
            <p>Here we could add donwload links to older reports...</p>
        </div>
</div>

<!-- <div class="container-fluid justify-content-center">
    <div class="container" id="report-head">
        <div class="container px-4">
            <div class="row">
                <div class="col-lg-6">
                    <h2 style="color:black">Report</h2>
                    <div class="mb-3">
                        <p>Alongside the platform, the project has produced a report, describing the data collection
                             process and key findings in detail.
                        </p>
                        <p>In this report, you can also read more about our efforts to identify data gaps and envision how we could imporve
                            data collection and sharing among a variety of actors along the coffee value chain, including the farmers and
                            their organizatins.
                        </p>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-5 mb-5">
                    <button href="partners" class="button-green" id="about_button">Download 2021 Report
                    <!-- <i class="fa fa-long-arrow-right" style="font-size:24px"></i></a> -->
                    <!-- </button>
                </div> 
            </div>
        </div>
    </div>
    <div> 
        <h2 id="text-green">All Reports</h2>
    </div>
</div> -->








@endsection
