@extends('frontend.layouts.app')
@section('content')
   
    <!-- Start of Common Banner -->
    <section class="common-page-banner text-center">
        <div class="container">
            <!-- Dynamic Breadcrumbs -->
            <nav aria-label="breadcrumb" class="mt-5">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <!-- Change 'About Us' to your current page name -->
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ol>
            </nav>

            <!-- Dynamic Title -->
            <!-- Use the <span> tag for words you want italicized -->
            <h1 class="page-title">About <span>Us</span></h1>

            <div class="title-accent"></div>
        </div>
    </section>
    <!-- End of Common Banner -->


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
                                Edufun Trips is an educational travel initiative inspired by the principles of <span class="keyword-focus">NEP 2020</span>, where learning moves beyond textbooks into real-world experiences that shape curiosity, understanding, and independent thinking in young minds.
                            </p>

                            <p class="animate__animated animate__fadeInUp animate__delay-2s">
                                Based in Bangalore and New Delhi, we partner with schools to deliver safe, structured, and purpose-driven educational journeys that support <span class="keyword-focus">experiential and competency-based learning</span>.
                            </p>

                            <p class="animate__animated animate__fadeInUp animate__delay-3s">
                                Our programs connect classroom concepts with hands-on exploration, helping students discover their interests, develop <span class="keyword-focus">critical life skills</span>, and gain practical insights through immersive and guided learning experiences.
                            </p>

                            <p class="animate__animated animate__fadeInUp animate__delay-4s">
                                At Edufun Trips, we believe meaningful travel can become a powerful learning tool—nurturing curiosity, confidence, and <span class="keyword-focus">lifelong learning</span>.
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
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="visual-journey animate__animated animate__zoomIn animate__delay-1s">
                        <div class="organic-image-wrap">
                            <img src="{{ asset('asset/img/img-1.jpg') }}" alt="Student Learning">
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

    <section class="edu-mission-vision">
        <!-- Vision Hero -->
        <div class="vision-hero">
            <div class="container">
                <span class="section-tag">Vision Statement</span>
                <h2 class="vision-title">Inspiring Minds <span>Beyond Classrooms</span></h2>
                <p class="vision-text">
                    To inspire young minds through experiential, real-world learning experiences that promote holistic development, critical thinking, and lifelong learning beyond the classroom—aligned with the vision of the <span class="highlight-nep">National Education Policy (NEP) 2020.</span>
                </p>
            </div>
        </div>

        <!-- Mission Section -->
        <div class="container">
            <div class="text-center mb-4"> <!-- Reduced margin -->
                <span class="section-tag">Our Mission</span>
                <h2 class="vision-title" style="font-size: 2.2rem;">How we make it <span>happen</span></h2>
            </div>

            <div class="mission-section">
                <!-- Mission 1 -->
                <div class="mission-row">
                    <div class="mission-img-col">
                        <div class="mission-img-wrapper">
                            <img src="{{ asset('asset/adventure/1.webp') }}" alt="Curriculum-Aligned Travel">
                        </div>
                    </div>
                    <div class="mission-text-col">
                        <div class="mission-number">01</div>
                        <div class="mission-content">
                            <h3>Curriculum-Aligned Travel</h3>
                            <p>Designing high-quality, competency-based learning experiences through educational travel that seamlessly bridges the gap between textbooks and the real world.</p>
                        </div>
                    </div>
                </div>

                <!-- Mission 2 -->
                <div class="mission-row">
                    <div class="mission-img-col">
                        <div class="mission-img-wrapper">
                            <img src="{{ asset('asset/international/18.webp') }}" alt="NEP 2020 Integration">
                        </div>
                    </div>
                    <div class="mission-text-col">
                        <div class="mission-number">02</div>
                        <div class="mission-content">
                            <h3>NEP 2020 Integration</h3>
                            <p>Promoting experiential learning, multidisciplinary exposure, and practical understanding as outlined in the <span class="highlight-nep">NEP 2020</span> framework for future-ready students.</p>
                        </div>
                    </div>
                </div>

                <!-- Mission 3 -->
                <div class="mission-row">
                    <div class="mission-img-col">
                        <div class="mission-img-wrapper">
                            <img src="{{ asset('asset/domestic/4.webp') }}" alt="Safe & Seamless Delivery">
                        </div>
                    </div>
                    <div class="mission-text-col">
                        <div class="mission-number">03</div>
                        <div class="mission-content">
                            <h3>Safe & Seamless Delivery</h3>
                            <p>Delivering student-centric travel programmes with a rigorous focus on safety, responsibility, and wellbeing, ensuring peace of mind for schools and parents.</p>
                        </div>
                    </div>
                </div>

                <!-- Mission 4 -->
                <div class="mission-row">
                    <div class="mission-img-col">
                        <div class="mission-img-wrapper">
                            <img src="{{ asset('asset/international/37.webp') }}" alt="Real-World Exploration">
                        </div>
                    </div>
                    <div class="mission-text-col">
                        <div class="mission-number">04</div>
                        <div class="mission-content">
                            <h3>Real-World Exploration</h3>
                            <p>Inspiring curiosity and creativity through real-world exploration that transforms the world into a living classroom for learner-centric education.</p>
                        </div>
                    </div>
                </div>

                <!-- Mission 5 -->
                <div class="mission-row">
                    <div class="mission-img-col">
                        <div class="mission-img-wrapper">
                            <img src="{{ asset('asset/adventure/10.webp') }}" alt="School Support">
                        </div>
                    </div>
                    <div class="mission-text-col">
                        <div class="mission-number">05</div>
                        <div class="mission-content">
                            <h3>End-to-End School Support</h3>
                            <p>Partnering with schools to provide comprehensive travel planning that complements academic goals and fosters holistic student development.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="edufun-mission-core">
        <div class="container">
            <div class="layout-grid">

                <!-- Left: Single High Impact Image -->
                <div class="image-container">
                    <div class="image-accent"></div>
                    <img src="{{ asset('asset/international/10-2.webp') }}" alt="Students Learning Globally">
                </div>

                <!-- Right: Content & Pillars -->
                <div class="content-container">
                    <!--<span class="badge-text">Company Tagline</span>-->
                    <h1 class="main-title">
                        Travel. Learn. <br><span>Discover.</span>
                    </h1>

                    <div class="pillars-list">
                        <!-- Travel -->
                        <div class="pillar-item item-travel">
                            <span class="pillar-label">Travel</span>
                            <p class="pillar-text">
                                introduces students to real-world environments beyond classrooms—new cultures, industries, institutions, and perspectives.
                            </p>
                        </div>

                        <!-- Learn -->
                        <div class="pillar-item item-learn">
                            <span class="pillar-label">Learn</span>
                            <p class="pillar-text">
                                transforms these experiences into structured, curriculum-aligned learning through observation, interaction, and reflection.
                            </p>
                        </div>

                        <!-- Discover -->
                        <div class="pillar-item item-discover">
                            <span class="pillar-label">Discover</span>
                            <p class="pillar-text">
                                enables students to uncover ideas, interests, skills, and self-awareness that shape their academic and personal growth.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>



    <div class="process-horizontal-section">
        <!-- Ambient Gradient Blurs -->
        <div class="ambient-blur blur-1"></div>
        <div class="ambient-blur blur-2"></div>

        <div class="container">
            <div class="process-header">
                <span class="eyebrow">HOW WE WORK WITH SCHOOL AND PROCESS</span>
                <h2>Our Seamless <span>Methodology</span></h2>
            </div>

            <div class="timeline-container">
                <!-- Decorative path with Gradient Stroke (Desktop only) -->
                <svg class="timeline-svg" viewBox="0 0 1200 100" preserveAspectRatio="none">
                    <defs>
                        <linearGradient id="pathGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#2f7ec6" />
                            <stop offset="33%" stop-color="#25A757" />
                            <stop offset="66%" stop-color="#75307B" />
                            <stop offset="100%" stop-color="#f2c94c" />
                        </linearGradient>
                    </defs>
                    <path d="M0,50 Q300,0 600,50 T1200,50" fill="none" stroke="url(#pathGradient)" stroke-width="2" stroke-dasharray="12 8" />
                </svg>

                <div class="timeline-grid">
                    <!-- Step 1 -->
                    <div class="timeline-step step-1">
                        <div class="step-node">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </div>
                        <span class="step-meta">step 01</span>
                        <h3>Understanding School Requirements</h3>
                    </div>

                    <!-- Step 2 -->
                    <div class="timeline-step step-2">
                        <div class="step-node">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                            </svg>
                        </div>
                        <span class="step-meta">step 02</span>
                        <h3>Planning Learning-Focused Journeys</h3>
                    </div>

                    <!-- Step 3 -->
                    <div class="timeline-step step-3">
                        <div class="step-node">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            </svg>
                        </div>
                        <span class="step-meta">step 03</span>
                        <h3>End-to-End Coordination</h3>
                    </div>

                    <!-- Step 4 -->
                    <div class="timeline-step step-4">
                        <div class="step-node">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
                            </svg>
                        </div>
                        <span class="step-meta">step 04</span>
                        <h3>Learning & Reflection Support</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="edu-impact-section">
        <div class="container">
            <!-- methodology-style Header with Gradient Text -->
            <div class="edu-impact-header-container">
                <span class="edu-impact-eyebrow">How we work with schools</span>
                <h2 class="edu-impact-main-title">Why Learning-Focused <span class="edu-impact-title-gradient">Travel Matters</span></h2>
                <p class="edu-impact-description">
                    Travel is a powerful educational tool when designed with purpose.
                    Learning-focused travel helps students connect classroom concepts with real-world experiences,
                    encouraging curiosity, critical thinking, and holistic development.
                </p>
            </div>

            <div class="edu-impact-content-grid">

                <!-- Benefits Section with Methodology-style Card -->
                <div class="edu-impact-benefits-column">
                    <div class="edu-impact-benefits-card">
                        <h5 style="font-weight: 800; font-size: 11px; text-transform: uppercase; letter-spacing: 3px; margin-bottom: 45px; color: #94a3b8; text-align: center;">Our Impactful Process</h5>

                        <div class="edu-impact-benefit-item">
                            <div class="edu-impact-benefit-icon-box">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                </svg>
                            </div>
                            <div class="edu-impact-benefit-text">Experience learning beyond textbooks</div>
                        </div>

                        <div class="edu-impact-benefit-item">
                            <div class="edu-impact-benefit-icon-box">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                            <div class="edu-impact-benefit-text">Develop observation, communication, and collaboration skills</div>
                        </div>

                        <div class="edu-impact-benefit-item">
                            <div class="edu-impact-benefit-icon-box">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                            </div>
                            <div class="edu-impact-benefit-text">Gain exposure to real-world applications and careers</div>
                        </div>

                        <div class="edu-impact-benefit-item">
                            <div class="edu-impact-benefit-icon-box">
                                <!-- Fixed Globe Icon for Global Awareness/Confidence -->
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                    <path d="M2 12h20"></path>
                                </svg>
                            </div>
                            <div class="edu-impact-benefit-text">Build confidence, independence, and global awareness</div>
                        </div>
                    </div>
                </div>

                <!-- Visual Section -->
                <div class="edu-impact-visual-stack">
                    <div class="edu-impact-deco-path"></div>
                    <div class="edu-impact-main-img-wrap">
                        <img src="{{ asset('asset/adventure/6.webp') }}" alt="Students learning in the field">
                    </div>

                    <div class="edu-impact-badge">
                        <span>100%</span>
                        <span>Curriculum<br>Aligned</span>
                    </div>
                </div>

            </div>
        </div>
    </section>


@endsection