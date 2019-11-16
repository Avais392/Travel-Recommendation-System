@extends('layouts.master')

@section('title')
    Search Results - Travel Recommendation
@endsection

@section( 'styles' )
    <link rel="stylesheet" href="{{ URL::to( 'src/css/HomeAndSearchResults.css' )  }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .scrollingDropdown
        {
            height: 35vh;
            overflow-y: scroll;
        }
    </style>
@endsection


@section("main-container")
    <div class="container-fluid" id="mainBody" style="background: url('{{ URL::to('src/HomeBackground.jpg')  }}')">
        <header class="text-center">

            <div class="row">
                <div class="col-sm-offset-2 col-sm-8 col-xs-12 content text-center">

                    <h1>We Know Every Place, Trust Us! &hearts;</h1>

                    <p class="text-muted">Search a destination, hotel or a restaurant!</p>

                    <div  id="searchWidgetWrapper" class="col-xs-12 text-left">
                        <form>
                                <input id="searchField" class="form-control " type="text" placeholder="Search Anything..." name="searchString" autocomplete="off">
                                <div id="searchDropdown" class=""></div>

                                <input type="hidden" id="priceLowerBound" value="700">
                                <input type="hidden" id="priceUpperBound" value="8000">
                                <input type="hidden" id="ratingLowerBound" value="1">
                                <input type="hidden" id="ratingUpperBound" value="5">
                                <input type="hidden" id="features" value="">

                                <input type="hidden" value="{{ Session::token()  }}" id="sessionToken">
                        </form>

                        <p class="text-center text-muted" id="filtersLabel"><em>Filters</em>
                            <span id="filterDropdownArrow">
                                <span class="glyphicon glyphicon-chevron-down"></span>
                            </span>
                        </p>

                        <div id="filtersSection" class="">
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

                                <?php $i = 0; ?>
                                @foreach ( $features as $feature )
                                    <input type="checkbox" id="feature_{{ $i  }}" value="{{ $feature->id  }}" class="featureCheckBox">{{ $feature->name  }}<br>
                                    <?php $i++; ?>
                                @endforeach
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </header>
    </div>


@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {

            var isCursorOnSearchDropDown = false;
            var baseURL = "{{ URL::to('/')  }}";
            var filtersLabel = $('#filtersLabel');
            var filtersSection = $( '#filtersSection' );
            var filtersDropdownArrow = $('#filterDropdownArrow');
            var totalNumOfFeatures = "{{ count( $features ) }}";

            var priceUpperBound =  $('#priceUpperBound');
            var priceLowerBound =  $( '#priceLowerBound' );
            var ratingLowerBound = $( '#ratingLowerBound' );
            var ratingUpperBound = $( '#ratingUpperBound' );
            var features = $('#features');

            var slidingDelay = 300;
            var areFiltersChanged = false;


            var keyPressTimeOut;
            var delay = 1000;

            filtersSection.hide();

            var searchDropDown = $('#searchDropdown');
            var searchField = $('#searchField');

            searchDropDown.hide();

            function hideFilterSection()
            {
                if (  filtersSection.is(':visible') )
                {
                    filtersSection.slideUp( slidingDelay );
                    filtersDropdownArrow.html( "<span class='glyphicon glyphicon-chevron-down'></span>" );
                }
            }

            searchField.focusin(function () {
                if ( searchField.val() != "" )
                {
                    hideFilterSection();

                    searchDropDown.show();

                    if ( areFiltersChanged )
                    {
                        searchDropDown.html("<div class='text-center'><span class='loader'></span></div>");

                        setTimeout(function ()
                        {
                            retrieveSearchResults( searchField.val(), '{{ route('HomeController_processSearchString')  }}', $('#sessionToken').val() );
                        }, delay );
                    }
                }

            });

            searchField.focusout(function () {
                if ( !isCursorOnSearchDropDown )
                {
                    searchDropDown.hide();
                }
            });

            searchDropDown.mouseenter(function () {
                isCursorOnSearchDropDown = true;
            });

            searchDropDown.mouseleave(function () {
                isCursorOnSearchDropDown = false;
            });

            function retrieveSearchResults(searchString, url, token) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        searchString: searchString,
                        priceUpperBound: priceUpperBound.val(),
                        priceLowerBound: priceLowerBound.val(),
                        ratingUpperBound: ratingUpperBound.val(),
                        ratingLowerBound: ratingLowerBound.val(),
                        features: features.val(),
                        _token: token
                    },

                    datatype: 'json',

                    success: function (data) {

                        renderSearchResponse(data);
                        areFiltersChanged = false;
                    },
                    beforeSend: function () {

                    },
                    error: function () {
                        alert("Request failed!");
                    }
                });
			}

            function renderSearchResponse( data )
            {
                if ( data == "" )
                {
                    searchDropDown.html("<div class='text-center text-muted'><em>No related data found!</em></div>");
                }
                else
                {
                    var html = "";
                    for ( var i = 0; i < data.length; i++ )
                    {
                        if ( data[i].type == "Hotel" || data[i].type == "Restaurant" )
                        {
                            var url = baseURL + "/HotelOrRestaurant/" + data[i].id;
                        }
                        else
                        {
                            var url = baseURL + "/Destination/" + data[i].id;
                        }
                        html += "<a class='resultRow' href='"+ url +"'>";
                        html += "<div>";
                        html += data[i].name;


                        if ( data[i].type == "Hotel" || data[i].type == "Restaurant" )
                        {
                            html += "<span class='ratingSection'>";
                            for ( var j = 0; j < data[i].rating; j++ )
                            {
                                html += "<span class='fa fa-star checked'></span>";
                            }

                            for ( var j = 0; j < 5 - data[i].rating; j++ )
                            {
                                html += "<span class='fa fa-star'></span>";
                            }
                            html += "</span>";

                            html += " - " + data[i].destination;
                        }
                        html += "<span class='text-muted pull-right'>" + data[i].type + "</span>";

                        html += "</div>";
                        html += "</a>";
                    }
                    searchDropDown.html( html );

                    searchDropDown.removeClass( 'scrollingDropdown' );

                    if ( ( searchDropDown.outerHeight() / $(window).height() ) * 100  > 35  )
                    {
                        searchDropDown.addClass('scrollingDropdown');
                    }
                }
            }
            




            searchField.keydown(function () {
                hideFilterSection();
                clearTimeout( keyPressTimeOut );
            });

            searchField.keyup(function () {
                if ( searchField.val() == "" )
                {
                    clearTimeout( keyPressTimeOut );
                    searchDropDown.hide();
                    searchDropDown.html("");
                }
                else
                {
                    searchDropDown.show();
                    clearTimeout( keyPressTimeOut );

                    searchDropDown.html("<div class='text-center'><span class='loader'></span></div>");

                    keyPressTimeOut = setTimeout(function ()
                    {
                        retrieveSearchResults( searchField.val(), '{{ route('HomeController_processSearchString')  }}', $('#sessionToken').val() );
                    }, delay );
                }

            });

            
            function toggleFiltersSection() {
                if (  filtersSection.is(':visible') )
                {
                    filtersSection.slideUp( slidingDelay );
                    filtersDropdownArrow.html( "<span class='glyphicon glyphicon-chevron-down'></span>" );
                }
                else
                {
                    filtersSection.slideDown( slidingDelay );
                    filtersDropdownArrow.html( "<span class='glyphicon glyphicon-chevron-up'></span>" );
                }
            }
            
            filtersLabel.click( function () {
                toggleFiltersSection();
            } );



            //Render range slider of price.
            var minRange = 500;
            var maxRange = 10000;
            var startMin = 700;
            var startMax = 8000;

            $( "#rangeSlider" ).slider({
                range: true,
                min: minRange,
                max: maxRange,
                values: [ startMin, startMax ],
                slide: function( event, ui ) {
                    areFiltersChanged = true;
                    $( "#amount" ).html( "Rs." + ui.values[ 0 ] + " - Rs." + ui.values[ 1 ] );
                    priceLowerBound.val( ui.values[ 0 ] );
                    priceUpperBound.val( ui.values[ 1 ] );
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
                    areFiltersChanged = true;
                    $( "#stars" ).html( ui.values[ 0 ] + " Star - " + ui.values[ 1 ] + " Star" );
                    ratingLowerBound.val( ui.values[ 0 ] );
                    ratingUpperBound.val( ui.values[ 1 ] );
                }
            });

            $( "#stars" ).html("1 Star - 5 Star" );



            $( '.featureCheckBox' ).change(function () {
                areFiltersChanged = true;
                var p = $( this ).parent();

                var str = "";
                for ( var i = 0 ; i < totalNumOfFeatures ; i++ )
                {
                    var checkBox = p.children( "#feature_" + i );

                    if ( checkBox.is( ":checked" ) )
                    {
                        str += checkBox.val() + ",";
                    }
                }
                features.val( str );
                //alert( features.val() );
            });
        });



    </script>

@endsection