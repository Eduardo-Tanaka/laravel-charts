<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}" />
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/sb-admin.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/estilo.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{asset('DataTables/DataTables-1.10.13/css/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('DataTables/Buttons-1.2.4/css/buttons.datatables.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('DataTables/Buttons-1.2.4/css/buttons.bootstrap.css')}}"/>
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

    <script type="text/javascript" src="{{asset('DataTables/DataTables-1.10.13/js/jquery.dataTables.js')}}"></script>
    <script type="text/javascript" src="{{asset('DataTables/DataTables-1.10.13/js/dataTables.bootstrap.js')}}"></script>

    <script type="text/javascript" src="{{asset('DataTables/Buttons-1.2.4/js/dataTables.buttons.js')}}"></script>
	<script type="text/javascript" src="{{asset('DataTables/Buttons-1.2.4/js/buttons.colVis.js')}}"></script>
	<script type="text/javascript" src="{{asset('DataTables/Buttons-1.2.4/js/buttons.print.js')}}"></script>
	<script type="text/javascript" src="{{asset('DataTables/Buttons-1.2.4/js/buttons.html5.js')}}"></script>
	<script type="text/javascript" src="{{asset('pdfmake-master/build/pdfmake.js')}}"></script>
	<script type="text/javascript" src="{{asset('pdfmake-master/build/vfs_fonts.js')}}"></script>
	<script type="text/javascript" src="{{asset('DataTables/JSZip-2.5.0/jszip.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/jeditable.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('echarts-2.2.7/build/dist/echarts-all.js')}}"></script> <!-- precisei colocar depois do DataTables para não causar erro -->

    <script>
    	// para ajustar cor do background do conteúdo
    	$("#page-wrapper").css("min-height", $(window).height() - 50);
    	$.extend( true, $.fn.dataTable.defaults, {
		    language: {
	            "sEmptyTable": "Nenhum registro encontrado",
			    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
			    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
			    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
			    "sInfoPostFix": "",
			    "sInfoThousands": ".",
			    "sLengthMenu": "_MENU_ resultados por página",
			    "sLoadingRecords": "Carregando...",
			    "sProcessing": "Processando...",
			    "sZeroRecords": "Nenhum registro encontrado",
			    "sSearch": "Pesquisar",
			    "oPaginate": {
			        "sNext": "Próximo",
			        "sPrevious": "Anterior",
			        "sFirst": "Primeiro",
			        "sLast": "Último"
			    },
			    "oAria": {
			        "sSortAscending": ": Ordenar colunas de forma ascendente",
			        "sSortDescending": ": Ordenar colunas de forma descendente"
			    }
	        },
	        destroy: true,
			responsive: true,
		});
    </script>
    @yield('footer')

</body>

</html>
