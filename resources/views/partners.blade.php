@extends('layouts.app')

@section('main')
<div class="container mt-5">
    <h1>Partners</h1>
    <p>
        This project brings together the Agroecology and Livelihoods Collaborative (ALC) at the University of Vermont (UVM), Statistics for Sustainable Development (Stats4SD), Lutheran World Relief (LWR), and Heifer International.
    </p>
    <div id="app">
    <template>
        <div>
            <b-row>
                <b-col><b-img  height="100" src="images/partners/UVM.jpg"  alt="UVM"></b-img></b-col>
                <b-col class="mt-5"><b-img  height="45" src="images/partners/Stats4SD_Logo_Red_Small.jpg" alt="Stats4SD"></b-img></b-col>
                <b-col><b-img  height="100" src="images/partners/LWR.png" alt="LWR"></b-img></b-col>
                <b-col><b-img  height="100" src="images/partners/Heifer.jpg" alt="Heifer"></b-img></b-col>
            </b-row>
        </div>
        </template>
    </div>
</div>
@endsection
