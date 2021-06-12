@extends('layouts.app')

@section('main')

<div class="header">
    <img src="images/report.jpg" id="image_report"/>
    <div class="box-green">
        <div class="container report-text ">
            
            <h2 style="color:black">Reports</h2>
            <p>Alongside the platform, the project has produced a report, describing the data collection
                process and key findings in detail.
            </p>
            <p>In this report, you can also read more about our efforts to identify data gaps and envision how we could imporve
                data collection and sharing among a variety of actors along the coffee value chain, including the farmers and
                their organizatins.
            </p>
        </div>   
    </div>
    <div class="d-flex justify-content-center">
        <a href="reports"><button class="button-green" id="report_button">Download 2021 Report <i class='las la-arrow-down'></i></button></a>
    </div>
    <div id="caption">
        Photo Credit: Phillip Davis 2020
    </div>
</div>


@endsection
