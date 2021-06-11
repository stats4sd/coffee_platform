@extends('layouts.app')

@section('main')
<div class="header">
    <div> 
        <img src="images/about.jpg" id="image_about"/>
        <div id="caption">
            Photo Credit: Phillip Davis 2019
        </div>
    </div>
</div>

<div class="container">
    <h2 style="color:black">About</h2>
    <p>The State of the Coffee Smallholder Platform is an open access data resource, designed to drive more informed decision making
        amongst smallholder coffee farmers as well as various value chain actors.
    </p>
    <p> The resulting interactive site is based on an extensive review, analysis and synthesis of existing data and information about coffee smallholders
        in Guatemala, Honduras, and Nicaragua.
    </p>
    <p> The platform and the accompanied <a href="reports" style="color: #66AC47">report</a> complement other initiatives that – in various ways - seek to gather, synthesize, and analyze social, economic, and/or environmental data about coffee smallholders. While many initiatives focus on tracking and documenting coffee industry actors’ sustainability efforts, our approach is from the bottom up. Based on the available data, we are taking steps toward drawing a more holistic picture about coffee smallholders, their livelihoods, and the challenges they are facing. We are also seeking to identify data gaps, and vision how we could improve data collection and sharing among a variety of actors along the coffee value chain, including the farmers and their organizations.

     <h2 id="text-green">Partners</h2>
    <p>
        This project brings together Heifer International, Lutheran World Relief (LWR), Statistics for Sustainable Development (Stats4SD), and the Agroecology and Livelihoods Collaborative (ALC) at the University of Vermont (UVM).
    </p>
    <div id="app">
    <template>
        <div>
            <!-- <b-row>
                <b-col><b-img  height="100" src="images/partners/UVM.jpg"  alt="UVM"></b-img></b-col>
                <b-col class="mt-5"><b-img  height="45" src="images/partners/Stats4SD_Logo_Red_Small.jpg" alt="Stats4SD"></b-img></b-col>
                <b-col><b-img  height="100" src="images/partners/LWR.png" alt="LWR"></b-img></b-col>
                <b-col><b-img  height="100" src="images/partners/Heifer.jpg" alt="Heifer"></b-img></b-col>
            </b-row> -->
            <b-row>
            <b-col><b-img  height="100" src="images/partners/Heifer.jpg" alt="Heifer"></b-img></b-col>
            <b-col><b-img  height="100" src="images/partners/LWR.png" alt="LWR"></b-img></b-col>
            </b-row>
            <b-row>
            <b-col class="mt-5"><b-img  height="45" src="images/partners/Stats4SD_Logo_Red_Small.jpg" alt="Stats4SD"></b-img></b-col>
            <b-col><b-img  height="100" src="images/partners/UVM.jpg"  alt="UVM"></b-img></b-col>
            </b-row>
        </div>
        </template>
    </div>
</div>

@endsection
