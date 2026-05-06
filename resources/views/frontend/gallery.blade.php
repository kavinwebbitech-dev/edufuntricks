    @extends('frontend.layouts.app')

    @section('content')

        {{-- ===== BANNER ===== --}}
        <section class="common-page-banner text-center">
            <div class="container">
                <nav aria-label="breadcrumb"class="mt-5">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Gallery</li>
                    </ol>
                </nav>
                <h1 class="page-title">OUR <span>GALLERY</span></h1>
                <div class="title-accent"></div>
            </div>
        </section>

        {{-- ===== TOP DISCOVERY SLIDER ===== --}}
        @if ($allImages->isNotEmpty())
            <section class="mt-5">
                <div class="discovery-module">
                    <div class="container-fluid px-5">

                        <div class="d-flex justify-content-between align-items-end mb-4">
                            <div>
                                <span class="discovery-tag">Gallery Showcase</span>
                                <h2 class="discovery-title">
                                    Relive the Moments of <span class="discovery-italic">Discovery</span>
                                </h2>
                            </div>
                            <div class="d-flex gap-3">
                                <div class="discovery-ctrl disc-prev"><i class="bi bi-chevron-left"></i></div>
                                <div class="discovery-ctrl disc-next"><i class="bi bi-chevron-right"></i></div>
                            </div>
                        </div>

                        <div class="swiper discovery-carousel disc-row">
                            <div class="swiper-wrapper">
                                @foreach ($allImages as $img)
                                    <div class="swiper-slide discovery-card">
                                        <img src="{{ asset('storage/' . $img->image) }}" class="discovery-img gallery-item">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                {{-- TOP LIGHTBOX --}}
                <div class="modern-lightbox">
                    <div class="lightbox-header">
                        <div class="lightbox-close"><i class="bi bi-x-lg"></i></div>
                    </div>
                    <div class="swiper main-gallery">
                        <div class="swiper-wrapper">
                            @foreach ($allImages as $img)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $img->image) }}">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </section>
        @endif

        {{-- ===== GALLERY SECTIONS (FULLY DYNAMIC) ===== --}}
        <section class="mg-gallery-section">
            <div class="container-fluid px-5">

                {{-- ✅ Loops all galleries except slider automatically --}}
                @forelse($galleries->where('section_key', '!=', 'slider') as $gallery)
                    @if ($gallery->images->isNotEmpty())
                        <div class="gallery-slider" data-index="{{ $loop->index }}">

                            <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
                                <h2 class="mg-gallery-title">
                                    <span class="mg-gallery-accent">{{ strtoupper($gallery->title) }}</span>
                                </h2>

                                {{-- ✅ UNIQUE CONTROLS --}}
                                <div class="d-flex gap-3">
                                    <div class="discovery-ctrl disc-prev-{{ $loop->index }}">
                                        <i class="bi bi-chevron-left"></i>
                                    </div>
                                    <div class="discovery-ctrl disc-next-{{ $loop->index }}">
                                        <i class="bi bi-chevron-right"></i>
                                    </div>
                                </div>
                            </div>

                            {{-- ✅ SWIPER --}}
                            <div class="swiper disc-row-{{ $loop->index }}">
                                <div class="swiper-wrapper">
                                    @foreach ($gallery->images as $img)
                                        <div class="swiper-slide">
                                            <div class="mg-gallery-card">
                                                <img src="{{ asset('storage/' . $img->image) }}"
                                                    class="mg-gallery-img mg-item" alt="{{ $gallery->title }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    @endif
                @empty
                    <div class="text-center py-5">
                        <p class="text-muted">No gallery sections available yet.</p>
                    </div>
                @endforelse

            </div>
        </section>

        {{-- ===== MG LIGHTBOX ===== --}}
        <div class="mg-lightbox" id="mgLightbox">
            <div class="mg-lightbox-close"><i class="bi bi-x-lg"></i></div>
            <div class="mg-lightbox-nav mg-lightbox-prev"><i class="bi bi-chevron-left"></i></div>
            <img class="mg-lightbox-img" src="" alt="">
            <div class="mg-lightbox-nav mg-lightbox-next"><i class="bi bi-chevron-right"></i></div>
        </div>

    @endsection

    @push('scripts')
        <script>
            // ===== TOP LIGHTBOX (DISCOVERY) =====
            const topLightbox = document.querySelector('.modern-lightbox');
            const closeTop = document.querySelector('.lightbox-close');
            const galleryItems = document.querySelectorAll('.gallery-item');

            let topSwiper;

            // Init swiper inside lightbox
            function initTopSwiper(index) {
                if (topSwiper) {
                    topSwiper.destroy(true, true);
                }

                topSwiper = new Swiper(".main-gallery", {
                    initialSlide: index,
                    loop: true,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                });
            }

            // Open lightbox
            galleryItems.forEach((img, index) => {
                img.addEventListener('click', function() {
                    topLightbox.style.display = 'block';
                    document.body.style.overflow = 'hidden'; // prevent scroll
                    initTopSwiper(index);
                });
            });

            // Close lightbox
            closeTop.addEventListener('click', function() {
                topLightbox.style.display = 'none';
                document.body.style.overflow = 'auto';
            });

            // Close on background click
            topLightbox.addEventListener('click', function(e) {
                if (e.target === topLightbox) {
                    topLightbox.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });
            // ===== MG LIGHTBOX FUNCTIONALITY =====
            const lightbox = document.getElementById('mgLightbox');
            const lightboxImg = document.querySelector('.mg-lightbox-img');
            const closeBtn = document.querySelector('.mg-lightbox-close');
            const nextBtn = document.querySelector('.mg-lightbox-next');
            const prevBtn = document.querySelector('.mg-lightbox-prev');

            let currentIndex = 0;
            let images = [];

            // Collect all gallery images
            function loadImages() {
                images = Array.from(document.querySelectorAll('.mg-item'));
            }

            // Open lightbox
            document.querySelectorAll('.mg-item').forEach((img, index) => {
                img.addEventListener('click', function() {
                    loadImages();
                    currentIndex = index;
                    showImage();
                    lightbox.style.display = 'flex';
                });
            });

            // Show image
            function showImage() {
                if (images[currentIndex]) {
                    lightboxImg.src = images[currentIndex].src;
                }
            }

            // Next
            nextBtn.addEventListener('click', function() {
                currentIndex = (currentIndex + 1) % images.length;
                showImage();
            });

            // Prev
            prevBtn.addEventListener('click', function() {
                currentIndex = (currentIndex - 1 + images.length) % images.length;
                showImage();
            });

            // Close
            closeBtn.addEventListener('click', function() {
                lightbox.style.display = 'none';
            });

            // Close on background click
            lightbox.addEventListener('click', function(e) {
                if (e.target === lightbox) {
                    lightbox.style.display = 'none';
                }
            });

            @if ($allImages->isNotEmpty())
                new Swiper(".disc-row", {
                    slidesPerView: 1.2,
                    spaceBetween: 24,
                    loop: true,
                    speed: 1400,
                    autoplay: {
                        delay: 3500,
                        disableOnInteraction: false
                    },
                    navigation: {
                        nextEl: ".disc-next",
                        prevEl: ".disc-prev"
                    },
                    breakpoints: {
                        576: {
                            slidesPerView: 2.2
                        },
                        992: {
                            slidesPerView: 3.2
                        },
                        1400: {
                            slidesPerView: 4.2
                        },
                    }
                });
            @endif


            document.querySelectorAll('.gallery-slider').forEach((section) => {
                // Get the unique index for this section
                const i = section.getAttribute('data-index');

                // Select elements specifically within THIS section to avoid cross-talk
                const sliderSelector = `.disc-row-${i}`;
                const nextEl = `.disc-next-${i}`;
                const prevEl = `.disc-prev-${i}`;

                // Initialize Swiper only if the container exists
                if (section.querySelector(sliderSelector)) {
                    new Swiper(sliderSelector, {
                        slidesPerView: 1.2,
                        spaceBetween: 20,
                        loop: true,
                        speed: 1400,
                        grabCursor: true, // Better UX for desktop users
                        watchSlidesProgress: true, // Helps with smooth transitions

                        autoplay: {
                            delay: 3000,
                            disableOnInteraction: false,
                            pauseOnMouseEnter: true // Stops scrolling when user hovers
                        },

                        navigation: {
                            nextEl: nextEl,
                            prevEl: prevEl
                        },

                        breakpoints: {
                            576: {
                                slidesPerView: 2.2
                            },
                            768: {
                                slidesPerView: 3
                            },
                            1200: {
                                slidesPerView: 4
                            }
                        }
                    });
                }
            });
        </script>
        <script src="{{ asset('asset/frontend/js/function.js') }}"></script>
    @endpush
