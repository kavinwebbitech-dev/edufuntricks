@extends('frontend.layouts.app')
@section('content')
    <section class="common-page-banner text-center">
        <div class="container">
            <!-- Dynamic Breadcrumbs -->
            <nav aria-label="breadcrumb" class="mt-5">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <!-- Change 'About Us' to your current page name -->
                    <li class="breadcrumb-item active" aria-current="page">Our Programs</li>
                </ol>
            </nav>

            <!-- Dynamic Title -->
            <!-- Use the <span> tag for words you want italicized -->
            <h1 class="page-title">OUR <span> PROGRAMS</span></h1>

            <div class="title-accent"></div>
        </div>
    </section>
    <!-- End of Common Banner -->



    <section class="edu-nep-container">
        <div class="container">
            <div class="nep-grid">

                <!-- Left: Visual Content -->
                <div class="nep-visual-side">
                    <div class="nep-image-viewport">
                        <div class="nep-image-overlay"></div>
                        <!-- Using a high-quality educational interaction image -->
                        <img src="{{ asset('asset/international/10.webp') }}" alt="Experiential Learning Field Trip">

                        <div class="nep-badge-circle">
                            <span>Curriculum<br><strong style="color: #2196F3; font-size: 14px;">Focused</strong></span>
                        </div>
                    </div>
                </div>

                <!-- Right: Content Composition -->
                <div class="nep-content-side">
                    <div class="nep-glass-card">
                        <span class="nep-eyebrow">Redefining Education</span>
                        <h2 class="nep-headline">
                            Experiential Learning <br>
                            <span class="nep-headline-accent">Inspired by NEP 2020</span>
                        </h2>

                        <p class="nep-body-text">
                            Inspired by the National Education Policy (NEP) 2020, Edufun Trips curates educational journeys
                            that transform travel into meaningful learning. By placing students in real-world environments,
                            we foster cultural understanding, critical thinking, and personal growth—turning exploration
                            into experience and experience into lifelong knowledge.
                        </p>

                        <div class="nep-pillars">
                            <div class="pillar-tag">
                                <div class="pillar-dot" style="background: #2196F3;"></div>
                                Cultural Understanding
                            </div>
                            <div class="pillar-tag">
                                <div class="pillar-dot" style="background: #4CAF50;"></div>
                                Critical Thinking
                            </div>
                            <div class="pillar-tag">
                                <div class="pillar-dot" style="background: #FF9800;"></div>
                                Personal Growth
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    {{-- <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">

                <!-- Card 1 -->
                <div class="col">
                    <div class="ef-download-card">
                        <img src="asset/img/banglore.webp" alt="Experience 1" class="ef-card-img">
                        <div class="ef-card-overlay"></div>
                        <div class="ef-card-content">
                            <span class="ef-label">01 / OUTSTATION-EXCURSION</span>
                            <h3 class="ef-title">A DAY TRIP<br>BANGALORE TO HASSAN</h3>
                            <a href="asset/img/adaytrip-bangaloretohassan.pdf" class="ef-download-btn" download>
                                <div class="ef-file-info">
                                    <strong>Download PDF</strong>
                                    <!-- <span>2.4 MB</span> -->
                                </div>
                                <div class="ef-icon-wrapper"><i data-lucide="file-text" width="16" height="16"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col">
                    <div class="ef-download-card">
                        <img src="asset/img/amegundi.webp" alt="Experience 2" class="ef-card-img">
                        <div class="ef-card-overlay"></div>
                        <div class="ef-card-content">
                            <span class="ef-label">02 / DAY OUTING</span>
                            <h3 class="ef-title">Amegundi <br>Resort</h3>
                            <a href="asset/img/amegundiresort.pdf" class="ef-download-btn" download>
                                <div class="ef-file-info">
                                    <strong>Download PDF</strong>
                                    <!-- <span>1.8 MB</span> -->
                                </div>
                                <div class="ef-icon-wrapper"><i data-lucide="file-text" width="16" height="16"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col">
                    <div class="ef-download-card">
                        <img src="asset/img/dragon.webp" alt="Experience 3" class="ef-card-img">
                        <div class="ef-card-overlay"></div>
                        <div class="ef-card-content">
                            <span class="ef-label">03 / PREMIER INTERNATIONAL SUMMER PROGRAMES- SBC</span>
                            <h3 class="ef-title">Eco Trails<br>& Wildlife</h3>
                            <a href="asset/img/campdragonoxford-sbc.pdf" class="ef-download-btn" download>
                                <div class="ef-file-info">
                                    <strong>Download PDF</strong>
                                    <!-- <span>3.1 MB</span> -->
                                </div>
                                <div class="ef-icon-wrapper"><i data-lucide="file-text" width="16" height="16"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col">
                    <div class="ef-download-card">
                        <img src="asset/img/artisticexperience.webp" alt="Experience 4" class="ef-card-img">
                        <div class="ef-card-overlay"></div>
                        <div class="ef-card-content">
                            <span class="ef-label">04 / EDUFUN HANDS-ON ADVENTURES</span>
                            <h3 class="ef-title">Artisan<br>Crafting</h3>
                            <a href="asset/img/artisticexperience.pdf" class="ef-download-btn" download>
                                <div class="ef-file-info">
                                    <strong>Download PDF</strong>
                                    <!-- <span>1.2 MB</span> -->
                                </div>
                                <div class="ef-icon-wrapper"><i data-lucide="file-text" width="16"
                                        height="16"></i></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div> --}}

    <div class="swiper-container" id="cardContainer">
        @foreach ($categories as $index => $category)
            <div class="swiper-card 
            {{ $index == 0 ? 'pos-1' : ($index == 1 ? 'pos-2' : ($index == 2 ? 'pos-3' : 'hidden')) }}"
                data-index="{{ $index }}">

                <!-- Image -->
                <div class="card-img-overlay">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                </div>

                <div class="card-gradient"></div>

                <!-- Link Wrapper -->
                <a href="{{ route('program.detail', ['slug' => $category->slug]) }}" class="text-decoration-none">

                    <div class="card-content">
                        <span class="card-num">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }} / PROGRAM
                        </span>

                        <h3 class="card-name text-white">
                            {{ strtoupper($category->name) }}
                        </h3>

                        <div class="nav-btn1">
                            View Details
                            <span class="btn-icon1">
                                <i class="bi bi-arrow-right-short" style="font-size: 1.8rem; color: white;"></i>
                            </span>
                        </div>
                    </div>

                </a>


            </div>
        @endforeach
    </div class="mb-5">
    <div class="swiper-controls">
        <button class="ctrl-btn" id="prevBtn">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </button>
        <button class="ctrl-btn" id="nextBtn">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </button>
    </div><br>
    <script src="asset/js/swiper.js"></script>
@endsection
