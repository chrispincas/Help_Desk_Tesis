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
	series: [
		{
			name: 'Total',
			data: [10]
		},
		{
			name: 'Abiertos',
			data: [ 1]
		},
		{
			name: 'Cerrados',
			data: [ 9]
		}
	],
	colors: ['#435ebe','#f44336','#4caf50'],
	xaxis: {
		categories: ["Total"],
	},
}

let optionsTicketsGroup = {
	series: [90, 55, 13, 43, 22,10],
	chart: {
		width: 380,
		type: 'pie',
	},
	labels: ['Soportes', 'Peticiones', 'Quejas', 'Reclamos', 'Solicitudes', 'Denuncias'],
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