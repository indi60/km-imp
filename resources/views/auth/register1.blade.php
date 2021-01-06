<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KOMA | Sign Up</title>

    <!-- Fontawesome  -->
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('assets/css/auth.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Favicon  -->
    <link rel="icon" href="{{asset('assets/images/logo/koma-logo.svg')}}">
</head>
<body>

    <div class="main">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form" action="{{ route('register') }}">
                            @csrf

                            <input type="hidden" name="role_id" value="3">

                            <div class="form-group">
                                <label for="name"><i class="fa fa-user" aria-hidden="true"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name"/>
                            </div>

                            <div class="form-group">
                                <label for="jenis_kelamin"><i class="fa fa-venus-mars" aria-hidden="true"></i>Gender</label>
                                <br>
                                <div class="custom-control custom-radio custom-control-inline" style="margin-left: 90px">
                                    <input type="radio" id="Laki-laki" name="jenis_kelamin" class="custom-control-input"
                                        value="Laki-laki">
                                    <label class="custom-control-label" for="Laki-laki">Laki-laki</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="Perempuan" name="jenis_kelamin" class="custom-control-input"
                                        value="Perempuan">
                                    <label class="custom-control-label" for="Perempuan">Perempuan</label>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="alamat"><i class="fa fa-house-user" aria-hidden="true"></i></label>
                                <input type="text" name="alamat" id="alamat" placeholder="Your Address"/>
                            </div>

                            <div class="form-group">
                                <label for="no_hp"><i class="fa fa-phone" aria-hidden="true"></i></label>
                                <input type="tel" name="no_hp" id="no_hp" placeholder="+62-555-5555-5555"/>
                            </div>

                            <div class="form-group">
                                <label for="email"><i class="fas fa-envelope"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>

                            <div class="form-group">
                                <label for="password"><i class="fas fa-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="password-confirm"><i class="fas fa-unlock-alt"></i></label>
                                <input type="password" name="password-confirm" id="password-confirm" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{asset('assets/images/logo/koma-auth-illustration.svg')}}" alt="sing up image"></figure>
                        <a href="{{ route('login') }}" class="signup-image-link">I am already have account</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
