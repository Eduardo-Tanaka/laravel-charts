@extends('layouts.layout')

@section('content')
    <h1 class="jumbotron">LINES</h1>
    <div id="chart-div">
        
    </div>

@endsection

@section('footer')
<script>
	function renderLine() {
		$("#chart-div").append('<canvas id="myChart"></canvas>');
		var ctx = $("#myChart");
		var myChart = new Chart(ctx, {
		    type: 'line',
		    data: {
		        labels: ["01", "02", "03", "04", "05", "06", "07", "08", "09"],
			    datasets: [
			        {
				        label: "My First dataset",
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
				        pointBorderWidth: 1,
				        pointHoverRadius: 5,
				        pointHoverBackgroundColor: "rgba(75,192,192,1)",
				        pointHoverBorderColor: "rgba(220,220,220,1)",
				        pointHoverBorderWidth: 2,
				        pointRadius: 1,
				        pointHitRadius: 10,
				        data: [65, 59, 80, 81, 56, 55, 40, 15, 66],
				        spanGaps: false,
				    }
			    ]
		    },
		    options: {
	        	onClick: function() {
	        		$("#myChart").remove();
		    		renderBar();
	        	}
	        }
		});
	}

	function renderBar(){
		$("#chart-div").append('<canvas id="myChart"></canvas>');
		var ctx = $("#myChart");
		var myChart = new Chart(ctx, {
		    type: 'bar',
		    data: {
		        labels: ["Janeiro", "Fevereiro"],
			    datasets: [
			        {
			            label: "vermelho",
			            backgroundColor: [
			                'rgba(255, 99, 132, 0.2)',
			            ],
			            borderColor: [
			                'rgba(255,99,132,1)',
			            ],
			            borderWidth: 1,
			            data: [65, 52],
			        },
			        {
			            label: "azul",
			            backgroundColor: [
			                'rgba(54, 162, 235, 0.2)',
			            ],
			            borderColor: [
			                'rgba(54, 162, 235, 1)',
			            ],
			            borderWidth: 1,
			            data: [59, 99],
			        }
			    ]
		    },
		    options: {
		    	onClick: function(evt, item){
		    		console.log(evt);
		    		console.log(item);
		    		console.log(myChart.getElementAtEvent(evt)[0]._datasetIndex);
		    		console.log(this.data.datasets);
		    		var index = myChart.getElementAtEvent(evt)[0]._datasetIndex;
		    		console.log(item[index]);
					$("#myChart").remove();
		    		renderLine();
		    	},
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true
		                }
		            }]
		        }
		    }
		});
	}

	renderBar();
</script>
@endsection

