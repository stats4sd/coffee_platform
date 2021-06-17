@extends('layouts.app')

@section('main')
<div class="main-container">
    <div class="header">

        <img src="images/about.jpg" id="image_about" class="image_header" />
        <div class="row justify-content-end">
            <div class="col-md-5 col-lg-4 box-green">
            <div class=" report-text ml-xl-4 mr-2 mr-xl-5 mt-xl-4">
                <h2 style="color:black">About</h2>
                <p>The State of the Coffee Smallholder Platform is an open access data resource, designed to drive more
                    informed decision making
                    amongst smallholder coffee farmers as well as various value chain actors.
                </p>
                <p>Indicator data about smallholder farmers in Guatemala, Honduras, and Nicaragua have been collected together from a variety of sources 
                    into one hub. This can be browsed and filtered to allow anyone to explore the information available and find out about various aspects of 
                    the state of the coffee smallholder farmer. 
                </p>
            </div>
</div>
        </div>
    </div>

<div id="caption">
    Photo Credit: <strong>Phillip Davis 2019 </strong>
</div>

<div class="container px-4 my-5 px-5 py-5">

    <p> The platform and the accompanied <a href="reports" style="color: #66AC47">report</a> complement other
        initiatives that – in various ways - seek to gather, synthesize, and analyze social, economic, and/or
        environmental data about coffee smallholders. While many initiatives focus on tracking and documenting coffee
        industry actors’ sustainability efforts, our approach is from the bottom up. Based on the available data, we are
        taking steps toward drawing a more holistic picture about coffee smallholders, their livelihoods, and the
        challenges they are facing. We are also seeking to identify data gaps, and envision how we could improve data
        collection and sharing among a variety of actors along the coffee value chain, including the farmers and their
        organizations.</p>
        <p>The resulting interactive site is based on an extensive review, analysis and synthesis of existing
                    data and information about coffee smallholders
                    in Guatemala, Honduras, and Nicaragua.</p>

    <h2 class="mt-5" id="text-green">Partners</h2>
    <p>
        This project brings together Heifer International, Lutheran World Relief (LWR), Statistics for Sustainable
        Development (Stats4SD), and the Agroecology and Livelihoods Collaborative (ALC) at the University of Vermont
        (UVM).
    </p>
    <div id="app">
        <template>
            <div class='partners-logos text-center mt-5'>
                <b-row class="justify-content-center">
                    <b-col>
                        <b-img height="100" src="images/partners/Heifer.jpg" alt="Heifer"></b-img>
                    </b-col>
                    <b-col>
                        <b-img height="100" src="images/partners/LWR.png" alt="LWR"></b-img>
                    </b-col>
                </b-row>
                <b-row class="justify-content-center">
                    <b-col class="mt-5">
                        <b-img height="35" src="images/partners/Stats4SD_Logo_Red_Small.jpg" alt="Stats4SD"></b-img>
                    </b-col>
                    <b-col>
                        <b-img height="100" src="images/partners/UVM.jpg" alt="UVM"></b-img>
                    </b-col>
                </b-row>
            </div>
        </template>
    </div>
</div>
</div>
@endsection