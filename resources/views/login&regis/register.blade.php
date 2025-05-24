<!DOCTYPE html>
<html lang="en">

<head>
    <title>PetShop - Sign Up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
    <div class="container">
        <div class="container bg-white" style="align-self: center; align-items: center;">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-2 ftco-animate text-center" style="background-color: white; border-radius: 10px 10px 10px 10px;margin-bottom: 30px;">
                    <h1 class="mb-0 bread">Sign Up</h1>
                </div>
            </div>
            <form action="" class="bg-white p-5 contact-form" method="post">
                    @csrf

                <div class="form-group">
                    <input type="text" class="form-control @error('Nama_Akun') is-invalid @enderror" placeholder="Nama" name="Nama_Akun" id="Nama_Akun" required="{{ old('Nama_Akun') }}">
                    @error('Nama_Akun')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="text" class="form-control @error('Nama_Pengguna') is-invalid @enderror" placeholder="Username" name="Nama_Pengguna" required="{{ old('Nama_Pengguna') }}">
                    @error('Nama_Pengguna')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="text" class="form-control @error('Email') is-invalid @enderror" placeholder="Email" name="Email" required="{{ old('Email') }}">
                    @error('Email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="text" class="form-control @error('No_Telp') is-invalid @enderror" placeholder="No Telp" name="No_Telp" required="{{ old('No_Telp') }}">
                    @error('No_Telp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" class="form-control @error('Kata_Sandi') is-invalid @enderror" name="Kata_Sandi" id="Kata_Sandi" placeholder="password" required>
                    @error('Kata_Sandi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Re-Enter Password" name="password1"
                            required>
                    </div>

                <div class="form-group">
                    <input type="submit" value="Sign Up" class="btn btn-primary py-3 px-5">
                </div>

            </form>
            <h5><a href="/logUser">Already have an account? Sign In here</a></h5>
        </div>
    </div>

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
        </svg>
    </div>

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


    <!-- script for password match -->
    {{-- <script>
        window.onload = function() {
            document.getElementById("password").onchange = validatePassword;
            document.getElementById("password1").onchange = validatePassword;
        }

        function validatePassword() {
            var pass2 = document.getElementById("password1").value;
            var pass1 = document.getElementById("password").value;
            if (pass1 != pass2) {
                document.getElementById("password1").setCustomValidity("Passwords Don't Match"); }
            else {
                document.getElementById("password").setCustomValidity(''); }
            //empty string means no validation error
        }
    </script> --}}
    <!-- script for password match -->
</body>

</html>
