@extends('layouts.app')

@section('main')
<div class="main-container">
    <div class="header">

        <img src="images/about.jpg" id="image_about" class="image_header" />
        <div class="row justify-content-end">
            <div class="col-md-5 col-lg-4 box-green">
                <div class=" report-text ml-xl-4 mr-2 mr-xl-5 mt-xl-2">
                    <h2 style="color:black">About</h2>
                    <p>The State of the Smallholder Coffee Farmer is an open access resource, connecting indicator data about
                        smallholder coffee farmers – particularly the economic, social and environmental characteristics of farmer
                        households and their livelihoods.
                    </p>
                    <p>With an explicit emphasis on producers, this initial pilot seeks to draw a more holistic picture of many
                        realities of coffee smallholders, their livelihoods, and challenges. Ultimately, the
                        initiative attempts to remove barriers to equitable information sharing, including those structures preventing
                        producers from accessing data about themselves and their farms.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="caption">
        Nicaraguan farmer with her coffee plants. Credit: Heifer International/Phillip Davis
    </div>

    <div class="container px-4 my-5 px-5 py-5">
        <p> This interactive site and accompanying <a href="reports" style="color: #66AC47">report</a>
            are based on initial results stemming from extensive review, analysis and synthesis of existing
            data about coffee smallholders in Guatemala, Honduras and Nicaragua, with the goal of expanding
            into a larger, more permanent effort with broader industry support.
        </p>

        <h2 class="mt-5 text-green">Partners</h2>
        <p>
            This pilot stems from a partnership between Heifer International, Lutheran World Relief, the Agroecology and
            Livelihoods Collaborative at the University of Vermont and Statistics for Sustainable Development (Stats4SD).
            As a component of this pilot includes collaborative ways of identifying information gaps and envisioning
            more impactful (yet less burdensome) ways of data collection, several other organizations have already
            contributed ideas and/or data.
        </p>
        <div id="app">
            <template>
                <div class='partners-logos text-center mt-5'>
                    <b-row class="justify-content-center">
                        <b-col>
                            <a href="https://www.heifer.org/" target="_blank">
                            <b-img height="100" src="images/partners/Heifer.jpg" alt="Heifer"></b-img></a>
                        </b-col>
                        <b-col>
                            <a href="https://lwr.org/" target="_blank">
                            <b-img height="100" src="images/partners/LWR.png" alt="LWR"></b-img></a>
                        </b-col>
                    </b-row>
                    <b-row class="justify-content-center">
                        <b-col class="mt-3">
                            <a href="https://www.uvm.edu/agroecology/" target="_blank">
                            <b-img height="100" src="images/partners/UVM.jpg" alt="UVM"></b-img></a>
                        </b-col>
                        <b-col class="mt-5">
                            <a href="https://stats4sd.org/" target="_blank">
                            <b-img height="35" src="images/partners/Stats4SD_Logo_Red_Small.jpg" alt="Stats4SD"></b-img></a>
                        </b-col>
                    </b-row>
                </div>
            </template>
        </div>
        <br>
        <h2 class="mt-5 text-green">Contact Us</h2>
        <p>
            If you would like to get in contact with us please email <a href="mailto:coffee@stats4sd.org" style="color: #66AC47">coffee@stats4sd.org</a>
        </p>
    </div>
</div>
@endsection