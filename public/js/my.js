$("#carousel").owlCarousel({loop: true, items: 8, nav: true, dots: false, autoplay: true});

$(function () {
	$(window).scroll(function () {
		if ($(this).scrollTop() !== 0) {
			$('#toTop').fadeIn();
		} else {
			$('#toTop').fadeOut();
		}
	});
	$('#toTop').click(function () {
		$('body,html').animate({scrollTop: 0}, 800);
	})
});
document.addEventListener("DOMContentLoaded", function () {
	var lazyloadImages;

	if ("IntersectionObserver" in window) {
		lazyloadImages = document.querySelectorAll(".lazy");
		var imageObserver = new IntersectionObserver(function (entries, observer) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					var image = entry.target;
					image.src = image.dataset.src;
					image.classList.remove("lazy");
					imageObserver.unobserve(image);
				}
			});
		});

		lazyloadImages.forEach(function (image) {
			imageObserver.observe(image);
		});
	} else {
		var lazyloadThrottleTimeout;
		lazyloadImages = document.querySelectorAll(".lazy");

		function lazyload() {
			if (lazyloadThrottleTimeout) {
				clearTimeout(lazyloadThrottleTimeout);
			}

			lazyloadThrottleTimeout = setTimeout(function () {
				var scrollTop = window.pageYOffset;
				lazyloadImages.forEach(function (img) {
					if (img.offsetTop < (window.innerHeight + scrollTop)) {
						img.src = img.dataset.src;
						img.classList.remove('lazy');
					}
				});
				if (lazyloadImages.length == 0) {
					document.removeEventListener("scroll", lazyload);
					window.removeEventListener("resize", lazyload);
					window.removeEventListener("orientationChange", lazyload);
				}
			}, 20);
		}

		document.addEventListener("scroll", lazyload);
		window.addEventListener("resize", lazyload);
		window.addEventListener("orientationChange", lazyload);
	}
});
$(function () {
	$('[data-toggle="tooltip"]').tooltip({
		trigger: 'hover'
	})
})

function setMonth() {
	var now = new Date(),
		month = now.getMonth()
	switch (month) {
		case 11:
		case 0:
		case 1:
			document.body.classList.add('winter');
			break;
		case 2:
		case 3:
		case 4:
			document.body.classList.add('spring');
			break;
		case 5:
		case 6:
		case 7:
			document.body.classList.add('summer');
			break;
		case 8:
		case 9:
		case 10:
			document.body.classList.add('autumn');
			break;
	}
}

setMonth();

$('#search').on('keyup', function () {
	$("#search").attr("autocomplete", "off");
	$value = $(this).val();
	$("#searchsuggestions").remove();
	$("body").append("<div id='searchsuggestions' style='display:none'></div>");
	if ($value.length >= 4) {
		$.ajax({
			type: 'get',
			url: '/search',
			data: {'search': $value},
			success: function (data) {
				$("#searchsuggestions").html(data).fadeIn().css({position: "absolute", top: 0, left: 0, display: "block"}).offset({
					top: $('#search').position().top + $('#search').height(),
					left: $('#search').position().left,
				})
			}
		});
	}
})

$(document).mouseup(function (e) {
	var container = $("#searchsuggestions");
	if (container.has(e.target).length === 0) {
		container.hide();
	}
});

$(document).ready(function () {
	$("#editBtn").click(function () {
		if ($("#options").is(":hidden")) {
			$("#options").show("slow");
		} else {
			$("#options").hide("slow");
		}
		return false;
	});
});

$(document).ready(function () {
	$("#sides").click(function () {
		if ($(".side").is(":hidden")) {
			$(".side").show("slow");
			$(".el1").hide("slow");
		} else {
			$(".side").hide("slow");
			$(".el1").show("slow");
		}
		return false;
	});
});

$(document).ready(function () {
	$('.js-selectize').selectize();
});

function ClassicEditorCk(windows, selector) {
	if ($(selector).length) {
		ClassicEditor.create(windows.querySelector(selector), {
			toolbar: ['heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', '|', 'blockQuote', 'undo', 'redo'],
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

ClassicEditorCk(window['comments'], '#addComment');

function textarea(key, login = null, text = null) {
	var div = '#edit_quote_reply_comment-' + key;
	var message = '#description_html-' + key;
	let logins;
	if (login) {
		logins = '<a target="_blank" href="/user/' + login + '">' + login + '</a>' + ', ';
	}
	if ($(div).is(":hidden")) {
		$(message).val(logins);
		ClassicEditorCk(window['edit_quote_reply_comment-' + key], message);
		$(div).show();
	} else {
		$(div).hide();
		window['edit_quote_reply_comment-' + key].querySelector('.ck-rounded-corners').remove();
	}
	return false;
}

feather.replace()