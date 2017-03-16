<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('css/sb-admin.css')}}" />
    <link rel="stylesheet" href="{{asset('css/estilo.css')}}" />
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
</head>

<body>
	<div id="wrapper">
		@include('layouts.header')
        
        <div id="page-wrapper">
        	<div class="container-fluid">
        		@yield('content')
        	</div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/chart.min.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>
    <script type="text/javascript" src="{{asset('js/jeditable.min.js')}}"></script>
    <script>
    	// para ajustar cor do background do conteúdo
    	$("#page-wrapper").css("min-height", $(window).height());
    </script>
    @yield('footer')

</body>

</html>
