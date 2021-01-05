<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Webpage Title -->
    <title>KOMA Helpdesk</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}"
        rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/swiper.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="{{asset('images/logo/koma-logo.svg')}}">
</head>

<body data-spy="scroll" data-target=".fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
        <div class="container">

            <!-- Image Logo -->
            <a class="navbar-brand logo-image" href="#"><img
                    src="{{ (asset('images/logo/logo-landingpage.svg')) }}" alt="alternative"></a>

            <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ml-4">
                        <a class="nav-link page-scroll" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ml-4">
                        <a class="nav-link page-scroll" href="#articles">Articles</a>
                    </li>
                    <li class="nav-item ml-4">
                        <a class="nav-link page-scroll" href="#contact">Contact</a>
                    </li>
                    @if (Route::has('login'))
                            @auth
                                <li class="nav-item ml-4">
                                    <a class="nav-link page-scroll" href="{{ url('/home') }}">Dashboard</a>
                                </li>
                            @else
                                <li class="nav-item ml-4">
                                    <a class="nav-link page-scroll btn btn-sm py-2 pr-3 pl-3"
                                        style="background-image: linear-gradient(to bottom right, #00AFF0, #1351B5);" href="{{ route('login') }}">Sign In
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item ml-4">
                                        <a class="nav-link page-scroll btn btn-outline-light btn-sm py-2 pr-3 pl-3" href="{{ route('register') }}">Sign Up</a>
                                    </li>
                                @endif
                            @endauth
                    @endif
                </ul>
            </div> <!-- end of navbar-collapse -->
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->


    <!-- Header -->
    <header id="header" class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="text">
                        <img class="img-fluid" style="margin-left: -10px"
                            src="{{ (asset('images/logo/landingpage-animationlogo.svg')) }}"
                            alt="alternative">
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-6">
                    <h1>add, report, and <br> manage everything <br> easily.</h1>
                    <p class="p-large">KOMA Helpdesk is a management app that was build for the purpose of "easily
                        manage everything" with an easy to navigate interface, feather-weight load time and responsive
                        interactions.</p>
                    <a class="btn-solid-lg" href="#your-link"><i class="fab fa-apple"></i>For Apple</a>
                    <a class="btn-solid-lg" href="#your-link"><i class="fab fa-google-play"></i>For Android</a>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of header -->
    <!-- end of header -->

    <!-- Features -->
    <section id="articles">
        <div class="tabs">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <h1 class="float-left">Articles</h1>
                        <h1 class="float-right">Articles</h1>
                    </div>
                </div>
                <hr class="bg-white">

                <div class="row justify-content-center">
                    @foreach ($Articles as $Article)
                        <div class="col-md-6">
                            <ul class="list-unstyled li-space-lg first">
                                <li class="media">
                                    <span class="fa-stack">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-arrow-right fa-stack-1x"></i>
                                    </span>
                                    <div class="media-body">
                                        <h4>{{$Article->title}}</h4>
                                        <p>{!!$Article->content!!}</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of tabs -->
    </section>
    <!-- end of features -->


    <!-- Download -->
    <section id="contact">
        <div class="basic-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="text-container">
                            <h3>Download Leno today to see the benefits and enjoy the results faster than any other app
                                out there</h3>
                            <a class="btn-solid-lg" href="#your-link"><i class="fab fa-apple"></i>For iOS</a>
                            <a class="btn-solid-lg" href="#your-link"><i class="fab fa-google-play"></i>For Android</a>
                        </div> <!-- end of text-container -->
                    </div> <!-- end of col -->
                    <div class="col-lg-6">
                        <div class="image-container">
                            <img class="img-fluid" src="images/download.png" alt="alternative">
                        </div> <!-- end of image-container -->
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of basic-4 -->
        <!-- end of download -->
    </section>


    <!-- Footer -->
    <div class="footer bg-dark-blue">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-col first">
                        <h6>About Leno</h6>
                        <p class="p-small">Leno is a mobile app HTML Bootstrap landing page template built to help you
                            create great basic websites for apps and grow the user base.</p>
                    </div> <!-- end of footer-col -->
                    <div class="footer-col second">
                        <h6>Links</h6>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li>Important: <a href="terms.html">Terms & Conditions</a>, <a href="privacy.html">Privacy
                                    Policy</a></li>
                            <li>Useful: <a href="#">Colorpicker</a>, <a href="#">Icon Library</a>, <a
                                    href="#">Illustrations</a></li>
                            <li>Menu: <a href="article.html">Article</a>, <a href="features.html">Features</a>, <a
                                    href="pricing.html">Pricing</a>, <a href="contact.html">Contact</a></li>
                        </ul>
                    </div> <!-- end of footer-col -->
                    <div class="footer-col third">
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-twitter fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-pinterest-p fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-instagram fa-stack-1x"></i>
                            </a>
                        </span>
                        <p class="p-small">We would love to hear from you <a
                                href="mailto:contact@leno.com"><strong>contact@leno.com</strong></a></p>
                    </div> <!-- end of footer-col -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of footer -->
    <!-- end of footer -->


    <!-- Copyright -->
    <div class="copyright bg-dark-blue">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <p class="p-small text-white">Knowledge & Media Management Helpdesk powered by IMPStudio</p>
                </div> <!-- end of col -->
                <div class="col-lg-6">
                    <p class="p-small text-white">Copyright © <a class="text-white"
                            href="https://impstudio.id/">IMPStudio 2020</a></p>
                </div> <!-- end of col -->
            </div> <!-- enf of row -->
        </div> <!-- end of container -->
    </div> <!-- end of copyright -->
    <!-- end of copyright -->


    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('assets/vendor/jquery/jquery.min.js') }}">
    </script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script type="text/javascript"
        src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Bootstrap framework -->
    <script type="text/javascript"
        src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="{{ asset('assets/js/swiper.min.js') }}"></script>
    <!-- Swiper for image and text sliders -->
    <script src="{{ asset('assets/js/jquery.magnific-popup.js') }}"></script>
    <!-- Magnific Popup for lightboxes -->
    <script src="{{ asset('assets/js/morphext.min.js') }}"></script>
    <!-- Morphtext rotating text in the header -->
    <script src="{{ asset('assets/js/validator.min.js') }}"></script>
    <!-- Validator.js - Bootstrap plugin that validates forms -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script> <!-- Custom scripts -->
</body>

</html>
