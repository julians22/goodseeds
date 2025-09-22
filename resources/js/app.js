// import slick css via JS so Vite handles it (avoids @charset conflicts)
import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';

// your existing imports
import './bootstrap';
import './plugin';

import $ from 'jquery';
window.$ = window.jQuery = $;

// now import slick JS
import 'slick-carousel';

$('.clients-slider').slick({
    infinite: true,
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    dots: false,
    arrows: true,
    prevArrow: $('.custom-prev'),
    nextArrow: $('.custom-next'),
    responsive: [
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        }
    ]
});


