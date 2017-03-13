<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
 
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{asset('css/estilo.css')}}" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>

        <title>Laravel</title>
    </head>
    <body>
    	@include('layouts.header')

    	<div class="container">
        	@yield('content')
        </div>
        
        <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/chart.min.js')}}"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>
        <script type="text/javascript" src="{{asset('js/jeditable.min.js')}}"></script>

        @yield('footer')
    </body>
</html>
