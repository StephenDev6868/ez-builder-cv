(function($) {
    "use strict"; // Start of use strict


    $('.owl-carousel').owlCarousel({
        loop: false,
        margin: 15,
        nav: false,
        autoplay: true,
        autoplayTimeout: 3000,
        responsive: {
            0: {
                items: 4
            },
            600: {
                items: 6
            },
            1000: {
                items: 10
            }
        }
    });

})(jQuery); // End of use strict