@extends('layouts.layout')

@section('content')
    <h1 class="jumbotron">Gráfico de Barras</h1>
    <div id="ajaxloader" hidden="hidden"></div>
    <div id="chart-div"></div>
@endsection

@section('footer')
<script>
	$("#link-barra").addClass("active");
	var jsonBar = null;
	var jsonMes = [];
	var meses = ['', 'Janeiro', 'Fevereiro', 'Março', 'Abril', "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
	var cor = ['#C1232B','#B5C334','#FCCE10','#E87C25','#27727B', '#FE8463','#9BCA63','#FAD860','#F3A43B','#60C0DD', '#D7504B','#C6E579','#F4E001','#F0805A','#26C0C0'];
        
    var myChart = null;
 	
    function getOptionBarra(data) {
    	var labels = [];
		var qtds = [];
		// parse data 
		data.forEach(function(d){
			labels.push(meses[d.mes]);
			qtds.push(d.quantidade);
		});
    	var option = {
			title : {
				x: 'center',
		        text: 'Gráfico Por Mês',
		    },
		    toolbox: {
		        show : true,
		        feature : {
		            dataView : { show: true, readOnly: false, title: 'Dados' },
		            magicType : { show: true, type: ['line', 'bar'], title: { line: "Linha", bar: "Barra" } },
		            restore : { show: true, title: 'Restaurar' },
		            saveAsImage : { show: true, title: "Salvar" }
		        }
		    },
            tooltip: {
                show: true
            },
            legend: {
                data: ['Quantidade'],
                show: false
            },
            xAxis : [
                {
                    type : 'category',
                    data : labels
                }
            ],
            yAxis : [
                {
                    type : 'value'
                }
            ],
            series : [
                {
                    name: "Quantidade",
                    type: "bar",
                    data: qtds,
                    /*markLine : {
		                data : [
		                    { type : 'average', name: 'Média' }
		                ]
		            },
		            markPoint : {
		                data : [
		                    { type : 'max', name: 'Máximo' },
		                    { type : 'min', name: 'Mínimo' }
		                ]
		            },*/
		            itemStyle: {
		                normal: {
		                    color: function(params) {
		                        // build a color map as your need.
		                        var colorList = cor;
		                        return colorList[params.dataIndex]
		                    },
		                    label: {
		                        show: true,
		                        position: 'top',
		                        formatter: '{b}\n{c}'
		                    }
		                }
		            },
                }
            ]
        };
        return option;
    }

    function getOptionBarraDia(data, mes) {
    	var labels = [];
		var qtds = [];
		// parse data 
		data.forEach(function(d){
			labels.push("Dia " + d.dia);
			qtds.push(d.quantidade);
		});
    	var option = {
			title : {
				x: 'center',
		        text: 'Gráfico Por Dia / Mês',
		    },
		    toolbox: {
		        show : true,
		        feature : {
		            dataView : { show: true, readOnly: false, title: 'Dados' },
		            magicType : { show: true, type: ['line', 'bar'], title: { line: "Linha", bar: "Barra" } },
		            restore : { show: true, title: 'Restaurar' },
		            saveAsImage : { show: true, title: "Salvar" }
		        }
		    },
            tooltip: {
                show: true
            },
            legend: {
                data: ['Quantidade'],
                show: false
            },
            xAxis : [
                {
                    type : 'category',
                    data : labels,
                    axisLabel: {
		                // force to display all labels
		                interval: 0,
		                formatter: function(d) {
		                    return d;
		                }
		            }
                }
            ],
            yAxis : [
                {
                    type : 'value'
                }
            ],
            series : [
                {
                    name: "Quantidade",
                    type: "bar",
                    data: qtds,
		            itemStyle: {
		                normal: {
		                    color: cor[mes - 1],
		                    label: {
		                        show: true,
		                        position: 'top',
		                        formatter: '{b}\n{c}'
		                    }
		                }
		            },
                }
            ]
        };
        return option;
    }

	function getDadosBar(){
		$("#chart-div").append('<div id="main" style="height:400px"></div>');
    	myChart = echarts.init(document.getElementById('main')); 
		if(jsonBar == null) {
			$("#ajaxloader").show();
			$.ajax({
				url: '/charts/graficojsonPorMes',
				type: 'get',
				success: function(data){					
					jsonBar = data;
					$("#ajaxloader").hide();
					
					var opt = getOptionBarra(data);				
			        // Load data into the ECharts instance 
			        myChart.setOption(opt); 		        
				}
			});
		} else {
			var opt = getOptionBarra(jsonBar);				
	        // Load data into the ECharts instance 
	        myChart.setOption(opt); 
		}

		myChart.on("click", function(param){
        	mes = param.dataIndex + 1;
        	$("#main").remove();
        	$("#ajaxloader").show();
        	if(jsonMes[mes] == undefined) {
				$.ajax({
					url: '/charts/graficojsonPorDiaMes/' + mes,
					type: 'get',
					success: function(data){
						console.log(jsonMes[mes]);
						renderBarDia(data, mes)
						jsonMes[mes] = data;
						$("#ajaxloader").hide();
					}
				});
			} else {
				renderBarDia(jsonMes[mes], mes);
				$("#ajaxloader").hide();
			}
        });
	}

    function renderBarDia(data, mes){
    	console.log(jsonMes[mes])
		$("#chart-div").append('<div id="main" style="height:400px"></div>');
    	myChart = echarts.init(document.getElementById('main')); 
		opt = getOptionBarraDia(data, mes);
		 // Load data into the ECharts instance 
		myChart.setOption(opt); 
		myChart.on("click", function(param){
			$("#main").remove();
	    	$("#ajaxloader").show();
	    	getDadosBar();
	    	$("#ajaxloader").hide();
	    });   	
	}

	getDadosBar();
</script>
@endsection