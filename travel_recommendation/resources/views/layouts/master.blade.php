<!Doctype html>

<html lang="en">
     <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">	
		
        <title>@yield('title')</title>

         <link href="{{ URL::to('src/css/styles.css') }}" rel="stylesheet">

        <!-- Bootstrap -->
        <link href=" {{ URL::to('src/bootstrap-3.3.6-dist/css/bootstrap-theme.min.css') }}" rel="stylesheet">
        <link href="{{ URL::to('src/bootstrap-3.3.6-dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::to('src/jquery-ui-1.12.0/jquery-ui.min.css') }}" rel="stylesheet">


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <script src="{{ URL::to('src/jquery-ui-1.12.0/jquery-ui.min.js') }}"></script>
        <script src="{{ URL::to('src/bootstrap-3.3.6-dist/js/bootstrap.min.js') }}"></script>
		<script src="{{ URL::to('src/bootstrap-filestyle.min.js') }}"></script>

        <!--<link rel="icon" href="{{ URL::to('src/fevicon.jpg') }}"-->
         
         @yield('styles')
      </head>
    
    <body >
        @include('includes.navbar')


        @yield("main-container")


        @yield('scripts')
        <script src="{{ URL::to( 'src/js/scripts.js' )  }}"></script>

        <footer>
            <p class="text-center text-muted">&copy; 2018 <a href="#">Travel - Recommendation</a><p>
        </footer>
    </body>
    
</html>

    
    