@extends('layouts.layout')

@section('content')
    <h1 class="jumbotron">Gráfico de Linhas</h1>
    <div id="chart-div">
    </div>
    <div id="ajaxloader" hidden="hidden"></div>
@endsection

@section('footer')
<script>
	$("#link-linha").addClass("active");
	var jsonBar = null;
	var jsonLine = null;
	var mesAntigo = null;
	var meses = ['', 'Janeiro', 'Fevereiro', 'Março', 'Abril', "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];

	function getDadosDia(mes){
		if(mesAntigo != mes) {
			$("#ajaxloader").show();
			$.ajax({
				url: '/charts/graficojsonline/' + mes,
				type: 'get',
				success: function(data){
					jsonLine = data;
					mesAntigo = mes;
					renderBarDia(jsonLine);
					$("#ajaxloader").hide();
				}
			});
		} else {
			renderBarDia(jsonLine);
		}
	}

	function renderBarDia(dados) {
		$("#chart-div").append('<canvas id="myChart"></canvas>');
		var ctx = $("#myChart");
		var labels = [];
		var qtds = [];
		// parse data 
		dados.forEach(function(d){
			labels.push("Dia: " + d.dia);
			qtds.push(d.quantidade);
		});
		var myChart = new Chart(ctx, {
		    type: 'line',
		    data: {
		        labels: labels,
			    datasets: [
			        {
				        label: "quantidades",
			            fill: false,
			            lineTension: 0.1,
			            backgroundColor: "rgba(75,192,192,0.4)",
			            borderColor: "rgba(75,192,192,1)",
			            borderCapStyle: 'butt',
			            borderDash: [],
			            borderDashOffset: 0.0,
			            borderJoinStyle: 'miter',
			            pointBorderColor: "rgba(75,192,192,1)",
			            pointBackgroundColor: "#fff",
			            pointBorderWidth: 2,
			            pointHoverRadius: 5,
			            pointHoverBackgroundColor: "rgba(75,192,192,1)",
			            pointHoverBorderColor: "rgba(220,220,220,1)",
			            pointHoverBorderWidth: 2,
			            pointRadius: 1,
			            pointHitRadius: 10,
			            data: qtds,
			            spanGaps: false,
				    }
			    ]
		    },
		    options: {
		    	title:{
                    display: true,
                    text: "Produção por Dia - " + meses[dados[0].mes]
                },
	        	onClick: function(evt, item) {
	        		console.log(evt);
		    		console.log(item);
		    		if(item.length != 0){
		        		$("#myChart").remove();
			    		getDadosBar();
			    	}
	        	},
	        	scales: {
		           xAxes: [{
		        		scaleLabel: {
					        display: true,
					        labelString: 'Dias'
					    },
		        	}],
		            yAxes: [{
		            	scaleLabel: {
					        display: true,
					        labelString: 'Quantidades'
					    },
		                ticks: {
		                    beginAtZero:true
		                }
		            }]
		        },
	        }
		});
	}

	function getDadosBar(){
		if(jsonBar == null) {
			$("#ajaxloader").show();
			$.ajax({
				url: '/charts/graficojsonbar',
				type: 'get',
				success: function(data){
					jsonBar = data;
					renderBar(jsonBar);
					$("#ajaxloader").hide();
				}
			});
		} else {
			renderBar(jsonBar);
		}
	}

	function renderBar(dados){
		$("#chart-div").append('<canvas id="myChart"></canvas>');
		var ctx = $("#myChart");
		var labels = [];
		var datas = [];
		// parse data 
		dados.forEach(function(d){
			labels.push(meses[d.mes]);
			datas.push(d.quantidade);
		});

		var myChart = new Chart(ctx, {
		    type: 'line',
		    data: {
		        labels: labels,
			    datasets: [
			        {
			            label: "quantidades",
			            fill: false,
			            lineTension: 0.1,
			            backgroundColor: "rgba(75,192,192,0.4)",
			            borderColor: "rgba(75,192,192,1)",
			            borderCapStyle: 'round',
			            borderDash: [],
			            borderDashOffset: 0.0,
			            borderJoinStyle: 'miter',
			            pointBorderColor: "rgba(75,192,192,1)",
			            pointBackgroundColor: "#fff",
			            pointBorderWidth: 2,
			            pointHoverRadius: 5,
			            pointHoverBackgroundColor: "rgba(75,192,192,1)",
			            pointHoverBorderColor: "rgba(220,220,220,1)",
			            pointHoverBorderWidth: 1,
			            pointRadius: 1,
			            pointHitRadius: 10,
			            data: datas,
			            spanGaps: false,
        			}
			    ]
		    },
		    options: {		    	
		    	onClick: function(evt, item){
		    		console.log(evt);
		    		console.log(item);
		    		if(item.length != 0){
		    			var index = item[0]._index;
						$("#myChart").remove();
			    		getDadosDia(index + 1);
					} 
		    	},
		    	title:{
                    display: true,
                    text: "Produção por Mês"
                },
		        scales: {
		        	xAxes: [{
		        		scaleLabel: {
					        display: true,
					        labelString: 'Meses'
					    },
		        	}],
		            yAxes: [{
		            	scaleLabel: {
					        display: true,
					        labelString: 'Quantidades'
					    },
		                ticks: {
		                    beginAtZero:true
		                }
		            }]
		        }
		    }
		});
	}

	getDadosBar();
</script>
@endsection