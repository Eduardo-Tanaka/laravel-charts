@extends('layouts.layout')

@section('content')
    <h1 class="jumbotron">Lista de Quantidades Por Mês</h1>
    <div id="chart-div">
    	<table class="table table-bordered" id="table">
	    	<thead>
	    		<tr>
	    			<th>Data</th>
	    			<th>Quantidade</th>
	    		</tr>
	    	</thead>
	    	<tbody id="tbody">
	    		<tr>
	    			
	    		</tr>
	    	</tbody>
    	</table>
    </div>
    <div id="ajaxloader" hidden="hidden"></div>


@endsection

@section('footer')
<script>
	$("#link-dados").addClass("active");
	var meses = ['', 'Janeiro', 'Fevereiro', 'Março', 'Abril', "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
	$("#table").hide();
	$("#ajaxloader").show();
	$.ajax({
		url: '/charts/graficojsonbar',
		type: 'get',
		success: function(data){
			$("#table").show();
			data.forEach(function(d){
				$("#tbody").append("<tr><td><a href='/charts/show/" + d.mes + "'>" + meses[d.mes] + "</a></td><td>" + d.quantidade + "</td></tr>")
			});
			$("#ajaxloader").hide();
		}
	});	
</script>
@endsection