@extends('layouts.app')

@section('main')
<div class="main-container" style="overflow: visible">
    <div class="header" style="height:400px; overflow: hidden">

        <img src="images/indicator_hub.jpeg" id="image_hub" class="image_header" />
        <div class="row justify-content-end">
            <div class="text-block " style="padding-bottom: 20px; bottom: 80px">
                <h1 class="mb-5 pb-5">Indicator Hub</h1>
                <div id="caption" class="ml-3 ml-lg-5" style="background-color: #00000000;"> Photo credit: <strong>Janica Anderzén 2019</strong> </div>


            </div>

        </div>
        <a class="btn  helpbar" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
            aria-controls="collapseExample">
            <table border="0">
                <tr>
                    <td>
                        <i class="las la-question"></i>
                    </td>
                    <td>
                        <span>&nbsp;How to use the Indicator Hub</span>
                    </td>
                    <td>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;
                    </td>
                    <td>
                        <i class="las la-angle-double-down"></i>
                    </td>
                </tr>
            </table>
        </a>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="card card-body helpbox pb-5">
            <div class="row justify-content-center">
                <div class="col-xl-8 mb-4" style="max-width: 560px;">
                    <div class="videowrapper">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/R5HSmCG1DSA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>    
            <h2>Step 1: What are you looking for?</h2>
            <p class="mb-3">
                There are some different ways to explore the available data:</p>
            <p><strong>Search:</strong> Use the search box below to find indicators by keyword.</p>
            <p><strong>Browse:</strong> Select a category and subcategory to explore by subject.</p>
            <p><strong>Filter:</strong> Narrow down your search using the filter bar on the left to find exactly what
                you want.</p>
            <h2>Step 2: View Indicators</h2>
            <p class="mb-3">
                Scroll down to view the table of available indicators that match the options selected. You have a few
                options:</p>
            <p><strong>Preview:</strong> Quick, simplified view of the indicator data.</p>
            <p><strong>Add to selection:</strong> You can add multiple indicators to your selection as you browse. You
                can later download them all together, rather than one at a time.</p>

            <p><strong>Quick download:</strong> Download data for a single indicator</p>

            <h2>Step 3: Download Data</h2>
            <p>
                Click the download button at the top right to review and download data for all indicators added to your
                selection.</p>



        </div>
    </div>
    <div id="app" class="h-100">
        <indicator-hub></indicator-hub>
    </div>
</div>
@endsection