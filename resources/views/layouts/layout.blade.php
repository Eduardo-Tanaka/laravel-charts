<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
 
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />

        <title>Laravel</title>
    </head>
    <body>
    	@include('layouts.header')

    	<div class="container">
        	@yield('content')
        </div>
        
        <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/chart.js')}}"></script>

        @yield('footer')
    </body>
</html>
