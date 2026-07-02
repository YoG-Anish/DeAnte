document.addEventListener("DOMContentLoaded", function () {
  // Partners Slider
  var partnerSlider = document.querySelector("#partner-slider");

  if (partnerSlider) {
    var splide = new Splide(partnerSlider, {
      type: "loop",
      drag: "free",
      focus: "center",
      perPage: 8,
      gap: "0px",
      arrows: false,
      pagination: false,
      autoScroll: {
        speed: 1,
        pauseOnHover: false,
        pauseOnFocus: false,
      },
      breakpoints: {
        1200: {
          perPage: 7,
        },
        1080: {
          perPage: 6,
        },
        991: {
          perPage: 5,
        },
        768: {
          perPage: 4,
        },
        640: {
          perPage: 3,
        },
        480: {
          perPage: 2,
        },
        360: {
          perPage: 1.5,
        },
      },
    });

    splide.mount(window.splide.Extensions);
  }

  // Testimonial Slider

  var testimonialSlider = document.querySelector("#testimonial-slider");

  if (testimonialSlider) {
    new Splide("#testimonial-slider", {
      type: "loop",
      rewind: true,
      speed: 1000,
      autoplay: true,
      gap: 20,
      interval: 5000,
      arrows: false,
      pagination: false,
      pauseOnHover: true,
    }).mount();
  }
});