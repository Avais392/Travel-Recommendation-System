@extends('layouts.master')

@section('title')
    Hotel - Travel Recommendation
@endsection

@section( 'styles' )
    <link rel="stylesheet" href="{{ URL::to( 'src/css/Hotel.css' )  }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection


@section("main-container")
    <div class="container-fluid" id="hotelTitle" style="background: url('{{ URL::to('src/hotels_and_restaurants/Impiana_KLCC_Hotel.jpg')  }}')">
        <header>

            <div class="row">
                <div class="col-sm-offset-2 col-sm-8 col-xs-offset-1 col-xs-10 hotelTileStuff">

                    @if ( Session::has( 'successMessage' ) )
                        <h5 class="alert alert-success">
                            <a href="#" data-dismiss="alert" class="pull-right">&times;</a>
                            {{ Session::get( 'successMessage' )  }}
                        </h5>
                    @endif

                    @if ( count( $errors ) > 0 )
                        <h4 class="alert alert-danger">
                            <a href="#" data-dismiss="alert" class="pull-right">&times;</a>
                            @foreach ( $errors->all() as $error )
                                {{ $error }}
                                <br>
                            @endforeach
                        </h4>
                    @endif

                    <div class="row text-center">
                        <div class="col-xs-4" id="hotelImage">
                            <img src="{{ URL::to( $hotelOrRest->pic )  }}" class="img-thumbnail img-rounded">

                            <?php
                            $k = 0;
                            ?>
                            @for ( ; $k < round($hotelOrRest->rating) ; $k++ )
                                <span class="fa fa-star checked"></span>
                            @endfor
                            @for ( $j = 0 ; $j < ( 5 - $k ); $j++ )
                                <span class="fa fa-star"></span>
                            @endfor

                        </div>

                        <div class="col-xs-8 text-center">
                            <h1>{{ $hotelOrRest->name  }}</h1>

                            <div class="text-muted">
                                <p>
                                    <label>Phone No. </label>{{ $hotelOrRest->phone  }}
                                </p>
                                <p>
                                    <label>Fax: </label> 111-222-333
                                </p>
                                <p>
                                    <label>Email: </label>{{ $hotelOrRest->email  }}
                                </p>
                                <p>
                                    <label>Website:</label> <a href="{{ $hotelOrRest->website }}" class="btn btn-info btn-sm ">Visit website</a>
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="text-center">
                        <hr>
                        <a href="#userRating" class="btn btn-primary" id="rateButton">Rate</a>
                        <a href="#dealsAndOffers" class="btn btn-primary" id="detailsButton">See details and other details</a>
                    </div>
                </div>

            </div>
        </header>
    </div>

    <br>
    <div class="container" id="secondSection">

        <div id="locationDiv" class="col-sm-6">
            <iframe class="img-thumbnail img-rounded" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d254965.6288807132!2d101.59908270019595!3d3.1374681524955457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc362abd08e7d3%3A0x232e1ff540d86c99!2sKuala+Lumpur%2C+Federal+Territory+of+Kuala+Lumpur%2C+Malaysia!5e0!3m2!1sen!2s!4v1520144099191" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>


        <div class="col-sm-6" id="featuresDiv">
            <h3 class="">Features</h3>

            @foreach ( $hotelOrRest->features as $feature )
            <div>
                <span class="glyphicon glyphicon-check"></span>&nbsp;
                {{ $feature->feature->name  }}
            </div>
            @endforeach
        </div>


        <div id="ratingsDiv" class="col-sm-12">
            <h4 class="text-center"><b>Ratings:</b></h4>
            <?php $starsData = $hotelOrRest->stars(5); ?>
            <p>5-star:<span class="pull-right">{{  $starsData[1] }}</span></p>

            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-success active" role="progressbar"
                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:{{ $starsData[0]  }}%">
                    {{ $starsData[0]  }}%
                </div>
            </div>



            <?php $starsData = $hotelOrRest->stars(4); ?>
            <p>4-star:<span class="pull-right">{{  $starsData[1] }}</span></p>

            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-info active" role="progressbar"
                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:{{ $starsData[0]  }}%;">
                    {{ $starsData[0]  }}%
                </div>
            </div>


            <?php $starsData = $hotelOrRest->stars(3); ?>
            <p>3-star:<span class="pull-right">{{  $starsData[1] }}</span></p>

            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-warning active" role="progressbar"
                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:{{ $starsData[0]  }}%">
                    {{ $starsData[0]  }}%
                </div>
            </div>


            <?php $starsData = $hotelOrRest->stars(2); ?>
            <p>2-star:<span class="pull-right">{{  $starsData[1] }}</span></p>

            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-danger active" role="progressbar"
                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:{{ $starsData[0]  }}%">
                    {{ $starsData[0]  }}%
                </div>
            </div>


            <?php $starsData = $hotelOrRest->stars(1); ?>
            <p>1-star:<span class="pull-right">{{  $starsData[1] }}</span></p>

            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-danger active" role="progressbar"
                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:{{ $starsData[0]  }}%">
                    {{ $starsData[0]  }}%
                </div>
            </div>




            <div id="userRating">

                <div class="row">
                    @if ( $isUserLoggedIn == true )
                        @if ( $hasUserAlreadyRated == false )
                            <form method="post" action="{{ route( 'HotelController_rate' )  }}">
                                <div class="col-xs-offset-1 col-xs-10 text-center">
                                    <h4><b>Rating and review</b></h4>

                                    <span class="fa fa-star checked" id="1"></span>
                                    <span class="fa fa-star" id="2"></span>
                                    <span class="fa fa-star" id="3"></span>
                                    <span class="fa fa-star" id="4"></span>
                                    <span class="fa fa-star" id="5"></span>

                                    <textarea class="form-control" placeholder="Review!" name="review" required></textarea>

                                    <div class="clearfix">
                                        <input type="hidden" name="hotelOrRestID" value="{{ $hotelOrRestID  }}">
                                        <input type="hidden" name="ratingValue" id="ratingValue" value="1">
                                        <input type="hidden" name="_token" value="{{ Session::token()  }}">
                                        <button class="btn btn-primary pull-right" id="submitReview" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <h5 class="alert alert-success col-sm-offset-2 col-sm-8">
                                <a href="#" data-dismiss="alert" class="pull-right">&times;</a>
                                You can only rate once!
                            </h5>
                        @endif
                    @else
                        <h5 class="alert alert-success col-sm-offset-2 col-sm-8">
                            <a href="#" data-dismiss="alert" class="pull-right">&times;</a>
                            Please login first to rate!
                        </h5>
                    @endif

                </div>
            </div>
        </div>
        <br>
        <div class="row">

            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#dealsAndOffers">Deals and offers</a></li>
                <li><a data-toggle="tab" href="#details">Details</a></li>
                <li><a data-toggle="tab" href="#reviews">Reviews</a></li>
            </ul>

            <div class="tab-content">
                <div id="dealsAndOffers" class="tab-pane fade in active">
                    <h3>Deals and offers</h3>

                    <!--h4><b>Filters:</b></h4>-->
                    <!--
                    <div class="row">

                        <div class="col-sm-4">
                            <label>Cost:</label>
                            <div id="rangeSlider"></div>
                            <p id="amountWrapper">
                                <b>Amount: </b><span id="amount"></span>
                            </p>
                        </div>
                    </div>
                    <hr>
                    -->

                    <section>

                        <div class="row">
                            <?php $i = 1 ;?>

                            @foreach ( $hotelOrRest->deals as $deal )

                                <div class="col-sm-6 dealRow @if ( $i % 2 == 1 ) {{ 'leftDealRow'  }} @endif">
                                <h4>
                                    <span class="text-info">{{ $deal->title  }}</span>
                                    <span class="pull-right text-warning">PKR {{ $deal->price }}</span>
                                </h4>
                                <div class="col-xs-3">

                                    <img src="{{ URL::to( $deal->images[0]->path )  }}" class="img-responsive img-thumbnail">
                                </div>
                                <div class="col-xs-9">
                                    <b>Description: &nbsp;</b>
                                    <p>{{ $deal->description  }}</p>
                                </div>

                                </div>
                                <?php $i++; ?>
                            @endforeach

                        </div>


                        </section>
                </div>


                <div id="details" class="tab-pane fade">
                    <h3>Details</h3>


                    <p><b>Description:&nbsp;</b>{{ $hotelOrRest->description  }}
                    </p>

                </div>

                <div id="reviews" class="tab-pane fade">
                    <h3>Reviews: </h3>
                    @foreach ( $hotelOrRest->reviews as $review )
                        <div>
                            @if ( $review->user->type == "Simple" )
                                <h5 class="text-muted">Posted by <a href="{{ route( 'SimpleUserController_pageLoad', [ 'id' => $review->user->id ] )  }}">{{ $review->user->name  }}</a> on {{ date( DATE_COOKIE, strtotime($review->created_at) )  }} </h5>
                            @else
                                <h5 class="text-muted">Posted by <a href="{{ route( 'BusinessUserController_pageLoad', [ 'id' => $review->user->id ] )  }}">{{ $review->user->name  }}</a> on {{ date( DATE_COOKIE, strtotime($review->created_at) )  }} </h5>
                            @endif
                            <p>
                                {{ $review->review  }}
                            </p>
                        </div>

                        <hr>
                    @endforeach
                </div>
            </div>

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
            var minRange = 5000;
            var maxRange = 50000;
            var startMin = 10000;
            var startMax = 45000;

            var isRatingSet = false;
            var rating = 0;

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


            $('#userRating .fa-star').mouseenter(function () {
                if ( !isRatingSet )
                {
                    var starCount = $(this).attr('id');
                    var ratingsArea = $(this).parent();

                    for ( var i = 1; i <= starCount; i++ )
                    {
                        ratingsArea.children("#" + i).addClass("checked");
                    }
                }
            });

            $('#userRating .fa-star').mouseleave(function () {
                if ( !isRatingSet )
                {
                    var ratingsArea = $(this).parent();

                    for ( var i = 2; i <= 5; i++ )
                    {
                        ratingsArea.children("#" + i).removeClass("checked");
                    }
                }
            });

            $('#userRating .fa-star').click(function () {
                //Remove all stars.
                var ratingsArea = $(this).parent();

                for ( var i = 1; i <= 5; i++ )
                {
                    ratingsArea.children("#" + i).removeClass("checked");
                }

                //Mark stars.
                var starCount = $(this).attr('id');
                $( '#ratingValue' ).val( starCount );
                for ( var i = 1; i <= starCount; i++ )
                {
                    ratingsArea.children("#" + i).addClass("checked");
                }

                isRatingSet = true;
                rating = starCount;

            });

            $("#rateButton").click(function (event) {

                if ( this.hash !== "" )
                {
                    event.preventDefault();

                    hash = this.hash;

                    var offset = $('#userRating').offset().top;
                    offset -= 80;

                    $("html, body").animate({
                        'scrollTop': offset
                    }, 1000, function () {
                        window.location.hash = hash;
                    });
                }
            });

            $("#detailsButton").click(function (event) {
                var hash = $(this).attr("href") ;
                event.preventDefault();

                $(".nav a[href='"+ hash +"']").tab("show");



                var navTabs = $('.nav-tabs');

                var offset = navTabs.offset().top;
                //offset -= 150;
                $("html, body").animate({
                    'scrollTop': offset
                }, 1000, function () {
                    window.location.hash = hash;
                });

            });
        });

    </script>

@endsection