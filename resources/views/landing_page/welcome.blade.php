<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Business, Service">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <title>KOMA | Halaman Depan</title>

    <!-- Favicon  -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/koma-logo.svg') }}">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}"
        rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nivo-lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

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
                    <a href="index.html" class="navbar-brand"><img
                            src="{{ asset('assets/images/landing/landing-logo-koma.svg') }}"
                            alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto w-100 justify-content-end">
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="#home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="#business-plan">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="#blog">Resources</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="#contact">Contact</a>
                            </li>
                            @if(Route::has('login'))
                                @auth
                                    @if (auth()->user()->role_id == 1 OR auth()->user()->role_id == 2)
                                        <li class="nav-item">
                                            <a class="nav-link page-scroll" href="{{ url('/home') }}">Dashboard</a>
                                        </li>
                                    @endif
                                        @if (auth()->user()->role_id == 3)
                                            <li class="nav-item">
                                                <a class="btn btn-singin" style="background: #dc3545; border-radius: 15px;" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">Logout <i class="fas fa-sign-out-alt"></i>
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                    @endif
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
            <div class="container">
                <div class="row space-100">
                    <div class="col-lg-6 col-md-12 col-xs-12 mt-xl-5">
                        <div class="intro-img">
                            <img src="{{ asset('assets/images/landing/landing-illustration.svg') }}"
                                alt="">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-xs-12">
                        <div class="contents">
                            <h2 class="ml-sm-3">add, report, and manage everything easily.</h2>
                            <div class="col-11">
                                <p class="text-left">
                                    KOMA Helpdesk is a management app that was build for the purpose of "easily manage everything" with an easy to navigate interface, feather-weight load time and responsive interactions.
                                </p>
                            </div>
                            <div class="header-button">
                                <a class="btn btn-common" style="border-radius: 15px" href="{{ route('login') }}">Learn More<i class="fas fa-arrow-right ml-3"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header Section End -->

        <!-- Business Plan Section Start -->
        <section id="business-plan" class="section">
            <div class="container">

                <div class="row">
                    <!-- Start Col -->
                    <div class="col-lg-5 col-md-10 pl-4">
                        <div class="business-item-info">
                            <h3>What is KOMA Helpdesk?</h3>
                            <p class="text-justify">
                                @foreach ($Descriptions as $Description)
                                    {{$Description->desc}}
                                @endforeach
                            </p>
                        </div>
                    </div>
                    <!-- End Col -->
                    <!-- Start Col -->
                    <div class="col-lg-6 col-md-12 pl-0 pt-70 pr-5 offset-1">
                        <div class="business-item-img">
                            <img src="{{ asset('assets/images/landing/landing-icons.svg') }}"
                                class="img-fluid" alt="">
                        </div>
                    </div>
                    <!-- End Col -->

                </div>
            </div>
        </section>
        <!-- Business Plan Section End -->

        <!-- Blog Section -->
        <section id="blog" class="section">
            <!-- Container Starts -->
            <div class="container">
                <!-- Start Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="blog-text section-header text-center">
                            <div>
                                <h2 class="section-title">Here’s some of our resources</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->

                @if($Articles->count() > 0)
                    <!-- Start Row -->
                    <div class="row">
                        @foreach($Articles as $Article)
                            <!-- Start Col -->
                                <div class="col-lg-4 col-md-6 col-xs-12 blog-item mb-3">
                                    <!-- Blog Item Starts -->
                                    <div class="blog-item-wrapper">
                                        <div class="blog-item-text">
                                            <h3>
                                                <a href="/post/{{$Article->id}}/show">{{ $Article->title }}</a>
                                            </h3>
                                            <a href="/post/{{$Article->id}}/show" class="read-more">5 Min read</a>
                                        </div>
                                        <div class="author">
                                            <span class="name"><i class="fas fa-user"></i><a href="/post/{{$Article->id}}/show">Posted by
                                                    {{ $Article->author_name }}</a></span>
                                            <span class="date float-right"><i class="fas fa-calendar-alt"></i><a
                                                    href="/post/{{$Article->id}}/show">{{ $Article->created_at->diffForHumans() }}</a></span>
                                        </div>
                                    </div>
                                    <!-- Blog Item Wrapper Ends-->
                                </div>
                            <!-- End Col -->
                        @endforeach
                    </div>
                    <!-- End Row -->
                @else
                    <div class="row my-5">
                        <div class="col-12 my-5">
                            <h6 class="text-center">Maaf Artikel Belum Tersedia Saat Ini</h6>
                        </div>
                    </div>
                @endif
                <div class="span9 btn-block">
                    <a class="btn btn-show btn-block mt-md-5" style="border-radius: 15px" href="/post">Show More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </section>
        <!-- blog Section End -->

        <!-- Contact Us Section -->
        <section id="contact" class="section">
            <!-- Container Starts -->
            <div class="container">
                <!-- Start Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="contact-text section-header text-center">
                            <div>
                                <h2 class="section-title">Got something to tell us?</h2>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End Row -->
                <!-- Start Row -->
                <div class="row">
                    <!-- Start Col -->
                    <div class="col-lg-8 col-md-12">
                        <form id="contactForm" action="/project/ticket" method="POST">
                            @csrf

                            @if(Route::has('login'))
                                @auth
                                    <input type="hidden" id="user_id" name="user_id" value="{{ Auth()->user()->id }}">
                                    <input type="hidden" id="role_id" name="role_id" value="{{ Auth()->user()->role_id }}">
                                    <input type="hidden" id="author_name" name="author_name" value="{{ Auth()->user()->name }}">
                                    <input type="hidden" id="author_email" name="author_email" value="{{ Auth()->user()->email }}">
                                    <input type="hidden" id="status_id" name="status_id" value="1">
                                @else
                                @endauth
                                <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="title" name="title"
                                                    placeholder="Judul issue" data-error="Please enter your title">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <select class="custom-select form-control @error('project_id') is-invalid @enderror"
                                                        id="project_id" name="project_id"
                                                        value="{{ old('project_id') }}">
                                                        <option value="0">Pilih Aplikasi</option>
                                                        @foreach($Projects as $Project)
                                                            <option value="{{ $Project->id }}">
                                                                {{ $Project->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('project_id')
                                                        <div class="help-block with-errors">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                                    data-error="Please enter your name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" placeholder="Subject" id="msg_subject" class="form-control"
                                                    name="msg_subject" data-error="Please enter your subject">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="email" name="email"
                                                    placeholder="Email" data-error="Please enter your Email">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" placeholder="Budget" id="budget" class="form-control"
                                                    name="budget" data-error="Please enter your Budget">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" id="content" name="content"
                                                    placeholder="Write content" rows="4"
                                                    data-error="Write your content"></textarea>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <div class="submit-button">
                                                <button class="btn btn-common" style="border-radius: 15px" id="submit" type="submit">Submit</button>
                                                    <div id="msgSubmit" class="h3 hidden"></div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                            @endif
                        </form>
                    </div>
                    <!-- End Col -->
                    <!-- Start Col -->
                    <div class="col-lg-4 col-md-12">
                        <div class="contact-img">
                            <img src="{{ asset('assets/images/landing/contact.png') }}"
                                class="img-fluid" alt="">
                        </div>
                    </div>
                    <!-- End Col -->
                    <!-- Start Col -->
                    <div class="col-lg-1">
                    </div>
                    <!-- End Col -->

                </div>
                <!-- End Row -->
            </div>
        </section>
        <!-- Contact Us Section End -->
    </section>

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
                    <div class="col-lg-3 col-md-8 col-sm-8 col-xs-8 col-mb-12 offset-xl-1">
                        <div class="widget">
                            <h3 class="block-title">Links</h3>
                            <ul class="menu">
                                <li><a href="#home"> - Home</a></li>
                                <li><a href="#business-plan">- About</a></li>
                                <li><a href="#blog">- Resources</a></li>
                                <li><a href="#contact">- Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Col -->

                    <!-- Start Col -->
                    <div class="col-lg-3 col-md-8 col-sm-8 col-xs-8 col-mb-12 offset-xl-1">
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
                                IMPStudio 2020
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
    <script type="text/javascript" src="{{ asset('assets/vendor/jquery/jquery.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript -->
    <script type="text/javascript"
        src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nav.js') }}"></script>
    <script src="{{ asset('assets/js/scrolling-nav.js') }}"></script>
    <script src="{{ asset('assets/js/nivo-lightbox.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{ route('upload.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
        });
    </script>

</body>

</html>
