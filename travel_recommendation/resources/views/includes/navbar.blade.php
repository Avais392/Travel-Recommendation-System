<div class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle='collapse' data-target='#navbar-collapse'>
                <span class="sr-only">Navbar Toggle.</span>
            
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            <a href="{{ route('HomeController_pageLoad')  }}" class="navbar-brand">Travel Recommendation</a>
        </div>
        
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
                @if ( isset( $isUserLoggedIn ) && $isUserLoggedIn == false )
                    <li {{ Request::is("Login") ? 'class=active' : ''  }}><a href="{{ route('LoginController_pageLoad')  }}">Login</a></li>
                @endif
                @if ( isset( $isUserLoggedIn ) && $isUserLoggedIn == true )
                    <li {{ Request::is("logout") ? 'class=active' : ''  }}><a href="{{ route('logout')  }}">Logout</a></li>
                @endif
                    <li {{ Request::is("SignUp") ? 'class=active' : ''  }}><a href="{{ route('SignUpController_pageLoad')  }}">SignUp</a></li>
                @yield("navbar-left-links")
            </ul>


                @yield("navbar-right-links")
        </div>
    </div>
</div>
