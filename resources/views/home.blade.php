@extends('layouts.app')

@section('main')
        <div class="main-container">
    <div class="header mb-5">
        <img src="images/home.jpg" id="image_home_header" class="image_header"/>
        <div class ="text-block">
            <h1 class="mb-5">Open access data for decision-making</h1>
            
            <h2 class="mb-3 ">Get to know the coffee smallholder.</h2>
            <p class="d-none d-md-block">Explore and download indicator data about smallholder coffee farmers in Guatemala, Honduras and
                Nicaragua.
            </p>
            <div class="d-flex justify-content-center mt-5 mb-5">
                <a href="indicators"><button class="button-green">Browse Indicators <i class='las la-arrow-right'></i></button></a>
            </div>
        </div>
        <div id="caption">
            Farmer holding freshly picked coffee berries in Guatemala. Credit: Heifer International/Phillip Davis
        </div>
    </div>


    <div class="container my-5 px-5 py-5">
            <h2 class="text-green mt-5 mt-sm-1">What is it?</h2>
            <p>The State of the Smallholder Coffee Farmer Platform is an open access data resource, designed to drive more informed decision making
                 amongst smallholder coffee farmers as well as various value chain actors.
            </p>
            <p>This interactive site brings together indicator data from a variety of sources, which can be used to draw a
                more holistic picture about coffee smallholders, their livelihoods, and the challenges they are facing.
                These are available to explore and download from the <a href="indicators" style="color: #66AC47">Indicator Hub.</a>
            </p>
            <div class="d-flex justify-content-center mt-5 mb-5 pb-5">
            <a href="about"><button class="button-green">Find Out More <i class='las la-arrow-right'></i></button></a>
            </div>             

        <div class="row">
            <div class="mt-lg-5 pt-lg-5 col-lg-6">
                <h2 class="text-green">Report</h2>
                <p>Alongside the platform, a report has been produced, describing the key findings and data collection process in detail.
                </p>
                <p>In this report, read about the effort to identify data gaps and how data collection could be improved and
                    shared among a variety of actors along the coffee value chain, including the farmers and their organizations.
                </p>
                <div class="d-flex justify-content-center mt-5 mb-5">
                    <a href="reports"><button class="button-green">View the Report <i class='las la-arrow-right'></i></button></a>
                </div>
            </div>
            <div class="col-lg-6 mb-5">
                <img src="images/home_report.jpg" id="image_home_report"/>
                <div id="caption_small">
                    Guatemalan farmer holding freshly picked coffee berries. Credit: Heifer International/Phillip Davis
                </div>
            </div>            
        </div>
    </div>

</div>
@endsection