<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('asset_LogReg/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset_LogReg/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('asset_LogReg/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset_LogReg/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset_LogReg/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('asset_LogReg/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('asset_LogReg/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset_LogReg/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('asset_LogReg/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('asset_LogReg/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('asset_LogReg/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('asset_LogReg/style.css') }}">

</head>

<body>
   


<section class="ftco-section contact-section"style="background-image: url('{{ asset('images/kucingLog.png') }}'); background-size: contain; background-repeat: no-repeat; background-position: center center; height: 400px;">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-2 ftco-animate text-center"
                    style="background-color: white; border-radius: 10px 10px 10px 10px;margin-bottom: 30px;">
                    <div style="margin-bottom: 2px;">
                        <h1 class="mb-0 bread">Sign In</h1>
                    </div>
                </div>
            </div>

            <div class="container" style="align-self: center; align-items: center;" x>
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                
                    @if(session()->has('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('loginError') }}
                        </div>
                    @endif

                <form action="{{ route('login') }}" class="bg-white p-5 contact-form"
                    style="border-radius: 10px 10px 10px 10px;margin-bottom: 30px;" method="post">
                    @csrf
                    <h7><a href="/logPetugas">Are you an administrator? Click here.</a></h7>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" name="email" @error('email')  
                        @enderror  id="email" autofocus required value="{{ old ('email') }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Sign In" class="btn btn-primary py-3 px-5">
                    </div>
            </div>
            </form>
            <div class="col-md-4"
                style="background-color: white; border-radius: 10px 10px 10px 10px;margin-bottom: 30px;">
                <h5><a href="{{ route('password.request') }}">Forgot your password?</a></h4>
                </h5>
            </div>
            <div class="col-md-4"
                style="background-color: white; border-radius: 10px 10px 10px 10px;margin-bottom: 30px;">
                <h5><a href="/regUser">Don't have a username? Sign up now.</a></h4>
                </h5>
            </div>
        </div>

    </section>



    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/scrollax.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&sensor=false"></script>
    <script src="{{ asset('js/google-map.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>


</body>

</html>