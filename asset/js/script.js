// nav bar
window.addEventListener("scroll", function () {
  const header = document.querySelector("header");
  header.classList.toggle("scrolled", window.scrollY > 50);
});

// Local Video Mute Toggle Logic
const bgVideo = document.getElementById("bgVideo");
const muteToggle = document.getElementById("muteToggle");
const muteIcon = document.getElementById("muteIcon");

muteToggle.addEventListener("click", () => {
  if (bgVideo.muted) {
    bgVideo.muted = false;
    muteIcon.classList.replace("bi-volume-mute-fill", "bi-volume-up-fill");
    muteToggle.innerHTML =
      '<i class="bi bi-volume-up-fill me-2"></i> AUDIO: ON';
  } else {
    bgVideo.muted = true;
    muteIcon.classList.replace("bi-volume-up-fill", "bi-volume-mute-fill");
    muteToggle.innerHTML =
      '<i class="bi bi-volume-mute-fill me-2"></i> AUDIO: OFF';
  }
});

// about

// Parallax Watermark
window.addEventListener("scroll", () => {
  const watermark = document.querySelector(".huge-watermark");
  const scrolled = window.pageYOffset;
  watermark.style.transform = `translate(-50%, calc(-50% + ${scrolled * 0.1}px)) rotate(-15deg)`;
});

// why choose us
const observer = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) entry.target.classList.add("visible");
    });
  },
  { threshold: 0.1 },
);

document.querySelectorAll(".reveal").forEach((el) => observer.observe(el));

// gallery
const gallerySwiper = new Swiper(".gallerySwiper", {
  slidesPerView: 1.2, // Shows a peak of the next card on mobile
  spaceBetween: 20,
  loop: true,
  centeredSlides: false,
  grabCursor: true,
  watchSlidesProgress: true,
  speed: 1000, // Smooth slow transition
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".slide-next",
    prevEl: ".slide-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    dynamicBullets: true,
  },
  breakpoints: {
    768: {
      slidesPerView: 2.2,
      spaceBetween: 30,
    },
    1200: {
      slidesPerView: 3.5, // 3 full cards + half of the 4th bleeding off the edge
      spaceBetween: 40,
    },
  },
});

// our programs 2

// testimonials
document.addEventListener("DOMContentLoaded", function () {
  // Swiper logic with Autoplay enabled
  const edufunTestimonialCarousel = new Swiper(".et-main-slider-viewport", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    grabCursor: true,
    autoplay: {
      delay: 5000, // Slides change every 5 seconds
      disableOnInteraction: false, // Keeps sliding even after user interaction
    },
    pagination: {
      el: "#et-custom-pagination-dots",
      clickable: true,
    },
    breakpoints: {
      768: { slidesPerView: 2 },
      1024: { slidesPerView: 3 },
    },
  });
});
