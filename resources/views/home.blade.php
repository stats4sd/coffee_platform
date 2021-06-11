@extends('layouts.app')

@section('main')
        
    <div class="header">
        <img src="images/home.jpg" id="image_home_header"/>
        <div class ="text-block">
            <h1>Coffee Smallholder Data</h1>
            <p>Open access data for decision-making</p>
            <p>Explore and download indicator data about smallholder coffee farmers in Guatemala, Honduras and
                Nicaragua.
            </p>
            <div class="d-flex justify-content-center mt-5 mb-5">
                <a href="indicators"><button class="button-green">Browse Indicators <i class='las la-arrow-right'></i></button></a>
            </div>
        </div>
        <div id="caption">
            Photo Credit: Phillip Davis 2020
        </div>
    </div>


    <div class="container px-4">
        <div class="row">
            <h2 id="text-green">What is it?</h2>
            <p>The State of the Coffee Smallholder Platform is an open access data resource, designed to drive more informed decision making
                 amongst smallholder coffee farmers as well as various value chain actors.
            </p>
            <p>This platform collects together indicator data from numerous soures, which can be used to draw a
                more holistic picutre about coffee smallholders, their livlihoods, and the challenges they are facing.
                These are available to browse and download from the <a href="indicators" style="color: #66AC47">Indicator Hub.</a>
            </p>
            <div class="d-flex justify-content-center mt-5 mb-5">
            <a href="partners"><button class="button-green">Find Out More <i class='las la-arrow-right'></i></button></a>
            </div>             
        </div>
        <div class="row">
            <div class="col-6">
                <h2 id="text-green">Report</h2>
                <p>Alongside the platform, a report has been produced, describing the data collection process and
                    the key findings in detail.
                </p>
                <p>In this report, read about the effort to identify data gaps and how data collection could be improved and
                    shared among a variety of actors along the coffee value chain, including the farmers and their organizations.
                </p>
                <div class="d-flex justify-content-center mt-5 mb-5">
                    <a href="reports"><button class="button-green">View the Report <i class='las la-arrow-right'></i></button></a>
                </div>
            </div>
            <div class="col-6">
                <img src="images/home_report.jpg" id="image_home_report"/>
                <div id="caption_small">
                    Photo Credit: Phillip Davis 2020
                </div>
            </div>            
        </div>
    </div>


@endsection