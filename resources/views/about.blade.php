@extends('layouts.app')

@section('main')
<div class="main-container">
    <div class="header">

        <img src="images/about.jpg" id="image_about" class="image_header" />
        <div class="row justify-content-end">
            <div class="col-md-5 col-lg-4 box-green">
                <div class=" report-text ml-xl-4 mr-2 mr-xl-5 mt-xl-4">
                    <h2 style="color:black">About</h2>
                    <p>The State of the Coffee Smallholder Platform is an open access data resource, bringing together indicator
                    data from a variety of sources into one hub.
                    </p>
                    <p>The platform is designed to drive more informed decision-making amongst smallholder coffee farmers as
                        well as various value chain actors, giving a more holistic picture about the state of coffee smallholders,
                         their livelihoods and the challenges they are facing.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="caption">
        Photo Credit: <strong>Phillip Davis 2019 </strong>
    </div>

    <div class="container px-4 my-5 px-5 py-5">
        <p> Currently a pilot focused on Guatemala, Honduras and Nicaragua, this initiative seeks to remove barriers
            to equitable information sharing— including those structures preventing producers from accessing their
            own data. This interactive site and accompanying <a href="reports" style="color: #66AC47">report</a> are based on
            initial results stemming from extensive review, analysis and synthesis of existing data about
            smallholders in these three countries. The work complements other initiatives. However, instead of
            emphasizing upstream sustainability efforts and goals, this research centers on realities downstream
            to draw a more holistic and inclusive picture of coffee smallholders and their livelihoods. 
        </p>

        <h2 class="mt-5" id="text-green">Partners</h2>
        <p>
            A component of this pilot includes collaborative ways of identifying information gaps and
            envisioning more impactful, yet less burdensome ways, of data collection. Stemming from a
            partnership between Heifer International, Lutheran World Relief, Statistics for Sustainable
            Development and the Agroecology and Livelihoods Collaborative at the University of
            Vermont, the goal is expansion into a larger, more permanent effort with broader industry
            support. Several other organizations have already contributed ideas and/or data.
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