<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
 
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />

        <title>Laravel</title>

        <style>
#ajaxloader
{
	position: relative;
    margin-bottom: 10px;
	width: 30px;
	height: 30px;
	border: 8px solid #1C84C6;
	border-right-color: transparent;
	border-radius: 50%;
	box-shadow: 0 0 25px 2px #eee;
    animation: spin 1s linear infinite;
    left: 48.5%;
}

@keyframes spin
{
	from { transform: rotate(0deg);   opacity: 0.2; }
	50%  { transform: rotate(180deg); opacity: 1.0; }
	to   { transform: rotate(360deg); opacity: 0.2; }
}
        </style>
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
