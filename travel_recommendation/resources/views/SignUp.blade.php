@extends('layouts.master')

@section('title')
Sign Up - Travel Recommendation
@endsection

@section( 'styles' )
<link rel="stylesheet" href="{{ URL::to( 'src/css/SignUpAndLogin.css' )  }}">
@endsection


@section("main-container")
<div class="container-fluid" id="firstPortion" style="background: url('{{ URL::to('src/signupBackground.jpg')  }}')">
    <header>

        <div class="row">
            <div class="col-sm-offset-2 col-sm-8 col-xs-offset-1 col-xs-9 titleInfoContainer">

                <div id="signUpForm">

                    @if ( count( $errors ) > 0 )
                        <h4 class="alert alert-danger">
                            <a href="#" data-dismiss="alert" class="pull-right">&times;</a>
                            @foreach ( $errors->all() as $error )
                                {{ $error }}
                                <br>
                            @endforeach
                        </h4>
                    @endif



                    <form method="post" action="{{ route( 'SignUpController_SignUpSubmit' )  }}">

                        <h2 class="text-center">Sign Up</h2>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>First name:</label>
                                <input type="text" class="form-control" placeholder="First name..." name="first_name" value="{{ old( 'first_name' )  }}" required>
                            </div>

                            <div class="col-sm-6">
                                <label>Last name:</label>
                                <input type="text" class="form-control" placeholder="Last name..." name="last_name" value="{{ old( 'last_name' )  }}" required>
                            </div>


                            <div class="col-sm-6">
                                <label>Date of birth:</label>
                                <input type="date" class="form-control" name="dob" value="{{ old( 'dob' )  }}" required>

                            </div>


                            <div class="col-sm-6">
                                <label>Gender</label>
                                <select class="form-control" name="gender" required>
                                    <option value="Male" @if ( old( 'gender' ) == 'Male' ) {{ "selected" }} @endif >Male</option>
                                    <option value="Female" @if ( old( 'gender' ) == 'Female' ) {{ "selected" }} @endif >Female</option>
                                </select>

                            </div>


                            <div class="col-sm-6">
                                <label>Type of user:</label>
                                <select class="form-control" name="type_of_user" required>
                                    <option value="Simple" @if ( old( 'type_of_user' ) == 'Simple' ) {{ "selected" }} @endif >Simple</option>
                                    <option value="Business" @if ( old( 'type_of_user' ) == 'Business' ) {{ "selected" }} @endif  >Business</option>
                                </select>

                            </div>

                            <div class="col-sm-6">
                                <label>Email:</label>
                                <input type="email" class="form-control" placeholder="emai@server.com" name="email" value="{{ old( 'email' )  }}" required>
                            </div>

                            <div class="col-sm-6">
                                <label>Username:</label>
                                <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old( 'username' )  }}" required>
                            </div>


                            <div class="col-sm-6">
                                <label>Password:</label>
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                            </div>


                            <div class="col-sm-6">
                                <label>Password again:</label>
                                <input type="password" class="form-control" placeholder="Password again" name="password_again" required>
                            </div>

                            <div class="col-sm-12">
                                <div class="clearfix" style="margin-top: 5px;">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-warning">Done</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('facebookLogin')  }}">Login with Facebook</a>
                        </div>

                        <input type="hidden" name="_token" value="{{ Session::token()  }}">
                    </form>
                </div>

                <hr>

                <p class="text-center text-muted">Already have account? <a href="{{ route('LoginController_pageLoad')  }}">Login</a></p>

            </div>

        </div>
    </header>
</div>

@endsection

@section('scripts')
@endsection