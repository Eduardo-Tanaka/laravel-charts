@extends('layouts.layout')

@section('content')
    <h1 class="jumbotron">Lista de Quantidades Por Mês</h1>
    <div>
    	<table class="table table-bordered table-condensed table-striped" id="table">
	    	<thead>
	    		<tr>
	    			<th id="data">Mês</th>
	    			<th>Quantidade</th>
	    		</tr>
	    	</thead>
	    	<tbody id="tbody">

	    	</tbody>
    	</table>
    </div>
    <div id="ajaxloader" hidden="hidden"></div>


@endsection

@section('footer')
<script>
	$(document).ready(function() {		
		$("#link-dados").addClass("active");
		var meses = ['', 'Janeiro', 'Fevereiro', 'Março', 'Abril', "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
		
		function renderMes() {
			var table = $("#table").DataTable({
				initComplete: function () {
					this.api().columns([0]).every( function () {
		                var column = this;
		                var select = $('<select style="margin-left:5px" class="form-control input-sm"><option value="">Todos</option></select>')
		                    .appendTo( $("#table_filter") ) 
		                    .on('change', function () {
		                        var val = $.fn.dataTable.util.escapeRegex(
		                            $(this).val()
		                        );
		 
		                        column
		                            .search( val ? '^'+val+'$' : '', true, false )
		                            .draw();

		                        $("#data").text("Mês");
		                    });

		                column.data().unique().sort().each( function ( d, j ) {
			                select.append( '<option value="'+meses[d]+'">'+meses[d]+'</option>' )
			            });
		            });

					var api = this.api();
		            api.$('a').click( function () {
		                renderDiaPorMes(this.id);
		            });            
		        },
		        dom: 'Bfrtip',
		        buttons: [
			        'csv',
			        'excel',
			        'pdf',
			        { extend: 'colvis', text: 'Visualizar Colunas' },			        
			        { extend: 'print', text: 'Imprimir' }
			    ],
				pageLength: 12,
				lengthChange: false, // não mostar resultados por página
				aaSorting: [], // não define por qual coluna deve ordernar		
				ajax: {
			        url: '/charts/graficojsonPorMes',
			        dataSrc: ''
			    },
			    columns: [ 
			    	{ 
			    		data: "mes",
			    		render: function(data, type, row) {
			    			return "<a id=" + data + ">" + meses[data] + "</a>";
			    		}  
			    	},
			    	{ 
			    		data: "quantidade",
			    		render: function(data, type, row) {
			    			return "<p style=margin:0px class='qtd'>" + data + "</p>"; // tirar margem do p do bootstrap e adicionar classe para o elemento na linha
			    		},
			    	} 
			    ]
			});
		}
		renderMes();

		function renderDiaPorMes(dia) {
			$("#data").text("Dia");
			var table = $("#table").DataTable({		
				initComplete: function () {
					bindEdit();

					this.api().columns([0]).every( function () {
		                var column = this;
		                var select = $('<button style="margin-left:5px" class="dt-button" value="">Voltar</select>')
		                    .appendTo( $("#table_filter") )
		                    .on('click', function () {
		                        renderMes();
		                    });
		            });
				},		
				dom: 'Bfrtip',
		        buttons: [
			        'csv',
			        'pdf',
			        'excel',
			        { extend: 'colvis', text: 'Visualizar Colunas' },			        
			        { extend: 'print', text: 'Imprimir' }
			    ],
				pageLength: 31,
				lengthChange: false, // não mostar resultados por página
				aaSorting: [], // não define por qual coluna deve ordernar			
				ajax: {
			        url: '/charts/graficojsonPorDiaMes/' + dia,
			        dataSrc: ''
			    },
			    columns: [ 
			    	{ 
			    		data: "dia",  
			    	},
			    	{ 
			    		data: "quantidade",
			    		render: function(data, type, row) {
			    			return "<p style=margin:0px class='edit' id=" + row.id + ">" + data + "</p>"; // tirar margem do p do bootstrap e adicionar classe para o elemento na linha
			    		},
			    	} 
			    ]
			});
		}

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
	});
	/*$("#table").hide();
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
	});	*/
</script>
@endsection