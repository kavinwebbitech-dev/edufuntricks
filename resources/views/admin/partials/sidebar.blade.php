<div class="sidebar">
    <style>
        .sidebar a {
            display: block;
            padding: 12px 18px;
            margin: 6px 12px;
            color: #444;
            font-size: 15px;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        /* Hover */
        .sidebar a:hover {
            background: #f1f5f9;
            color: #2b6cb0;
        }

        /* Active (very subtle like frontend) */
        .sidebar a.active {
            background: #eef6ff;
            color: #2b6cb0;
            font-weight: 500;
        }

        /* Logo area */
        .sidebar h4 {
            background: #fff;
        }

        /* Logout */
        .sidebar .btn {
            background: red;
            border: 1px solid #ddd;
            color: #ffff;
            border-radius: 8px;
        }

        .sidebar .btn:hover {
            background: #2b6cb0;
            color: #fff;
        }
    </style>

    <h4 class="text-center p-2 border-bottom">
        <img src="{{ asset('asset/frontend/new/logo.png') }}" alt="Sherene" class="img-fluid" style="max-height: 60px;">
    </h4>

    {{-- Dashboard --}}
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fa fa-home me-2"></i> Dashboard
    </a>


    <a href="{{ route('admin.categories.index') }}"
        class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
       <i class="fa fa-list-ul me-2"></i> Programs Categories
    </a>

    <a href="{{ route('admin.programs.index') }}" class="{{ request()->routeIs('admin.programs.*') ? 'active' : '' }}">
        <i class="fa fa-newspaper me-2"></i> Programs
    </a>
    {{-- Gallery (covers index, create, edit, etc) --}}
    <a href="{{ route('admin.gallery.index') }}" class="{{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
        <i class="fa fa-images me-2"></i> Gallery
    </a>
    <a href="{{ route('admin.testimonials.index') }}"
        class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
        <i class="fa fa-comment me-2"></i> Testimonials
    </a>

     <a href="{{ route('admin.testimonialshome.index') }}"
        class="{{ request()->routeIs('admin.testimonialshome.*') ? 'active' : '' }}">
        <i class="fa fa-quote-left me-2"></i>Home Page Testimonials
    </a>

    <a href="{{ route('admin.contact.index') }}"
        class="{{ request()->routeIs('admin.contact.index') ? 'active' : '' }}">
        <i class="fa fa-envelope me-2"></i> Contact Enquiry
    </a>

    <div class="mt-auto p-3">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-light w-100">
                <i class="fa fa-sign-out-alt me-1"></i> Logout
            </button>
        </form>
    </div>

</div>
