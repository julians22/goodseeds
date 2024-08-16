import Splide from '@splidejs/splide';
// Default theme
import '@splidejs/splide/css';

const initSplide = (element, options) => {
    // Check if the element exists
    if (!element) {
        return;
    }

    // Create a new Splide instance
    let splide = new Splide(element, options);
    return splide.mount();
}

window.initSplide = initSplide;
