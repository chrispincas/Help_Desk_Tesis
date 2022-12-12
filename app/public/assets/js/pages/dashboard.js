console.log(json_tickets_category)

let optionsProfileVisit = {
	annotations: {
		position: 'back'
	},
	dataLabels: {
		enabled:false
	},
	chart: {
		type: 'bar',
		height: 300
	},
	fill: {
		opacity:1
	},
	plotOptions: {
	},
	series: json_ticket_status,
	colors: ['#435ebe','#f44336','#4caf50'],
	xaxis: {
		categories: ["Total"],
	},
	yaxis: [
		{
			labels: {
				formatter: function(val) {
					return val.toFixed(0);
				}
			}
		}
	]
}

let series = []
let labels = []

json_tickets_category.forEach(element => {
	series.push(element.data[0])
	labels.push(element.name)
});
console.log(series)
let optionsTicketsGroup = {
	series: series,
	chart: {
		type: 'pie',
	},
	labels: labels,
	responsive: [{
		breakpoint: 480,
		options: {
			chart: {
				width: 200
			},
			legend: {
				position: 'bottom'
			}
		}
	}]
}

let chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit)
let chartPie = new ApexCharts(document.querySelector("#chart-pie"), optionsTicketsGroup)

chartProfileVisit.render()
chartPie.render()