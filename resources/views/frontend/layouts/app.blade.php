<!DOCTYPE html>
<html lang="zxx">
<style>
    body {
        margin: 0;
        background: #f5f9ff;
        font-family: 'Segoe UI', sans-serif;
    }

    /* Sidebar */
    .sidebar {
        width: 260px;
        height: 100vh;
        position: fixed;
        display: flex;
        flex-direction: column;
        background: linear-gradient(180deg, #f8fbff 0%, #eef5ff 100%);
        border-right: 1px solid #e3eaf5;
    }

    /* Main Content */
    .main-content {
        margin-left: 260px;
    }

    /* Header */
    .header {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: linear-gradient(90deg, #ffffff, #f1f6ff);
        padding: 15px 20px;
        border-bottom: 1px solid #e5e7eb;
        box-shadow: 0 4px 15px rgba(0, 80, 120, 0.05);
    }

    /* Page Content */
    .content-area {
        padding: 25px;
    }
 
</style>

<head>
    @include('frontend.layouts.header-link')
</head>

<body>

    @include('frontend.layouts.navbar')

    @yield('content')
    @include('frontend.layouts.footer')
    @stack('scripts')
</body>



</html>
