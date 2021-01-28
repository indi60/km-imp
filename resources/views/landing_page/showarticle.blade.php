<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Business, Service">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <title>KOMA | Detail Artikel</title>

    <!-- Favicon  -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/koma-logo.svg') }}">

    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/LineIcons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/nivo-lightbox.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">

</head>

<body>
    <section id="all">
        <!-- Header Section Start -->
        <header id="home" class="hero-area">
            <div class="overlay">
                <span></span>
                <span></span>
            </div>
            <nav class="navbar navbar-expand-md bg-inverse fixed-top scrolling-navbar">
                <div class="container py-2">
                    <a href="index.html" class="navbar-brand"><img src="{{ asset('assets/images/landing/landing-logo-koma.svg') }}" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto w-100 justify-content-end">
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="{{ route('welcome') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="#blog">Resources</a>
                            </li>
                            @if(Route::has('login'))
                                @auth
                                    <li class="nav-item">
                                        <a class="nav-link page-scroll" href="{{ url('/home') }}">Dashboard</a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="btn btn-singin" style="border-radius: 15px" href="{{ route('login') }}">Sign In <i class="fas fa-arrow-right"></i></a>
                                    </li>
                                    @if(Route::has('register'))
                                        <li class="nav-item">
                                            <a class="btn btn-singup" style="border-radius: 15px" href="{{ route('register') }}">Sign Up</a>
                                        </li>
                                    @endif
                                @endauth
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- Header Section End -->

        <!-- Blog Section -->
        <section id="blog" class="section">
            <!-- Container Starts -->
            <div class="container">
                <!-- Start Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="blog-text section-header text-center">
                            <div>
                                <h2 class="section-title">Detail Artikel</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->
                <!-- Start Row -->
                <div class="row">
                    <!-- Start Col -->
                    <div class="col-lg-9 col-md-9 col-xs-12 blog-item mb-2">
                        <!-- Blog Item Starts -->
                        <div class="blog-item-wrap">
                            <div class="blog-item-text container-fluid">
                                <h3>
                                    {{ $articles->title }}
                                </h3>
                                {!! $articles->content !!}
                            </div>
                            <div class="author">
                                <span class="name"><i class="fas fa-user"></i>Posted by Admin</span>
                                <span class="date float-right"><i class="fas fa-calendar-alt"></i>10 April,
                                    2020</span>
                            </div>
                        </div>
                        <!-- Blog Item Wrapper Ends-->
                    </div>
                    <!-- End Col -->
                    <!-- Start Col -->
                    <div class="col-lg-3 col-md-6 col-xs-12 blog-item">
                        <!-- Blog Item Starts -->
                        <div class="blog-item-wrap">
                            <div class="blog-item-text">
                                <h3>Categories</h3>
                                <hr>
                                <ul>
                                    @foreach ($jobs as $job)
                                        <li><a href=""><i class="fas fa-circle" style="color:  #1351B5"></i><span class="ml-2">{{$job->name}}</span></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- Blog Item Wrapper Ends-->
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
        </section>
        <!-- blog Section End -->

        <!-- Footer Section Start -->
        <footer>
            <!-- Footer Area Start -->
            <section id="footer-Content">
                <div class="container">
                    <!-- Start Row -->
                    <div class="row">

                        <!-- Start Col -->
                        <div class="col-lg-4 col-md-8 col-sm-8 col-xs-8 col-mb-12">
                            <div class="widget">
                                <h3 class="block-title">About Koma</h3>
                                <p class="text-justify">
                                    KOMA Helpdesk is a management app that was build for the purpose of "easily manage
                                    everything" with an easy to navigate
                                    interface, feather-weight load time and responsive interactions.
                                </p>
                            </div>
                        </div>
                        <!-- End Col -->

                        <!-- Start Col -->
                        <div class="col-lg-3 col-md-8 col-sm-8 col-xs-8 col-mb-12 offset-1">
                            <div class="widget">
                                <h3 class="block-title">Links</h3>
                                <ul class="menu">
                                    <li><a href="#">- Home</a></li>
                                    <li><a href="#">- About</a></li>
                                    <li><a href="#">- Resources</a></li>
                                    <li><a href="#">- Contact</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Col -->

                        <!-- Start Col -->
                        <div class="col-lg-3 col-md-8 col-sm-8 col-xs-8 col-mb-12 ofset-1">
                            <div class="widget">
                                <p class="text-right mt-5">
                                    For more info, contact us <br>
                                    <a href="mailto:impstudio@gmail.com"><b>contact@impstudio.id</b></a>
                                </p>
                            </div>
                        </div>
                        <!-- End Col -->
                    </div>
                    <hr>
                    <!-- End Row -->
                    <div class="row my-3">
                        <div class="col-lg-8">
                            <p class="p-small">Knowledge & Media Management Helpdesk powered by IMPStudio</p>
                        </div>
                        <div class="col-lg-4">
                            <p class="p-small">Copyright ©
                                <a href="https://impstudio.id/">
                                    IMPStudio {{ Date('Y') }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Footer area End -->
        </footer>
        <!-- Footer Section End -->


        <!-- Go To Top Link -->
        <a href="#" class="back-to-top">
            <i class="fas fa-chevron-up"></i>
        </a>

        <!-- Preloader -->
        <div id="preloader">
            <div class="loader" id="loader-1"></div>
        </div>
        <!-- End Preloader -->

        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Core plugin JavaScript -->
        <script type="text/javascript" src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

        <script src="{{asset('assets/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/owl.carousel.js')}}"></script>
        <script src="{{asset('assets/js/jquery.nav.js')}}"></script>
        <script src="{{asset('assets/js/scrolling-nav.js')}}"></script>
        <script src="{{asset('assets/js/nivo-lightbox.js')}}"></script>
        <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{asset('assets/js/main.js')}}"></script>

</body>

</html>
