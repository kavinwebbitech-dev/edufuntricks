  @extends('frontend.layouts.app')

  @section('content')
      <section class="common-page-banner text-center">
          <div class="container">
              <!-- Dynamic Breadcrumbs -->
              <nav aria-label="breadcrumb" class="mt-5">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                      <!-- Change 'About Us' to your current page name -->
                      <li class="breadcrumb-item active" aria-current="page">TESTIMONIALS</li>
                  </ol>
              </nav>

              <!-- Dynamic Title -->
              <!-- Use the <span> tag for words you want italicized -->
              <h1 class="page-title">TESTIMONIALS</h1>

              <div class="title-accent"></div>
          </div>
      </section>
      <!-- End of Common Banner -->

      <!-- 1 -->
      <section class="mt-5">
          <div class="discovery-module">
              <div class="container-fluid">

                  <div class="container d-flex justify-content-between align-items-end mb-4">
                      <div>
                          <span class="discovery-tag">Testimonials</span>
                          <h2 class="discovery-title">
                              Voices of Our Shared <span class="discovery-italic">Discovery</span>
                          </h2>
                      </div>
                  </div>

                  {{-- <div class="swiper et-main-slider-viewport">
                      <div class="swiper-wrapper">
                          <!-- Slide 1 -->
                          <div class="swiper-slide h-auto">
                              <div class="et-testimonial-card-frame">
                                  <div>
                                      <div class="et-quote-visual-indicator"><i class="bi bi-quote"></i></div>
                                      <p class="et-feedback-body-copy">"The ISRO visit was a life-changing experience for
                                          our science batch. Seeing the rockets up close ignited a passion for aerospace
                                          that no textbook could ever replicate."</p>
                                  </div>
                                  <div class="et-author-meta-block">
                                      <img src="https://i.pravatar.cc/150?u=a" class="et-author-profile-img" alt="Reviewer">
                                      <div>
                                          <h4 class="et-author-display-name">Dr. Aruna Reddy</h4>
                                          <span class="et-author-professional-title">HOD Science, National Public
                                              School</span>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <!-- Slide 2 -->
                          <div class="swiper-slide h-auto">
                              <div class="et-testimonial-card-frame">
                                  <div>
                                      <div class="et-quote-visual-indicator"><i class="bi bi-quote"></i></div>
                                      <p class="et-feedback-body-copy">"Managing 120 students across three cities seemed
                                          impossible, but Edufun handled the logistics with surgical precision. The safety
                                          protocols were world-class."</p>
                                  </div>
                                  <div class="et-author-meta-block">
                                      <img src="https://i.pravatar.cc/150?u=b" class="et-author-profile-img" alt="Reviewer">
                                      <div>
                                          <h4 class="et-author-display-name">Mark Thompson</h4>
                                          <span class="et-author-professional-title">Coordinator, International School of
                                              Mysore</span>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <!-- Slide 3 -->
                          <div class="swiper-slide h-auto">
                              <div class="et-testimonial-card-frame">
                                  <div>
                                      <div class="et-quote-visual-indicator"><i class="bi bi-quote"></i></div>
                                      <p class="et-feedback-body-copy">"Our students came back from the Hampi trail with a
                                          profound respect for architecture. The storytelling approach of the guides made
                                          history truly come alive."</p>
                                  </div>
                                  <div class="et-author-meta-block">
                                      <img src="https://i.pravatar.cc/150?u=c" class="et-author-profile-img" alt="Reviewer">
                                      <div>
                                          <h4 class="et-author-display-name">Ananya Joshi</h4>
                                          <span class="et-author-professional-title">Social Studies Teacher,
                                              Presidency</span>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <!-- Slide 4 -->
                          <div class="swiper-slide h-auto">
                              <div class="et-testimonial-card-frame">
                                  <div>
                                      <div class="et-quote-visual-indicator"><i class="bi bi-quote"></i></div>
                                      <p class="et-feedback-body-copy">"The industrial visit to the automated manufacturing
                                          plant provided practical insights into robotics that perfectly aligned with our
                                          current semester curriculum."</p>
                                  </div>
                                  <div class="et-author-meta-block">
                                      <img src="https://i.pravatar.cc/150?u=d" class="et-author-profile-img" alt="Reviewer">
                                      <div>
                                          <h4 class="et-author-display-name">Kevin Peters</h4>
                                          <span class="et-author-professional-title">Engineering Faculty, VIT
                                              University</span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- Pagination dots -->
                      <div id="et-custom-pagination-dots" class="swiper-pagination"></div>
                  </div> --}}

                  <div class="et-gallery-grid" id="et-gallery">

                      @foreach ($testimonials as $index => $item)
                          <div class="et-frame-wrapper et-frame-click" data-index="{{ $index }}"
                              data-img="{{ $item->image ? asset('storage/' . $item->image) : 'https://i.pravatar.cc/300?u=' . $item->id }}">

                              <div class="et-wood-frame">
                                  <div class="et-frame-content">
                                      <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://i.pravatar.cc/300?u=' . $item->id }}"
                                          alt="Testimonial Image">
                                  </div>
                              </div>

                          </div>
                      @endforeach

                  </div>
                  <div id="et-lightbox-overlay" onclick="closeEtLightbox()">

                      <button class="et-nav-btn et-prev" onclick="changeImage(-1, event)">&#10094;</button>

                      <div class="et-lightbox-container" onclick="event.stopPropagation()">
                          <span class="et-close-x" onclick="closeEtLightbox()">&times;</span>
                          <img id="et-lightbox-img" src="" alt="Testimonial View">
                      </div>

                      <button class="et-nav-btn et-next" onclick="changeImage(1, event)">&#10095;</button>
                  </div>


        </section><br>



      {{-- <script>
          document.addEventListener('DOMContentLoaded', function() {
              // Swiper logic with Autoplay enabled
              const edufunTestimonialCarousel = new Swiper('.et-main-slider-viewport', {
                  slidesPerView: 1,
                  spaceBetween: 30,
                  loop: true,
                  grabCursor: true,
                  autoplay: {
                      delay: 5000, // Slides change every 5 seconds
                      disableOnInteraction: false, // Keeps sliding even after user interaction
                  },
                  pagination: {
                      el: '#et-custom-pagination-dots',
                      clickable: true,
                  },
                  breakpoints: {
                      768: {
                          slidesPerView: 2
                      },
                      1024: {
                          slidesPerView: 3
                      }
                  }
              });
          });
      </script> --}}
      <script>
          document.addEventListener('DOMContentLoaded', function() {

              const overlay = document.getElementById('et-lightbox-overlay');
              const lightboxImg = document.getElementById('et-lightbox-img');
              const cards = document.querySelectorAll('.et-frame-click');

              let currentIndex = 0;

              cards.forEach((card, index) => {
                  card.addEventListener('click', () => {
                      currentIndex = index;
                      showImage();
                      overlay.classList.add('active');
                      document.body.style.overflow = 'hidden';
                  });
              });

              function showImage() {
                  const img = cards[currentIndex].getAttribute('data-img');
                  lightboxImg.src = img;
              }

              window.closeEtLightbox = function() {
                  overlay.classList.remove('active');
                  lightboxImg.src = '';
                  document.body.style.overflow = 'auto';
              }

              window.changeImage = function(step, e) {
                  if (e) e.stopPropagation();

                  currentIndex += step;

                  if (currentIndex >= cards.length) currentIndex = 0;
                  if (currentIndex < 0) currentIndex = cards.length - 1;

                  showImage();
              }

          });
      </script>
  @endsection
