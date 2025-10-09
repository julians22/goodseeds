import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';

import './bootstrap';
import './plugin';

import $ from 'jquery';
window.$ = window.jQuery = $;

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

$(document).ready(function() {
    const $home = $('#carouselHome');

    if ($home.length) {
        $home.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            adaptiveHeight: true,
            infinite: true,
            autoplay: false,
            speed: 600,
            prevArrow: $('.custom-prev-home'),
            nextArrow: $('.custom-next-home'),
            draggable: true
        });

        const slickObj = $home.slick('getSlick');
        const videos = $home.find('video.banner-video');
        let imageTimer = null;
        let isProgrammatic = false; 
        const clearImageTimer = () => {
            if (imageTimer) {
                clearTimeout(imageTimer);
                imageTimer = null;
            }
        };

        const pauseAllVideos = () => {
            videos.each(function() {
                try { this.pause(); } catch (e) {}
            });
        };

        const nextSlide = () => {
            clearImageTimer();
            isProgrammatic = true; 
            $home.slick('slickNext');
        };

        videos.each(function() {
            const v = this;
            try {
                v.muted = true;
                v.playsInline = true;
                v.setAttribute('webkit-playsinline', '');
                v.preload = 'metadata';
                v.controls = false;
                v.controlsList = 'nodownload nofullscreen noremoteplayback';
                v.style.pointerEvents = 'none';
            } catch (e) {}
            if (!v._endedAttached) {
                v.addEventListener('ended', () => {
                    setTimeout(() => nextSlide(), 250);
                });
                v._endedAttached = true;
            }
        });

        $home.on('beforeChange', function(event, slick, currentSlide, nextSlideIndex) {
            clearImageTimer();
            const $curr = $(slick.$slides.get(currentSlide));
            const vid = $curr.find('video.banner-video').get(0);
            if (vid) {
                try { vid.pause(); } catch (e) {}
            }
        });

        $home.on('afterChange', function(event, slick, currentSlide) {
            clearImageTimer();
            pauseAllVideos();

            const $active = $(slick.$slides.get(currentSlide));
            const vid = $active.find('video.banner-video').get(0);

            if (vid) {
                try {
                    if (isProgrammatic) {
                        try { vid.currentTime = 0; } catch (e) {}
                    }
                    const playPromise = vid.play();
                    if (playPromise && playPromise.catch) playPromise.catch(() => {});
                    if (vid.ended || (vid.duration && vid.currentTime >= (vid.duration - 0.25))) {
                        setTimeout(() => nextSlide(), 250);
                    } else {
                        if (!vid._timeUpdateAttached) {
                            const onTimeUpdate = function() {
                                if (vid.duration && (vid.currentTime >= vid.duration - 0.25)) {
                                    vid.removeEventListener('timeupdate', onTimeUpdate);
                                    nextSlide();
                                }
                            };
                            vid.addEventListener('timeupdate', onTimeUpdate);
                            vid._timeUpdateAttached = true;
                        }
                    }
                } catch (e) {}
            } else {
                imageTimer = setTimeout(() => nextSlide(), 3000);
            }

            setTimeout(() => { isProgrammatic = false; }, 100);
        });

        const initIndex = 0;
        const slickSlides = slickObj.$slides;
        if (slickSlides && slickSlides.length) {
            const $initial = $(slickSlides.get(initIndex));
            const initialVid = $initial.find('video.banner-video').get(0);
            if (initialVid) {
                try {
                    initialVid.currentTime = 0;
                    const p = initialVid.play();
                    if (p && p.catch) p.catch(() => {});
                } catch (e) {}
            } else {
                imageTimer = setTimeout(() => nextSlide(), 3000);
            }
        }
    }
});