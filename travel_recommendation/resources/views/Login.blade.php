@extends('layouts.master')

@section('title')
    Login- Travel Recommendation
@endsection

@section( 'styles' )
    <link rel="stylesheet" href="{{ URL::to( 'src/css/SignUpAndLogin.css' )  }}">
@endsection


@section("main-container")
    <div class="container-fluid" id="firstPortion" style="background: url('{{ URL::to('src/loginBackground.jpg')  }}')">
        <header>

            <div class="row">
                <div class="col-sm-offset-4 col-sm-4 col-xs-offset-1 col-xs-10 titleInfoContainer">

                    <form method="post" action="{{ route('LoginController_loginSubmit')  }}">
                        <h2 class="text-center">Login</h2>

                        @if ( Session::has( 'signUpComplete' ) )
                            <h5 class="alert alert-success">
                                <a href="#" data-dismiss="alert" class="pull-right">&times;</a>
                                Your account has been created! Please use your username to login.
                            </h5>
                        @endif

                        @if ( Session::has( 'message' ) )
                            <h5 class="alert alert-success">
                                <a href="#" data-dismiss="alert" class="pull-right">&times;</a>
                                {{ Session::get( 'message' )  }}
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

                        <label>Email: </label>
                        <input type="email" placeholder="Email" class="form-control" name="email" value="{{ old( 'email' )  }}" required>

                        <label>Password: </label>
                        <input class="form-control" type="password" placeholder="Password..." name="password" required>



                        <div class="text-center" style="margin-top: 5px;">
                            <input type="radio" name="type_of_user" value="Simple" @if ( old( 'type_of_user' ) == 'Simple' ) {{ "checked" }} @endif required>&nbsp; Simple
                            <input type="radio" name="type_of_user" value="Business" @if ( old( 'type_of_user' ) == 'Business' ) {{ "checked" }} @endif required>&nbsp; Business
                        </div>

                        <div class="clearfix">
                            <button class="pull-right btn btn-warning" type="submit">Login</button>
                        </div>

                        <hr>

                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('facebookLogin')  }}">Login with Facebook</a>
                        </div>

                        <hr>

                        <p class="text-muted text-center">
                            Dont have account? <a href="{{ route('SignUpController_pageLoad')  }}">Sign up</a>
                        </p>
                        <input type="hidden" name="_token" value="{{ Session::token()  }}">
                    </form>
                </div>

            </div>
        </header>
    </div>

@endsection

@section('scripts')
@endsection