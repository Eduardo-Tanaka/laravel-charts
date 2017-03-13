@extends('layouts.layout')

@section('content')
    <h1 class="jumbotron">Lista de Quantidade Por Dia - <span id="span-mes"></span></h1>
    <div>
    	<input type="hidden" value=<?=$mes?> id="mes" />
    	<table class="table table-bordered" id="table">
	    	<thead>
	    		<tr>
	    			<th>Dia</th>
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

	var meses = ['', 'Janeiro', 'Fevereiro', 'Março', 'Abril', "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
	$("#span-mes").text(meses[$("#mes").val()]);
	$("#table").hide();
	$("#ajaxloader").show();
	$.ajax({
		url: '/charts/graficojsonline/' + $("#mes").val(),
		type: 'get',
		success: function(data){
			$("#table").show();
			data.forEach(function(d){
				$("#tbody").append("<tr><td>" + d.dia + "</td><td class='edit' id=" + d.id + ">" + d.quantidade + "</td></tr>")
			});
			$("#ajaxloader").hide();

			bindEdit();
		}
	});	

	function bindEdit() {
		$('.edit').editable(submitEdit, {
            cancel: 'Cancelar',
            submit: 'Salvar',
            indicator : 'Salvando...',
            tooltip: 'Clique para editar...',
        });

        function submitEdit(value, settings)
		{ 
			var id = this.id;
			$.ajax({
				url: "/charts/" + id + "/quantidade/" + value, 
				type: "get",
				error: function(jqXHR, textStatus, errorThrown ){
					console.log(jqXHR);
					console.log(textStatus);
					console.log(errorThrown);
					alert("Erro ao atualizar registro! Tente Novamente.")
				},
				complete: function(data) {
					console.log(data);
				}
			});
			return value;
		}
	}
		
</script>
@endsection