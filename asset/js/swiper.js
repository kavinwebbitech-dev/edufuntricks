const cards = document.querySelectorAll(".swiper-card");
const nextBtn = document.getElementById("nextBtn");
const prevBtn = document.getElementById("prevBtn");

let currentIndex = 0;
let autoPlayInterval;

function updateCards() {
  cards.forEach((card, index) => {
    card.className = "swiper-card hidden"; // Reset

    if (index === currentIndex) {
      card.className = "swiper-card pos-1";
    } else if (index === (currentIndex + 1) % cards.length) {
      card.className = "swiper-card pos-2";
    } else if (index === (currentIndex - 1 + cards.length) % cards.length) {
      card.className = "swiper-card pos-3";
    }
  });
}

// Next button
nextBtn.addEventListener("click", () => {
  currentIndex = (currentIndex + 1) % cards.length;
  updateCards();
});

// Previous button
prevBtn.addEventListener("click", () => {
  currentIndex = (currentIndex - 1 + cards.length) % cards.length;
  updateCards();
});

// Click background cards
cards.forEach((card, index) => {
  card.addEventListener("click", () => {
    if (index !== currentIndex) {
      currentIndex = index;
      updateCards();
    }
  });

  // Pause autoplay on hover
  card.addEventListener("mouseenter", stopAutoPlay);
  card.addEventListener("mouseleave", startAutoPlay);
});

// Autoplay function
function startAutoPlay() {
  autoPlayInterval = setInterval(() => {
    currentIndex = (currentIndex + 1) % cards.length;
    updateCards();
  }, 3000); // 3 seconds
}

// Stop autoplay
function stopAutoPlay() {
  clearInterval(autoPlayInterval);
}

// Start autoplay initially
startAutoPlay();

updateCards();


