   @extends('frontend.layouts.app')
   @section('content')
       <main class="banner-section">
           <div class="video-viewport">
               <!-- Update: Standard Video Tag for Local Files -->
               <video id="bgVideo" autoplay loop muted playsinline>
                   <source src="{{ asset('asset/img/banner2.mp4') }}" type="video/mp4">
                   Your browser does not support the video tag.
               </video>
           </div>
           <div class="banner-overlay"></div>

           <!-- <div class="banner-content" data-aos="fade-up" data-aos-duration="1500">
                        <h1 class="banner-headline">EVOLVING<br>THE CORE</h1>
                        <p class="small" style="opacity: 0.5; letter-spacing: 2px;">SYSTEM VERSION 4.0.2 // ACTIVE</p>
                    </div> -->

           <div class="scroll-hint">SCROLL TO EXPLORE</div>

           <button class="mute-btn" id="muteToggle">
               <i class="bi bi-volume-mute-fill me-2" id="muteIcon"></i>
               AUDIO: OFF
           </button>
       </main>


       <!-- intro -->
       <section class="artistic-intro">
           <!-- Fluid background lines -->
           <svg class="bg-curves" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg">
               <path d="M0,100 Q150,50 300,150 T500,100" stroke="#2f7ec6" fill="transparent" stroke-width="0.5" />
               <path d="M0,200 Q200,150 350,250 T500,200" stroke="#5AC9ED" fill="transparent" stroke-width="0.5" />
           </svg>

           <div class="container">
              <div class="row align-items-center">

                <div class="col-lg-7">
                    <div class="content-container">
                        <span class="welcome-tag animate__animated animate__fadeIn">Travel. Learn. Discover.</span>
                        <h1 class="super-title animate__animated animate__fadeInDown">
                            Welcome To <br>
                            <span class="highlight-italic">Edufun Trips</span>
                        </h1>

                        <div class="text-narrative">
                            <p class="animate__animated animate__fadeInUp animate__delay-1s">
                                Edufun Trips is an educational travel company with over <span class="keyword-focus">10 years </span> of experience, aligned with the National Education Policy (NEP) 2020. We collaborate with schools to create safe, structured, and student-focused travel programs that enhance learning beyond the classroom.
                            </p>

                            <p class="animate__animated animate__fadeInUp animate__delay-3s">
                                Our journeys are designed to be curriculum-aligned and experiential, enabling students to gain real-world exposure, strengthen critical thinking, and develop problem-solving skills through practical engagement.
                            </p>

                            <p class="animate__animated animate__fadeInUp animate__delay-4s">
                                By integrating education with purposeful travel, we support holistic development, encouraging curiosity, creativity, and a deeper understanding that contributes to both academic growth and personal development.
                            </p>

                            <!-- Non-boxy location signature -->
                            <!-- <div class="location-signature animate__animated animate__fadeInUp animate__delay-5s">
                                <div class="city-marker">
                                    <div class="pulse-dot"></div>
                                    Bangalore
                                </div>
                                <div class="city-marker">
                                    <div class="pulse-dot" style="background: #2f7ec6;"></div>
                                    New Delhi
                                </div>
                            </div> -->


                            <a href="{{ route('about') }}" class="btn-futuristic animate__animated animate__fadeInUp animate__delay-4s">
                                Learn more
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">

                    <div class="experience-badge">
                        <div class="badge-content">
                            <span class="number">10+</span>
                            <span class="text">Years of<br>Experience</span>
                        </div>
                        <div class="dynamic-shadow"></div>
                    </div>

                    <div class="visual-journey animate__animated animate__zoomIn animate__delay-1s">
                        <div class="organic-image-wrap">
                            <img src="asset/img/img-1.jpg" alt="Student Learning">
                        </div>

                        <!-- Decorative rotating text element -->
                        <svg viewBox="0 0 100 100" class="rotating-circle">
                            <path id="circlePath" d="M 50, 50 m -37, 0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0" fill="transparent" />
                            <text font-size="5" font-weight="800" fill="#000">
                                <textPath xlink:href="#circlePath">
                                    • NEP 2020 INSPIRED • EXPERIENTIAL LEARNING • GUIDED EXPLORATION •
                                </textPath>
                            </text>
                        </svg>
                    </div>
                </div>

            </div>
           </div>
       </section>


       <section class="achievements-integrated-section">
           <div class="light-accent accent-1"></div>
           <div class="light-accent accent-2"></div>

           <div class="main-content">
               <div class="section-top">
                   <span class="impact-badge">Our Legacy</span>
                   <h2 class="main-title">Impact by the Numbers</h2>
               </div>

               <div class="achievements-row">
                   <!-- Column 1 -->
                   <div class="achievement-column">
                       <div class="column-visual">
                           <img src="{{ asset('asset/img/student-male.png') }}" alt="Students">
                       </div>
                       <div class="column-header">
                           <h3>50,000+<br><span>Happy Students</span></h3>
                       </div>
                       <p class="column-text">Fostering curiosity and personal growth through immersive educational
                           experiences that go far beyond the classroom walls.</p>
                   </div>

                   <!-- Column 2 -->
                   <div class="achievement-column">
                       <div class="column-visual">
                           <img src="{{ asset('asset/img/school.png') }}" alt="Schools">
                       </div>
                       <div class="column-header">
                           <h3>50+<br><span>Partner Schools</span></h3>
                       </div>
                       <p class="column-text">Collaborating with leading institutions to deliver safe, curriculum-aligned
                           excursions that enhance academic understanding.</p>
                   </div>

                   <!-- Column 3 -->
                   <div class="achievement-column">
                       <div class="column-visual">
                           <img src="{{ asset('asset/img/globe-earth.png') }}" alt="Destinations">
                       </div>
                       <div class="column-header">
                           <h3>150+<br><span>Global Destinations</span></h3>
                       </div>
                       <p class="column-text">Unlocking world-class learning across iconic historical, scientific, and
                           cultural landmarks across India and the globe.</p>
                   </div>

               </div>
           </div>
       </section>


       <section class="edufun-approach-wrapper">
           <!-- Animation Context -->
           <div class="edufun-animation-layer">
               <svg class="edufun-flight-path" viewBox="0 0 1400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                   <path d="M 0,150 Q 350,0 700,150 T 1400,50" stroke="#5ac9ed" stroke-width="1" stroke-dasharray="10 10"
                       opacity="0.3" />
               </svg>
               <div class="edufun-plane">
                   <svg viewBox="0 0 24 24" fill="currentColor">
                       <path
                           d="M21,16V14L13,9V3.5A1.5,1.5 0 0,0 11.5,2A1.5,1.5 0 0,0 10,3.5V9L2,14V16L10,13.5V19L8,20.5V22L11.5,21L15,22V20.5L13,19V13.5L21,16Z" />
                   </svg>
               </div>
           </div>

           <div class="container">
               <div class="row align-items-center">
                   <!-- Text Content -->
                   <div class="col-lg-7 pe-lg-5">
                       <span class="edufun-label">Our Philosophy</span>
                       <h2 class="edufun-heading">Our Unique<br><em>Approach</em></h2>

                       <div class="edufun-intro">
                           At Edufun Trips, we go beyond traditional travel by designing educational journeys rooted in
                           experiential and learner-centric principles outlined in <span class="edufun-nep-highlight">NEP
                               2020</span>.
                       </div>

                       <div class="edufun-details">
                           <p class="mb-4">
                               Each program begins with a clear understanding of academic goals and student needs. We
                               integrate curriculum relevance, hands-on activities, real-world exposure, and guided
                               reflection to ensure learning continues before, during, and after every journey.
                           </p>
                           <p>
                               With a strong focus on safety, structured planning, and meaningful engagement, our approach
                               transforms travel into a powerful learning experience—nurturing curiosity, critical thinking,
                               and lifelong learning skills in students.
                           </p>
                       </div>
                   </div>

                   <!-- Image Design -->
                   <div class="col-lg-5">
                       <div class="edufun-image-cluster">
                           <div class="edufun-accent-shape"></div>

                           <div class="edufun-main-img-box">
                               <img src="{{ asset('asset/img/img-5.jpg') }}" alt="Students Exploring">
                           </div>

                           <div class="edufun-floating-badge">
                               <div class="edufun-badge-icon">
                                   <svg width="20" height="20" fill="white" viewBox="0 0 16 16">
                                       <path
                                           d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z" />
                                   </svg>
                               </div>
                               <div>
                                   <h6 class="mb-0 fw-bold" style="color:#2f7ec6">Safety First</h6>
                                   <small class="text-muted">Structured Planning</small>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </section>


       <section class="edufun-light-redesign">
           <div class="light-blob blob-1"></div>
           <div class="light-blob blob-2"></div>

           <div class="container main-wrapper">
               <div class="row align-items-center g-5">
                   <div class="col-lg-5">
                       <div class="heading-container">
                           <p class="eyebrow-styled">Beyond the Classroom</p>
                           <div class="heading-flex">
                               <div class="v-line-gradient"></div>
                               <h2 class="main-heading">Why<br><span class="color-1">Edufun</span><br><i
                                       class="color-2">Trips?</i></h2>
                           </div>
                       </div>
                   </div>

                   <div class="col-lg-7">
                       <div class="text-content-box">
                           <p class="body-p-top">
                               A school trip is a rare and formative experience in a student’s life. When designed
                               thoughtfully, it has the power to inspire, educate, and transform.
                           </p>
                           <div class="divider-line"><span></span></div>
                           <p class="body-p-bottom">
                               Edufun Trips ensures that every journey delivers demonstrable learning outcomes while
                               nurturing curiosity, confidence, and personal growth. Even as deeper transformation takes
                               place in the student’s mind and heart, our structured tools ensure learning is visible,
                               meaningful, and lasting.
                           </p>
                       </div>
                   </div>
               </div>

               <div class="row mt-5">
                   <div class="col-12">
                       <div class="image-wrapper-styled">
                           <img src="{{ asset('asset/img/taj.webp') }}" alt="Educational Journey" />
                           <div class="floating-accent"></div>
                       </div>
                   </div>
               </div>

               <div class="row g-0 keyword-grid-light">
                   <div class="col-md-4">
                       <div class="kw-card">
                           <span class="kw-num">01</span>
                           <h3 class="kw-title">Inspire</h3>
                           <p class="kw-description">Exposure to global institutions, innovation hubs, and new cultures
                               that spark curiosity.</p>
                           <div class="kw-footer-bar"></div>
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="kw-card active-card">
                           <span class="kw-num">02</span>
                           <h3 class="kw-title">Educate</h3>
                           <p class="kw-description">Hands-on learning experiences aligned with real-world knowledge and
                               academic goals.</p>
                           <div class="kw-footer-bar"></div>
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="kw-card">
                           <span class="kw-num">03</span>
                           <h3 class="kw-title">Transform</h3>
                           <p class="kw-description">Students return with confidence, broader perspectives, and career
                               inspiration.</p>
                           <div class="kw-footer-bar"></div>
                       </div>
                   </div>
               </div>
           </div>
       </section>

       <section class="video-section">
           <div class="container">
               <p class="section-subtitle">Experience the Journey</p>
               <h2 class="section-title">See Our <span>Impact</span></h2>

               <div class="video-wrapper">
                   <iframe src="https://www.youtube.com/embed/wEL-zPx77cE?si=zmZyvJRGSq0JmQOv"
                       title="YouTube video player"
                       allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                       referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                   </iframe>
               </div>
           </div>
       </section>

       <section class="mt-5">
           <div class="discovery-module">
               <div class="container-fluid px-5">

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
                                       <img src="https://i.pravatar.cc/150?u=a" class="et-author-profile-img"
                                           alt="Reviewer">
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
                                       <img src="https://i.pravatar.cc/150?u=b" class="et-author-profile-img"
                                           alt="Reviewer">
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
                                       <img src="https://i.pravatar.cc/150?u=c" class="et-author-profile-img"
                                           alt="Reviewer">
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
                                       <p class="et-feedback-body-copy">"The industrial visit to the automated
                                           manufacturing plant provided practical insights into robotics that perfectly
                                           aligned with our current semester curriculum."</p>
                                   </div>
                                   <div class="et-author-meta-block">
                                       <img src="https://i.pravatar.cc/150?u=d" class="et-author-profile-img"
                                           alt="Reviewer">
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

                    <div class="swiper et-main-slider-viewport">
                      <div class="swiper-wrapper">

                          @foreach ($testimonials as $item)
                              <div class="swiper-slide h-auto">
                                  <div class="et-testimonial-card-frame">

                                      <div>
                                          <div class="et-quote-visual-indicator">
                                              <i class="bi bi-quote"></i>
                                          </div>

                                          <p class="et-feedback-body-copy">
                                              "{{ $item->message }}"
                                          </p>
                                      </div>

                                      <div class="et-author-meta-block">
                                          <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://i.pravatar.cc/150?u=' . $item->id }}"
                                              class="et-author-profile-img" alt="{{ $item->name }}">

                                          <div>
                                              <h4 class="et-author-display-name">
                                                  {{ $item->name }}
                                              </h4>

                                              <span class="et-author-professional-title">
                                                  {{ $item->designation }}
                                              </span>
                                          </div>
                                      </div>

                                  </div>
                              </div>
                          @endforeach

                      </div>

                      <!-- Pagination -->
                      <div id="et-custom-pagination-dots" class="swiper-pagination"></div>
                  </div>


       </section>

       <section class="gallery-container">
           <div class="container">
               <div class="row align-items-end mb-5">
                   <div class="col-lg-8">
                       <span class="section-tag">Explore our world</span>
                       <h2 class="main-heading">Relive the Moments of <span>Discovery</span></h2>
                   </div>
                   <div class="col-lg-4 d-none d-lg-flex justify-content-end mb-2">
                       <div class="nav-wrapper">
                           <div class="custom-nav slide-prev">
                               <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                   stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                   stroke-linejoin="round">
                                   <line x1="19" y1="12" x2="5" y2="12"></line>
                                   <polyline points="12 19 5 12 12 5"></polyline>
                               </svg>
                           </div>
                           <div class="custom-nav slide-next">
                               <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                   stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                   stroke-linejoin="round">
                                   <line x1="5" y1="12" x2="19" y2="12"></line>
                                   <polyline points="12 5 19 12 12 19"></polyline>
                               </svg>
                           </div>
                       </div>
                   </div>
               </div>

               <div class="swiper gallerySwiper">
                   <div class="swiper-wrapper">
                       <div class="swiper-slide">
                           <div class="gallery-item">
                               <img src="{{ asset('asset/international/3.webp') }}" alt="STEM Workshop">
                           </div>
                       </div>
                       <div class="swiper-slide">
                           <div class="gallery-item">
                               <img src="{{ asset('asset/domestic/6.webp') }}" alt="Travel">
                           </div>
                       </div>
                       <div class="swiper-slide">
                           <div class="gallery-item">
                               <img src="{{ asset('asset/dayout/8.webp') }}" alt="Nature">
                           </div>
                       </div>
                       <div class="swiper-slide">
                           <div class="gallery-item">
                               <img src="{{ asset('asset/dayout/3.webp') }}" alt="Team">
                           </div>
                       </div>
                       <div class="swiper-slide">
                           <div class="gallery-item">
                               <img src="{{ asset('asset/domestic/4.webp') }}" alt="History">
                           </div>
                       </div>
                   </div>
                   <div class="swiper-pagination d-lg-none mt-5"></div>
               </div>
           </div>
       </section>

       <section class="clients-section-light">
           <div class="bg-pattern"></div>

           <div class="container position-relative">
               <div class="section-title-wrap">
                   <span class="sub-tag">Partnerships</span>
                   <h2 class="title-main">Our Trusted <span>Network</span></h2>
                   <div class="title-underline"></div>
               </div>

               <div class="marquee-wrapper">
                   <div class="marquee-container">
                       <!-- Original Set -->
                       <div class="marquee-content">
                           <div class="client-card-new"><img src="{{ asset('asset/img/0.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/1.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/2.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/3.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/4.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/5.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/6.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/7.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/8.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/9.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/10.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/11.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/12.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/13.webp') }}" alt="Client">
                           </div>
                           
                       </div>
                       <!-- Duplicate for Loop -->
                       <div class="marquee-content" aria-hidden="true">
                           <div class="client-card-new"><img src="{{ asset('asset/img/0.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/1.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/2.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/3.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/4.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/5.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/6.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/7.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/8.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/9.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/10.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/11.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/12.webp') }}" alt="Client">
                           </div>
                           <div class="client-card-new"><img src="{{ asset('asset/img/13.webp') }}" alt="Client">
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </section>
       <!-- Our Blog Section End -->
   @endsection
