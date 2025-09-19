<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'LuxeAura - Luxury Fashion')</title>
    
    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">
    
    <!-- google fonts -->
    <link href='https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700' rel='stylesheet' type='text/css'>
    
    <!-- all css here -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pe-icon-7-stroke.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/img-zoom/jquery.simpleLens.css') }}">
    <link rel="stylesheet" href="{{ asset('css/meanmenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/css/nivo-slider.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('lib/css/preview.css') }}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/wishlist-cart-unified.css') }}">
    
    <!-- modernizr css -->
    <script src="{{ asset('js/vendor/modernizr-2.8.3.min.js') }}"></script>
    
    @stack('styles')
</head>

<body>
    {{-- @include('layouts.header') --}}
    
    <main>
        @yield('content')
    </main>
    
    @include('layouts.footer')
    
    <script src="https://kit.fontawesome.com/1147679ae7.js" crossorigin="anonymous"></script>
    
    <!-- jQuery (local) - load before plugins -->
    <script src="{{ asset('js/vendor/jquery-1.12.0.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- parallax js -->
    <script src="{{ asset('js/parallax.min.js') }}"></script>
    <!-- owl.carousel js -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <!-- Img Zoom js -->
    <script src="{{ asset('js/img-zoom/jquery.simpleLens.min.js') }}"></script>
    <!-- meanmenu js -->
    <script src="{{ asset('js/jquery.meanmenu.js') }}"></script>
    <!-- jquery.countdown js -->
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <!-- Nivo slider js -->
    <script src="{{ asset('lib/js/jquery.nivo.slider.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/home.js') }}" type="text/javascript"></script>
    <!-- jquery-ui js -->
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <!-- sticky js -->
    <script src="{{ asset('js/sticky.js') }}"></script>
    <!-- plugins js -->
    <script src="{{ asset('js/plugins.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('js/main.js') }}"></script>
    
    @stack('scripts')
    
    <!-- Header Interactive Scripts -->
    <script>
    $(document).ready(function() {
        // Mobile Menu Toggle
        $('.mobile-menu-toggle').on('click', function() {
            $('.mobile-nav').addClass('active');
            $('body').addClass('mobile-nav-open');
        });
        
        $('.mobile-nav-close').on('click', function() {
            $('.mobile-nav').removeClass('active');
            $('body').removeClass('mobile-nav-open');
        });
        
        // Search Toggle
        $('.search-toggle').on('click', function() {
            $('.search-overlay').addClass('active');
            $('.search-input-overlay').focus();
        });
        
        $('.search-overlay-close').on('click', function() {
            $('.search-overlay').removeClass('active');
        });
        
        // Close mobile nav when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.mobile-nav, .mobile-menu-toggle').length) {
                $('.mobile-nav').removeClass('active');
                $('body').removeClass('mobile-nav-open');
            }
        });
        
        // Mobile submenu toggle
        $('.mobile-nav .has-submenu > a').on('click', function(e) {
            e.preventDefault();
            $(this).parent().toggleClass('active');
            $(this).next('.submenu').slideToggle();
        });
        
        // Wishlist and Cart dropdowns
        $('.wishlist-toggle').on('click', function(e) {
            e.preventDefault();
            $('.wishlist-dropdown').toggleClass('active');
            $('.cart-dropdown').removeClass('active');
        });
        
        $('.cart-toggle').on('click', function(e) {
            e.preventDefault();
            $('.cart-dropdown').toggleClass('active');
            $('.wishlist-dropdown').removeClass('active');
        });
        
        // Close dropdowns when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.header-wishlist, .header-cart').length) {
                $('.wishlist-dropdown, .cart-dropdown').removeClass('active');
            }
        });
        
        // User dropdown
        $('.user-link').on('click', function(e) {
            e.preventDefault();
            $('.user-dropdown').toggleClass('active');
        });
        
        // Close user dropdown when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.user-menu').length) {
                $('.user-dropdown').removeClass('active');
            }
        });
    });
    </script>
</body>
</html>