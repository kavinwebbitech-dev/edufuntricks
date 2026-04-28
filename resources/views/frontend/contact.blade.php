@extends('frontend.layouts.app')
@section('content')
    <div>
        <section class="common-page-banner text-center">
            <div class="container">
                <!-- Dynamic Breadcrumbs -->
                <nav aria-label="breadcrumb" class="mt-5">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <!-- Change 'About Us' to your current page name -->
                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                    </ol>
                </nav>

                <!-- Dynamic Title -->
                <!-- Use the <span> tag for words you want italicized -->
                <h1 class="page-title">Contact <span> Us</span></h1>

                <div class="title-accent"></div>
            </div>
        </section>
        <!-- End of Common Banner -->

        <div class="discovery-contact-module">
            <div class="container">

                <div class="text-center mt-2">
                    <span class="discovery-tag">Connect With Us</span>
                    <h1 class="discovery-title mt-3">Start Your Next <span class="discovery-italic">Discovery</span></h1>
                    <p class="text-muted mx-auto" style="max-width: 550px;">
                        Have a project in mind or just want to say hello? Our team is ready to help you navigate your
                        journey.
                    </p>
                </div>

                <div class="row g-0 discovery-contact-card">

                    <div class="col-lg-5 order-lg-2">
                        <div class="discovery-info-panel">
                            <h3>Contact Info</h3>
                            <p class="mb-5 opacity-75">Reach out to us directly through any of these channels.</p>

                            <div class="discovery-info-item">
                                <i class="bi bi-geo-alt-fill"></i>
                                <div>
                                    <p class="mb-0 fw-bold">Headquarters</p>
                                    <span class="opacity-75">
                                        99, Ground Floor, RK Mansion,<br>
                                        No 130, 7th Main Rd,<br>
                                        4th Block, Jayanagar,<br>
                                        Bengaluru, Karnataka 560070
                                    </span>
                                </div>
                            </div>

                            <div class="discovery-info-item">
                                <i class="bi bi-telephone-outbound-fill"></i>
                                <div>
                                    <p class="mb-0 fw-bold">Call Us</p>
                                    <a class="text-white text-decoration-none" href="tel:+91 90199 05737"><span
                                            class="opacity-75">+91 90199 05737</span></a> <br>
                                    <a class="text-white text-decoration-none" href="tel:+91 90193 39691"><span
                                            class="opacity-75">+91 90193 39691</span></a>
                                </div>
                            </div>

                            <div class="discovery-info-item">
                                <i class="bi bi-envelope-paper-fill"></i>
                                <div>
                                    <p class="mb-0 fw-bold">Email Us</p>
                                    <!-- <span class="opacity-75">info@edufuntrips.in</span> -->
                                    <a class="text-white text-decoration-none" href="mailto:info@edufuntrips.in"><span
                                            class="opacity-75">info@edufuntrips.in</span></a>
                                </div>
                            </div>

                            <div class="discovery-socials">
                                <a href="https://www.instagram.com/edufuntripsindia/" class="discovery-social-btn"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="https://www.facebook.com/edufuntripsindia" class="discovery-social-btn"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="https://www.linkedin.com/company/110214944/admin/dashboard/"
                                    class="discovery-social-btn"><i class="fa-brands fa-linkedin-in"></i></a>
                                <a href="https://www.youtube.com/@edufuntrips5036" class="discovery-social-btn"><i
                                        class="fa-brands fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-lg-7 order-lg-1">
                        <div class="discovery-form-panel">
                            <h4 class="fw-bold mb-4" style="color: #1a1a1a;">Send a Message</h4>
                            <form id="discoveryForm">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="discovery-form-label">Your Name</label>
                                        <input type="text" class="form-control" placeholder="Enter name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="discovery-form-label">Email Address</label>
                                        <input type="email" class="form-control" placeholder="Email@domain.com" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="discovery-form-label">How can we help?</label>
                                        <select class="form-select form-control">
                                            <option selected>General Inquiry</option>
                                            <option>Technical Support</option>
                                            <option>New Partnership</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="discovery-form-label">Your Message</label>
                                        <textarea class="form-control" rows="5" placeholder="Tell us more about your needs..." required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="discovery-btn-submit">
                                            Send Message <i class="bi bi-send-fill ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> --}}

                    <div class="col-lg-7 order-lg-1">
                        <div class="discovery-form-panel">
                            <h4 class="fw-bold mb-4" style="color: #1a1a1a;">Send a Message</h4>

                            <form id="discoveryForm">
                                @csrf
                                <div class="row g-4">

                                    {{-- Name --}}
                                    <div class="col-md-6">
                                        <label class="discovery-form-label">Your Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Enter name">
                                        <span class="text-danger small error-name"></span>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-md-6">
                                        <label class="discovery-form-label">Email Address <span
                                                class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            placeholder="Email@domain.com">
                                        <span class="text-danger small error-email"></span>
                                    </div>

                                    {{-- Subject --}}
                                    <div class="col-12">
                                        <label class="discovery-form-label">How can we help?</label>
                                        <select name="subject" id="subject" class="form-select form-control">
                                            <option value="General Inquiry">General Inquiry</option>
                                            <option value="Technical Support">Technical Support</option>
                                            <option value="New Partnership">New Partnership</option>
                                        </select>
                                        <span class="text-danger small error-subject"></span>
                                    </div>

                                    {{-- Message --}}
                                    <div class="col-12">
                                        <label class="discovery-form-label">Your Message <span
                                                class="text-danger">*</span></label>
                                        <textarea name="message" id="message" class="form-control" rows="5"
                                            placeholder="Tell us more about your needs..."></textarea>
                                        <span class="text-danger small error-message"></span>
                                    </div>

                                    {{-- Submit --}}
                                    <div class="col-12">
                                        <button type="submit" id="contactSubmitBtn" class="discovery-btn-submit">
                                            Send Message <i class="bi bi-send-fill ms-2"></i>
                                        </button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <section class="map-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <!-- Animation provided by Animate.css -->
                        <div class="map-card animate__animated animate__fadeIn">
                            <div class="map-container">

                                <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3696.2498233614174!2d77.57929087484064!3d12.92973078738181!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae15606aa91735%3A0x8400aadfadef725b!2sMakeMyTrip%20Store%20-%20Jayanagar!5e1!3m2!1sen!2sin!4v1776333412440!5m2!1sen!2sin"
                                    width="600" 
                                    height="450" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {

            $('#discoveryForm').on('submit', function(e) {
                e.preventDefault();

                $('.error-name').html('');
                $('.error-email').html('');
                $('.error-subject').html('');
                $('.error-message').html('');

                let formData = new FormData(this);

                $.ajax({
                    url: '{{ route('contact.store') }}',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,

                    beforeSend: function() {
                        $('#contactSubmitBtn')
                            .html('<i class="fa fa-spinner fa-spin"></i> Sending...')
                            .prop('disabled', true);
                    },

                    success: function(res) {

                        $('#contactSubmitBtn')
                            .html('Send Message <i class="bi bi-send-fill ms-2"></i>')
                            .prop('disabled', false);

                        if (res.status) {

                            // Reset form
                            $('#discoveryForm')[0].reset();

                            // ✅ TOAST STYLE (top-right small popup)
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.message,
                                confirmButtonText: 'OK',
                                position: 'center'
                            });
                        }
                    },

                    error: function(err) {
                        $('#contactSubmitBtn')
                            .html('Send Message <i class="bi bi-send-fill ms-2"></i>')
                            .prop('disabled', false);

                        let errors = err.responseJSON?.errors || {};

                        $('.error-name').text(errors.name?.[0] || '');
                        $('.error-email').text(errors.email?.[0] || '');
                        $('.error-subject').text(errors.subject?.[0] || '');
                        $('.error-message').text(errors.message?.[0] || '');
                    }
                });
            });

        });
    </script>
@endsection
