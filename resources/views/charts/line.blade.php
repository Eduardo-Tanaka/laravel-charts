@extends('layouts.layout')

@section('content')
    <h1 class="jumbotron">Lista Por Mês</h1>
    <div id="chart-div">
    </div>
    <div id="ajaxloader" hidden="hidden"></div>
@endsection

@section('footer')
<script>
	var jsonBar = null;
	var jsonLine = null;
	var mesAntigo = null;
	var meses = ['', 'Janeiro', 'Fevereiro', 'Março', 'Abril', "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
	var cor = [ '', 'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)' ];
	var bkg = [ '', 'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)' ];

	function getDadosLine(mes){
		if(mesAntigo != mes) {
			$("#ajaxloader").show();
			$.ajax({
				url: '/charts/graficojsonline/' + mes,
				type: 'get',
				success: function(data){
					jsonLine = data;
					mesAntigo = mes;
					renderLine(jsonLine);
					$("#ajaxloader").hide();
				}
			});
		} else {
			renderLine(jsonLine);
		}
	}

	function renderLine(dados) {
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
		    type: 'bar',
		    data: {
		        labels: labels,
			    datasets: [
			        {
				        label: "quantidade",
			            backgroundColor: cor[dados[0].mes],
			            borderColor: bkg[dados[0].mes],
			            borderWidth: 1,
			            data: qtds,
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
		        		//myChart.destroy();
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
		        /*tooltips: {
	                enabled: true,
	                mode: 'single',
	                callbacks: {
	                    label: function(tooltipItems, data) { 
	                    	console.log(tooltipItems.yLabel);
	                    	console.log(data);
	                        return tooltipItems.yLabel + 'Dia: ' + tooltipItems.xLabel;
	                    }
	                }
	            },*/
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
		    type: 'bar',
		    data: {
		        labels: labels,
			    datasets: [
			        {
			            label: "quantidade",
			            backgroundColor: [
			                cor[1],
			                cor[2],
			            ],
			            borderColor: [
			                bkg[1],
			                bkg[2],
			            ],
			            borderWidth: 1,
			            data: datas,
			        },
			        /*{
			            label: "azul",
			            backgroundColor: [
			                'rgba(54, 162, 235, 0.2)',
			            ],
			            borderColor: [
			                'rgba(54, 162, 235, 1)',
			            ],
			            borderWidth: 1,
			            data: [59, 99],
			        }*/
			    ]
		    },
		    options: {		    	
		    	onClick: function(evt, item){
		    		console.log(evt);
		    		console.log(item);
		    		if(item.length != 0){
		    			var index = item[0]._index;
						/*console.log(myChart.getElementAtEvent(evt)[0]._datasetIndex);
			    		console.log(this.data.datasets);
			    		var index = myChart.getElementAtEvent(evt)[0]._datasetIndex;
			    		console.log(item[index]);*/
						$("#myChart").remove();
						//myChart.destroy();
			    		getDadosLine(index + 1);
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