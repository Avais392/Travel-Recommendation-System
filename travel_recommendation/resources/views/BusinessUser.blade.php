@extends('layouts.master')

@section('title')
    User ABC - Travel Recommendation
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
                        <h3 id="userName">{{ $user->name  }}</h3>
                    </div>
                    <hr>

                    <div class="text-center">
                        <form method="post" action="{{ route( 'BusinessUserController_changeProfilePic' )  }}" enctype="multipart/form-data">
                            <input class="filestyle" type="file" data-buttonText="Image" name="profilePic">
                            <button type="submit" class="btn btn-block btn-sm btn-primary">Change</button>
                            <input type="hidden" value="{{ Session::token()  }}" name="_token">
                        </form>
                    </div>
                </div>

            </div>
        </header>
    </div>

    <br>
    <div class="container" id="secondSection">
        <div class="row">

            <div class="col-sm-3">

                <button class="btn btn-block btn-primary" type="button" data-toggle="modal" data-target="#addNewHotel">Add new hotel</button>
                <button class="btn btn-block btn-warning" type="button" data-toggle="modal" data-target="#addNewRestaurant">Add new restaurant</button>
                <button class="btn btn-block btn-primary" type="button" data-toggle="modal" data-target="#addNewTravelOption">Add new travel option</button>

            </div>
            <div class="col-sm-9">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#details">Details</a></li>
                    <!--<li><a data-toggle="tab" href="#reviews">Reviews given</a></li>-->
                    <li><a data-toggle="tab" href="#businesses">Businesses</a></li>
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
                    <!--
                    <div id="reviews" class="tab-pane fade">
                        <h3>Reviews given: </h3>
                        <div>
                            <h5 class="text-muted">Posted on <span class="text-info">3 March 2018</span> at 2:07 PM on <a href="#">Dummy Hotel</a></h5>
                            <p>
                                The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.
                                Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form,
                                accompanied by English versions from the 1914 translation by H. Rackham.
                            </p>
                        </div>
                        <hr>

                        <div>
                            <h5 class="text-muted">Posted on <span class="text-info">3 March 2018</span> at 2:07 PM on <a href="#">Dummy Hotel</a></h5>
                            <p>
                                The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.
                                Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form,
                                accompanied by English versions from the 1914 translation by H. Rackham.
                            </p>
                        </div>
                        <hr>

                    </div>
                    -->

                    <div id="businesses" class="tab-pane fade">
                        <h3>Businesses:</h3>

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


    <!-- Modal -->
    <div id="addNewHotel" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">New Hotel</h2>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route( 'BusinessUserController_addNewHotel' )  }}" enctype="multipart/form-data">
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
                    <form method="post" action="{{ route( 'BusinessUserController_addNewRestaurant' )  }}" enctype="multipart/form-data">
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

    <div id="addNewTravelOption" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">New Travel Option</h2>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route( 'BusinessUserController_addNewTravelOption' )  }}">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Title:</label>
                                <input class="form-control" type="text" placeholder="Title of Travel option..." name="title" required value="{{ old( 'title' )  }}">
                            </div>
                            <div class="col-sm-6">
                                <label>Type:</label>
                                <select class="form-control" name="travelType" required>
                                    <option value="">None</option>
                                    <option value="1" @if ( old('travelType') == 1 ) {{ "selected"  }} @endif>Airline</option>
                                    <option value="2" @if ( old('travelType') == 2 ) {{ "selected"  }} @endif>Traveling Agency</option>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label>Description</label>
                                <textarea name="description" required class="form-control">{{ old( 'description' )  }}</textarea>
                            </div>

                            <div class="col-sm-6">
                                <label>Destination:</label>
                                <select class="form-control" name="destination" required>
                                    <option value="">None</option>
                                    <option value="1" @if ( old('destination') == 1 ) {{ "selected"  }} @endif>Kaula Lampur</option>
                                </select>
                            </div>


                            <div class="col-sm-6">
                                <label>Attraction:</label>
                                <select class="form-control" name="attraction" >
                                    <option value="">None</option>
                                    <option value="1" @if ( old('attraction') == 1 ) {{ "selected"  }} @endif>Attraction 1</option>
                                </select>
                            </div>


                            <input type="hidden" name="_token" value="{{ Session::token()  }}">

                            <div class="clearfix col-sm-12" style="margin-top: 3px;">
                                <button class="btn btn-primary pull-right">Done</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('scripts')
@endsection