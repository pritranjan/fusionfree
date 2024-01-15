


$(function () {

  $('.form-control').on('focusin', function () {
    // Add your custom class when the input is focused
    $(this).closest('span').prev('label').addClass('text-primary');
  });

  // Optionally, you can remove the custom class on focusout
  $('.form-control').on('focusout', function () {
    // Remove the custom class when the input loses focus
    $(this).closest('span').prev('label').removeClass('text-primary');
  });

  function manageHoverEffectOfSwiper(swiperInstance) {
    // Pause on mouse enter
    var swiperContainer = document.querySelector('.swiper');

    swiperContainer.addEventListener('mouseenter', function () {
      swiperInstance.autoplay.stop();
    });

    // Resume on mouse leave
    swiperContainer.addEventListener('mouseleave', function () {
      swiperInstance.autoplay.start();
    });
  }

  // Init Client slider
  const ourClientsSlider = new Swiper('.js-our-clients-slider', {
    slidesPerView: 2.5,
    slidesPerGroup: 1,
    loop: true,
    centeredSlides: true,
    speed: 2000,
    autoplay: {
      delay: 1500,
      disableOnInteraction: false,
      pauseOnMouseEnter: 1
    },
    breakpoints: {
      640: {
        slidesPerView: 4.5,
      },
      1024: {
        slidesPerView: 6.5,
      },
    },
  });

  // Init Testimonial slider
  const testimonialSlider = new Swiper('.js-testimonial-slider', {
    slidesPerView: 1,
    slidesPerGroup: 1,
    loop: true,
    speed: 2000,
    autoplay: {
      delay: 1500,
      disableOnInteraction: false,
      pauseOnMouseEnter: 1
    },
    pagination: {
      el: '.js-testimonials-pagination',
    },
  });


  // Our Porjects Slider 
  var projectSlider = new Swiper(".js-projects-slider", {
    loop: true,
    slidesPerGroup: 1,
    speed: 2000,
    autoplay: {
      delay: 1500,
      disableOnInteraction: false,
      pauseOnMouseEnter: 1,
    },
    pagination: {
      el: ".swiper-pagination",
    },
    navigation: {
      nextEl: '.js-view-next-project-slide'
    },
  });
  // manageHoverEffectOfSwiper(projectSlider);
});
