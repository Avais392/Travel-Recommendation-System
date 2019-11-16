@extends('layouts.master')

@section('title')
    Search Results - Travel Recommendation
@endsection

@section( 'styles' )
    <link rel="stylesheet" href="{{ URL::to( 'src/css/HomeAndSearchResults.css' )  }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css">
@endsection


@section("main-container")
    <div class="container-fluid" id="mainBody" style="background: url('{{ URL::to('src/SearchResultsBackground.jpg')  }}')">
        <header class="text-center">

            <div class="row">
                <div class="col-sm-offset-2 col-sm-8 col-xs-offset-2 col-xs-8 content">
                    <h1>Search Results</h1>

                    <div class="col-sm-12">
                        <hr>
                    </div>

                    <h3 style="margin-bottom: 15px;"><b>Filter search:</b></h3>

                    <div class="col-sm-4 filterBox">
                        <label>Cost:</label>
                        <div id="rangeSlider"></div>
                        <p id="amountWrapper">
                            <b>Amount: </b><span id="amount"></span>
                        </p>
                    </div>

                    <div class="col-sm-4 filterBox">
                        <label>Ratings:</label>
                        <div id="ratingsRangeSlider"></div>
                        <p id="starsWrapper">
                            <b>Stars: </b><span id="stars"></span>
                        </p>
                    </div>

                    <div class="col-sm-4 filterBox">
                        <label><b>Features</b></label><br>

                        <input type="checkbox" value="" checked>Free Wifi <br>

                        <input type="checkbox" value="" >Valet Parking <br>

                        <input type="checkbox" value="" checked>Jacuzzi <br>
                    </div>

                    <div class="col-sm-12">
                        <hr>

                        <div class="panel-group" id="accordion">

                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#destinations">
                                            Destinations</a>
                                    </h4>
                                </div>
                                <div id="destinations" class="panel-collapse collapse in">
                                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                        minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                        commodo consequat.</div>
                                </div>
                            </div>


                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#hotels">
                                            Hotels</a>
                                    </h3>
                                </div>
                                <div id="hotels" class="panel-collapse collapse">
                                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                        minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                        commodo consequat.</div>
                                </div>
                            </div>
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#restaurants">
                                            Restaurants</a>
                                    </h4>
                                </div>
                                <div id="restaurants" class="panel-collapse collapse">
                                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                        minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                        commodo consequat.</div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>


            </div>
        </header>
    </div>

    <br>
    <div class="container" id="secondSection">
        <div class="row">
            <section class="col-sm-12">

            </section>
        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript">

        $(function () {


            //Render range slider of price.
            var minRange = 5000;
            var maxRange = 50000;
            var startMin = 10000;
            var startMax = 45000;

            $( "#rangeSlider" ).slider({
                range: true,
                min: minRange,
                max: maxRange,
                values: [ startMin, startMax ],
                slide: function( event, ui ) {
                    $( "#amount" ).html( "Rs." + ui.values[ 0 ] + " - Rs." + ui.values[ 1 ] );
                }
            });

            $( "#amount" ).html( "Rs." + startMin + " - Rs." + startMax );


            //Render range slider of ratins.

            $( "#ratingsRangeSlider" ).slider({
                range: true,
                min: 1,
                max: 5,
                values: [ 1, 5 ],
                slide: function( event, ui ) {
                    $( "#stars" ).html( ui.values[ 0 ] + " Star - " + ui.values[ 1 ] + " Star" );
                }
            });

            $( "#stars" ).html("1 Star - 5 Star" );


        });

    </script>


@endsection