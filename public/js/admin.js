/* globals Chart:false, feather:false */

(function () {
	'use strict'

	feather.replace()

	// Graphs
	var ctx = document.getElementById('myChart')
	if (ctx != null) {
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
	}
})()

$('.js-selectize').selectize();

$('.js-selectize-multiple').selectize({
	plugins: ['remove_button'],
	delimiter: ',',
	persist: false,
	create: function (input) {
		return {
			value: input,
			text: input
		}
	}
});

function ClassicEditorCk(windows, selector) {
	if ($(selector).length) {
		ClassicEditor.create(windows.querySelector(selector), {
			toolbar: ['heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', '|', 'blockQuote', 'undo', 'redo', '|', 'link'],
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
}

ClassicEditorCk(window['descript'], '#description_html');

$('#nameBtn').click(function () {
	var $value = $("#name").val();
	if ($value.length >= 4) {
		$.ajax({
			type: 'get',
			url: '/searchAdmin',
			data: {'search': $value},
			success: function (data) {
				$("#searchsuggestions").html(data).fadeIn()
			}
		});
	}
})

$('#addTrailer').click(function () {
	$("#Trailer").append('<input type="text" id="trailer" class="form-control" name="trailer[]" value="">')
})

$('#addPlayer').click(function () {
	$("#Player").append(
		'<div class="row">\n' +
		'<div class="col-2">\n' +
		'<input type="text" id="name_player" class="form-control" name="name_player[]" value="">\n' +
		'</div>\n' +
		'<div class="col">\n' +
		'<input type="text" id="url_player" class="form-control" name="url_player[]" value="">\n' +
		'</div>\n' +
		'</div>'
	)
})

$('#addOtherLink').click(function () {
	$("#OtherLink").append(
		'<div class="row">\n' +
		'<div class="col-2">\n' +
		'<input type="text" id="otherLink_title" class="form-control" name="otherLink_title[]" value="">\n' +
		'</div>\n' +
		'<div class="col">\n' +
		'<input type="text" id="otherLink_url" class="form-control" name="otherLink_url[]" value="">\n' +
		'</div>\n' +
		'</div>'
	)
})