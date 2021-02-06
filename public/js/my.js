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
/*$('table.pm').addClass("table table-borderless");
$('input.bbcodes').addClass("btn btn-success");
$('input[type="checkbox"]').addClass("form-check-input");
$('input[name="recip"]').addClass("md-form");
$(document).ready(function() {
    $('[name="mass_action"]').materialSelect();
    $('[name="recip"]').materialSelect();
});*/
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
        trigger : 'hover'
    })
})
/*$(function () {
    $('.pop')
        .hover(function () {
            $('[data-toggle="tooltip"]').tooltip('dispose')
                var el = $(this);
                var newId = el.context.id;
                //console.log(this)
                $.post('engine/ajax/poppover.php', {idNews: newId}, function (data) {
                    //console.log(data)
                    var result = jQuery.parseJSON(data);
                    //console.log(result)
                    var title = result['title'];
                    var template = '<h5>'+result['title']+'</h5></br>'+result['descr']
                    $('#' + newId).tooltip({title: template, trigger : 'hover'}).tooltip('show')
                    //$('#' + newId).attr('data-original-title', template).tooltip('show');
                })
            }, function () {
            $('[data-toggle="tooltip"]').tooltip('dispose')
            }
        )
})*/
/*
new WOW().init();*/