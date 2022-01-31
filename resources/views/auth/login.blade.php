<!doctype html>
<html lang="en">

<head>
    <title>eMosque Website</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('templateMosque/assets/img/mosqueIcon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('templateMosque/login-form-20/login-form-20/css/style.css')}}">

<body class="img js-fullheight" style="background-image: url(templateMosque/login-form-20/login-form-20/images/bg1.jpg);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    @if ($message = Session::get('warning'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Have an account?</h3>
                        <form method="POST" action="{{ route('login.custom') }}" aria-label="{{ __('Login') }}" class="signin-form">

                            @csrf
                            <div class="form-group">
                                <input style="color:blue" id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password-field" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <a href="{{ route('register') }}" style="color: #F5CBA7">Register New Account</a>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="{{ route('forget.password.get') }}" style="color: #fff">Forgot Password</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('templateMosque/login-form-20/login-form-20/js/jquery.min.js')}}"></script>
    <script src="{{ asset('templateMosque/login-form-20/login-form-20/js/popper.js')}}"></script>
    <script src="{{ asset('templateMosque/login-form-20/login-form-20/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('templateMosque/login-form-20/login-form-20/js/main.js')}}"></script>
    @include('sweetalert::alert')
</body>

</html>