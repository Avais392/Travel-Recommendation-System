@extends('layouts.master')

@section('title')
    {{ $user->name  }} - Travel Recommendation
@endsection

@section( 'styles' )
    <link rel="stylesheet" href="{{ URL::to( 'src/css/User.css' )  }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection


@section("main-container")
    <div class="container-fluid" id="firstPortion" style="background: url('{{ URL::to('src/SimpleUserImages/tropical.jpg')  }}')">
        <header>


            @if ( count( $errors ) > 0 )
                <h4 class="alert alert-danger">
                    <a href="#" data-dismiss="alert" class="pull-right">&times;</a>
                    @foreach ( $errors->all() as $error )
                        {{ $error }}
                        <br>
                    @endforeach
                </h4>
            @endif

            @if ( Session::has( 'successMessage' ) )
                <h5 class="alert alert-success">
                    <a href="#" data-dismiss="alert" class="pull-right">&times;</a>
                    {{ Session::get( 'successMessage' )  }}
                </h5>
            @endif

            <div class="row">
                <div class="col-sm-offset-5 col-sm-2 col-xs-offset-4 col-xs-4 userTitleInfoContainer">

                    <div>
                        <img src="{{ URL::to( $user->image )  }}" class="img-thumbnail img-circle" height="100%" width="100%">
                    </div>

                    <div class="text-center">
                        <h3 id="userName">User ABC</h3>
                    </div>
                    <hr>

                    @if ( $isAlreadyLoggedInUser == true )
                        <div class="text-center">

                            <form method="post" action="{{ route( 'SimpleUserController_changeProfilePic' )  }}" enctype="multipart/form-data">
                                <input class="filestyle" type="file" data-buttonText="Image" name="profilePic">
                                <button type="submit" class="btn btn-block btn-sm btn-primary">Change</button>
                                <input type="hidden" value="{{ Session::token()  }}" name="_token">
                            </form>
                        </div>
                    @endif
                </div>

            </div>
        </header>
    </div>

    <br>
    <div class="container" id="secondSection">
        <div class="row">

            <div class="col-sm-3">

                @if ( $isAlreadyLoggedInUser == true )
                    <button class="btn btn-block btn-primary" type="button" data-toggle="modal" data-target="#addNewHotel">Add new hotel</button>
                    <button class="btn btn-block btn-warning" type="button" data-toggle="modal" data-target="#addNewRestaurant">Add new restaurant</button>
                @else
                    <div class="alert alert-danger">
                        <a class="pull-right close" data-dismiss="alert">&times;</a>
                        No Actions!
                    </div>
                @endif


            </div>
            <div class="col-sm-9">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#details">Details</a></li>
                    <li><a data-toggle="tab" href="#reviews">Reviews given</a></li>
                    <li><a data-toggle="tab" href="#listings">Listings</a></li>
                </ul>

                <div class="tab-content">
                    <div id="details" class="tab-pane fade in active">
                        <h3>Details</h3>

                        <div class="row">
                            <div class="col-sm-3">
                                <p><b>Gender: </b>{{ $user->gender  }}</p>
                            </div>

                            <div class="col-sm-4">
                                <p><b>Email: </b>{{ $user->email  }}</p>
                            </div>
                        </div>
                    </div>

                    <div id="reviews" class="tab-pane fade">
                        <h3>Reviews given: </h3>

                        @foreach ( $user->reviews as $review )
                            <div>
                                <?php $timeStamp = strtotime( $review->created_at ); ?>
                                <h5 class="text-muted">Posted on <span class="text-info">{{ date( DATE_COOKIE, $timeStamp )  }}</span> on <a href="{{ route( 'HotelController_pageLoad', ['id' => 1] )  }}">{{ $review->hotelOrRestaurant->name  }}</a></h5>
                                <p>
                                    {{ $review->review  }}
                                </p>
                                <p><b>Rating Given: </b> {{ $review->rating }} out of 5 </p>
                            </div>
                            <hr>
                        @endforeach


                    </div>

                    <div id="listings" class="tab-pane fade">
                        <h3>Listings:</h3>

                        <div class="row">
                            <?php $i = 1; ?>
                            @foreach ( $user->hotelsOrRestaurants as $listing )
                                <div class="col-sm-6" class="@if ( $i % 2 == 1 ) {{ "leftListing"  }} @endif">

                                    <span class="listingPic">
                                         <img src="{{ URL::to( $listing->pic )  }}" class="img-thumbnail img-rounded">
                                    </span>


                                    <span class="listingDetail">
                                    <h3 class="text-info">{{ $listing->name  }}</h3>
                                    <label class="text-warning">{{ $listing->destination->name }}</label><br>
                                    <label class="text-warning" style="font-size: 60%;">{{ $listing->type }}</label><br>
                                        @if ( isset($business->attraction) )
                                            <label class="text-muted" style="font-size: 75%;">{{ $business->attraction->name }}</label><br>
                                        @endif

                                        <?php
                                        $k = 0;
                                        ?>
                                        @for ( ; $k < $listing->rating ; $k++ )
                                            <span class="fa fa-star checked"></span>
                                        @endfor
                                        @for ( $j = 0 ; $j < ( 5 - $k ); $j++ )
                                            <span class="fa fa-star"></span>
                                        @endfor

                                    </span>
                                </div>
                                <?php $i++; ?>
                            @endforeach

                        </div>
                    </div>
                </div>


                </div>
            </div>

        </div>


    <!-- Modal -->
    @if ( $isAlreadyLoggedInUser == true )

    <div id="addNewHotel" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">New Hotel</h2>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route( 'SimpleUserController_addNewHotel' )  }}" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Name:</label>
                                <input class="form-control" type="text" placeholder="Name of Hotel..." name="name" required value="{{ old('name')  }}">
                            </div>
                            <div class="col-sm-6">
                                <label>Destination:</label>
                                <select class="form-control" name="destination" required  >
                                    <option value=""  >None</option>
                                    <option value="1" @if ( old( 'destination' ) == 1 ) {{ "selected"  }}  @endif>Kaula Lampur</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>Attraction:</label>
                                <select class="form-control" name="attraction">
                                    <option value="">None</option>
                                    <option value="1" @if ( old( 'attraction' )  == 1 ) {{ "selected"  }}  @endif >Attraction 1</option>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label>Description:</label>

                                <textarea class="form-control" name="description">{{ old( 'description' )  }}</textarea>
                            </div>

                            <div class="col-sm-6">
                                <label>Phone:</label>
                                <input type="text" placeholder="Phone number" name="phoneNum" class="form-control" required value="{{ old( 'phoneNum' )  }}" >
                            </div>

                            <div class="col-sm-6">
                                <label>Fax:</label>

                                <input type="text" placeholder="Fax" name="fax" class="form-control" required value="{{ old( 'fax' )  }}">
                            </div>

                            <div class="col-sm-6">
                                <label>Email:</label>

                                <input type="email" placeholder="Dummy@server.com" name="email" class="form-control" required value="{{ old( 'email' )  }}">
                            </div>

                            <div class="col-sm-6">
                                <label>Website:</label>

                                <input type="text" placeholder="wwww.google.com.pk" name="website" class="form-control" required value="{{ old( 'website' )  }}">
                            </div>

                            <div class="col-sm-12">
                                <div><label>Features:</label></div>
                                <div class="col-sm-3">
                                    <input type="checkbox" name="featureID_1" value="1" @if ( old( 'featureID_1' ) ) {{ "checked"  }} @endif> Wifi
                                </div>


                                <div class="col-sm-3">
                                    <input type="checkbox" name="featureID_2"  value="2"  @if ( old( 'featureID_2' ) ) {{ "checked"  }} @endif> Parking
                                </div>
                            </div>



                            <div class="col-sm-6">
                                <label>Rent per day:</label>

                                <input type="text" placeholder="Rs. 250000" name="rentPerDay" class="form-control" required value="{{ old( 'rentPerDay' )  }}">
                            </div>





                            <div class="col-sm-6">
                                <label>Image:</label>
                                <input class="filestyle" type="file" data-buttonText="Upload Image" name="hotelPic">
                                <p class="text-muted text-success"><em>Optional</em></p>
                            </div>

                            <div class="clearfix col-sm-12" style="margin-top: 3px;">
                                <button class="btn btn-primary pull-right" type="submit">Done</button>
                            </div>

                            <input type="hidden" value="{{ Session::token()  }}" name="_token">

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>

    </div>

    <!-- Modal -->
    <div id="addNewRestaurant" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">New restaurant</h2>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route( 'SimpleUserController_addNewRestaurant' )  }}" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Name:</label>
                                <input class="form-control" type="text" placeholder="Name of Restaurant..." name="name" required value="{{ old('name')  }}">
                            </div>
                            <div class="col-sm-6">
                                <label>Destination:</label>
                                <select class="form-control" name="destination" required  >
                                    <option value=""  >None</option>
                                    <option value="1" @if ( old( 'destination' ) == 1 ) {{ "selected"  }}  @endif>Kaula Lampur</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>Attraction:</label>
                                <select class="form-control" name="attraction">
                                    <option value="">None</option>
                                    <option value="1" @if ( old( 'attraction' )  == 1 ) {{ "selected"  }}  @endif >Attraction 1</option>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label>Description:</label>

                                <textarea class="form-control" name="description">{{ old( 'description' )  }}</textarea>
                            </div>

                            <div class="col-sm-6">
                                <label>Phone:</label>
                                <input type="text" placeholder="Phone number" name="phoneNum" class="form-control" required value="{{ old( 'phoneNum' )  }}" >
                            </div>

                            <div class="col-sm-6">
                                <label>Fax:</label>

                                <input type="text" placeholder="Fax" name="fax" class="form-control" required value="{{ old( 'fax' )  }}">
                            </div>

                            <div class="col-sm-6">
                                <label>Email:</label>

                                <input type="email" placeholder="Dummy@server.com" name="email" class="form-control" required value="{{ old( 'email' )  }}">
                            </div>

                            <div class="col-sm-6">
                                <label>Website:</label>

                                <input type="text" placeholder="wwww.google.com.pk" name="website" class="form-control" required value="{{ old( 'website' )  }}">
                            </div>

                            <div class="col-sm-12">
                                <div><label>Features:</label></div>
                                <div class="col-sm-3">
                                    <input type="checkbox" name="featureID_1" value="1" @if ( old( 'featureID_1' ) ) {{ "checked"  }} @endif> Wifi
                                </div>


                                <div class="col-sm-3">
                                    <input type="checkbox" name="featureID_2"  value="2"  @if ( old( 'featureID_2' ) ) {{ "checked"  }} @endif> Parking
                                </div>
                            </div>






                            <div class="col-sm-6">
                                <label>Image:</label>
                                <input class="filestyle" type="file" data-buttonText="Upload Image" name="pic">
                                <p class="text-muted text-success"><em>Optional</em></p>
                            </div>

                            <div class="clearfix col-sm-12" style="margin-top: 3px;">
                                <button class="btn btn-primary pull-right" type="submit">Done</button>
                            </div>

                            <input type="hidden" value="{{ Session::token()  }}" name="_token">

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>

    </div>

@endif

@endsection

@section('scripts')
@endsection