@extends('layouts.master')

@section('title')
    Destination - Travel Recommendation
@endsection

@section( 'styles' )
    <link rel="stylesheet" href="{{ URL::to( 'src/css/Destination.css' )  }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css">
@endsection


@section("main-container")
    <div class="container-fluid" id="destinationHeader" style="background: url('{{ URL::to('src/covers/Moonrise_over_kuala_lumpur.jpg')  }}')">
        <header class="text-center">

            <div class="row">
                <div class="col-sm-offset-2 col-sm-8 col-xs-offset-2 col-xs-8 destination-text">
                    <h1>{{ $destination->name  }}</h1>
                    <span class="text-muted">
                    {{ $destination->description  }}
                    </span>

                    <hr>

                    <!--
                    <button class="btn btn-primary">Like</button>
                    <button class="btn btn-primary">Review & Rate</button>
                    -->
                </div>

            </div>
        </header>
    </div>

    <br>
    <div class="container" id="secondSection">
        <div class="row">
            <section class="col-sm-3 leftSideOfSecondSection">
                <div id="locationDiv">
                    <iframe class="img-thumbnail" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d254965.6288807132!2d101.59908270019595!3d3.1374681524955457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc362abd08e7d3%3A0x232e1ff540d86c99!2sKuala+Lumpur%2C+Federal+Territory+of+Kuala+Lumpur%2C+Malaysia!5e0!3m2!1sen!2s!4v1520144099191" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>

                <!--
                <div id="filters">
                    <h4 class="text-center"><b>Filters:</b></h4>

                    <label>Cost:</label>
                    <div id="rangeSlider"></div>
                    <p id="amountWrapper">
                        <b>Amount: </b><span id="amount"></span>
                    </p>

                    <hr>

                    <label>Ratings:</label>
                    <div id="ratingsRangeSlider"></div>
                    <p id="starsWrapper">
                        <b>Stars: </b><span id="stars"></span>
                    </p>

                    <hr>

                    <label><b>Features</b></label><br>

                    <input type="checkbox" value="" checked>Free Wifi <br>

                    <input type="checkbox" value="" >Valet Parking <br>

                    <input type="checkbox" value="" checked>Jacuzzi <br>




                </div>
                -->
            </section>

            <section class="col-sm-9">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#hotels_and_restaurants">Hotels and restaurants</a></li>
                    <li><a data-toggle="tab" href="#attractions">Attractions</a></li>
                    <li><a data-toggle="tab" href="#travel-information">Travel Information</a></li>
                    <!--<li><a data-toggle="tab" href="#reviews">Reviews</a></li>-->
                </ul>

                <div class="tab-content">
                    <div id="hotels_and_restaurants" class="tab-pane fade in active">
                        <h3>Hotels and restaurants</h3>

                        <section>

                            @foreach ( $destination->hotelsOrRestaurants as $hotelsOrRestaurant )
                                <div class="row hotelRow">
                                    <div class="col-sm-3">
                                        <img src="{{ URL::to( $hotelsOrRestaurant->pic )  }}" class="img-thumbnail">
                                    </div>

                                    <div class="col-sm-9">
                                        <h4><b><a href="{{ route( 'HotelController_pageLoad', [ 'id' => $hotelsOrRestaurant->id ] )  }}">{{ $hotelsOrRestaurant->name  }}</a></b></h4>
                                        <p class="text-muted">{{ $hotelsOrRestaurant->type  }}</p>
                                        @if ( $hotelsOrRestaurant->type == "Hotel" )
                                            <h4><b>Rent Per Day: </b>PKR {{ $hotelsOrRestaurant->rentPerDay  }}</h4>
                                        @endif

                                        <br>

                                        <?php
                                        $k = 0;
                                        ?>
                                        @for ( ; $k < round($hotelsOrRestaurant->rating) ; $k++ )
                                            <span class="fa fa-star checked"></span>
                                        @endfor
                                        @for ( $j = 0 ; $j < ( 5 - $k ); $j++ )
                                            <span class="fa fa-star"></span>
                                        @endfor

                                    </div>

                                </div>
                            @endforeach


                        </section>
                    </div>


                    <div id="attractions" class="tab-pane fade">
                        <h3>Attractions</h3>

                        @foreach ( $destination->attractions as $attraction )
                            <div class="row attractionRow">
                                <div class="col-sm-3">
                                    <img src="{{ URL::to( $attraction->image[0]->path )  }}" class="img-thumbnail">
                                </div>

                                <div class="col-sm-9">
                                    <h4><b class="text-info">{{ $attraction->name  }}</b></h4>
                                    <p class="text-muted">Description: &nbsp;
                                        {{ $attraction->decription }}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div id="travel-information" class="tab-pane fade">
                        @foreach ( $destination->travelInformations as $information )
                            <h3>{{ $information->title  }}: </h3>
                            <h5 class="text-muted">{{ $information->travelType->name  }}</h5>
                            <p class="">Description: &nbsp;
                                {{ $information->description  }}
                            </p>
                            <hr>
                        @endforeach
                    </div>
                    <!--
                    <div id="reviews" class="tab-pane fade">
                        <h3>Reviews: </h3>
                        <div>
                            <h5 class="text-muted">Posted by <a href="#">User ABC</a> on 3 March 2018 at 2:07 PM</h5>
                            <p>
                                The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.
                                Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form,
                                accompanied by English versions from the 1914 translation by H. Rackham.
                            </p>
                        </div>
                        <hr>

                        <div>
                            <h5 class="text-muted">Posted by <a href="#">User ABC</a> on 3 March 2018 at 2:07 PM</h5>
                            <p>
                                The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.
                                Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form,
                                accompanied by English versions from the 1914 translation by H. Rackham.
                            </p>
                        </div>
                        <hr>

                    </div>
                    -->
                </div>
            </section>
        </div>
    </div>
@endsection

@section('scripts')
    <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous">
    </script>

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