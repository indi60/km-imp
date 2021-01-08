<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Custom fonts for this template -->
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Bootstrap -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>

    <div id="loginregister">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-8 col-xl-6">
                    <div class="row">
                        <div class="col text-center">
                            <h1 style="font-size: 74px; margin-top: 150px; color: black">Sign In</h1>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col mt-4">
                            <input type="text" class="form-control" placeholder="Company Name">
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <input type="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <input type="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="col">
                            <input type="password" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="row justify-content-start mt-4 mb-4">
                        <div class="col">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">
                                    I Read and Accept <a href="https://www.froala.com">Terms and Conditions</a>
                                </label>
                            </div>
                            <button class="btn btn-primary mt-4">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

<script type="text/javascript" src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

</html>
