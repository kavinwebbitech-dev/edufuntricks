@extends('frontend.layouts.app')

@section('content')
    <!-- Banner -->
    <section class="common-page-banner text-center">
        <div class="container">
            <!-- Dynamic Breadcrumbs -->
            <nav aria-label="breadcrumb" class="mt-5">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Program Details</li>
                </ol>
            </nav>

            <h1 class="page-title">Program <span> Details</span></h1>

            <div class="title-accent"></div>
        </div>
    </section>


    <!-- Program Details Section -->
    <section class="edu-swiper-section">
        <div class="swiper-bg-text">Edufun</div>

        <div class="container">

            <!-- Section Title -->
            <div class="swiper-header">
                <h2 class="swiper-title">
                    EXPLORE OUR
                    <span>PROGRAMS</span>
                </h2>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">

                @foreach ($programs as $program)
                    <div class="col">
                        <div class="edu-hsn-card-wrapper">

                            <!-- PDF Link -->
                            <a href="{{ asset('storage/' . $program->pdf) }}" target="_blank" class="edu-hsn-card-anchor">

                                <article class="edu-hsn-main-box">

                                    <!-- Image -->
                                    <figure class="edu-hsn-image-layer">
                                        <img src="{{ asset('storage/' . $program->thumbnail) }}"
                                            alt="{{ $program->title }}">
                                    </figure>

                                    <!-- Overlay -->
                                    <div class="edu-hsn-vignette"></div>

                                    <!-- Top Badge -->
                                    <div class="edu-hsn-top-bar">
                                        <span class="edu-hsn-status-badge">
                                            {{ $program->badge ?? 'Trending' }}
                                        </span>
                                    </div>

                                    <!-- Content -->
                                    <div class="edu-hsn-info-block">
                                        <span class="edu-hsn-sub-label">
                                            {{ strtoupper($program->label ?? 'PROGRAM') }}
                                        </span>

                                        <h2 class="edu-hsn-main-title">
                                            {!! nl2br(e($program->title)) !!}
                                        </h2>
                                    </div>

                                    <!-- Hover Button -->
                                    <div class="edu-hsn-hover-bar">
                                        READ MORE <i class="bi bi-arrow-right"></i>
                                    </div>

                                </article>
                            </a>

                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </section>
@endsection
