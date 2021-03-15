/* globals Chart:false, feather:false */

(function () {
	'use strict'

	feather.replace()

	// Graphs
	var ctx = document.getElementById('myChart')
	// eslint-disable-next-line no-unused-vars
	var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: [
				'Sunday',
				'Monday',
				'Tuesday',
				'Wednesday',
				'Thursday',
				'Friday',
				'Saturday'
			],
			datasets: [{
				data: [
					15339,
					21345,
					18483,
					24003,
					23489,
					24092,
					12034
				],
				lineTension: 0,
				backgroundColor: 'transparent',
				borderColor: '#007bff',
				borderWidth: 4,
				pointBackgroundColor: '#007bff'
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: false
					}
				}]
			},
			legend: {
				display: false
			}
		}
	})
})()

$('.js-selectize').selectize();

$('.js-selectize-multiple').selectize({
	plugins: ['remove_button'],
	delimiter: ',',
	persist: false,
	create: function(input) {
		return {
			value: input,
			text: input
		}
	}
});

function ClassicEditorCk(windows, selector){
	ClassicEditor.create(windows.querySelector(selector), {
		toolbar: ['heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', '|', 'blockQuote', 'undo', 'redo' , '|', 'link'],
		language: 'ru',
		heading: {
			options: [
				{model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
				{model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1'},
				{model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2'}
			]
		}
	});
}

ClassicEditorCk(window['descript'], '#description_html');