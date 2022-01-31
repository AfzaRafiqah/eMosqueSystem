<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>eMosque Website</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Icons font CSS-->
    <link href="{{ asset('templateMosque/register/register/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('templateMosque/register/register/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">

    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i') }}" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="{{ asset('templateMosque/register/register/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('templateMosque/register/register/vendor/datepicker/daterangepicker.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('templateMosque/register/register/css/main.css') }}" rel="stylesheet" media="all">

    <script>
        function checkPassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("passwordConfirm").value;
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        }

        function viewPass() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    <style>
        .alert {
            padding: 20px;
            background-color: #f44336;
            color: white;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    </style>
</head>

<body>
    @if ($errors->has('email'))
    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>Opps!</strong> The email address already taken by other account.
    </div>
    @endif
    @if ($errors->has('userName'))
    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>Opps!</strong> The username already taken by other account. Please choose other username.
    </div>
    @endif

    <div class="page-wrapper bg-gra-01 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Registration form</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" onsubmit="return checkPassword()">
                        @csrf
                        <div class="form-row">
                            <div class="name">Name</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" placeholder="FULL NAME" style="text-transform:uppercase;" required autocomplete="name">
                                </div>
                            </div>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="name">Username</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="form-control @error('userName') is-invalid @enderror" type="text" name="userName" value="{{ old('userName') }}" placeholder="@username" required autocomplete="userName">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Date Of Birth</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="form-control @error('dOfBirth') is-invalid @enderror" type="date" name="dOfBirth" value="{{ old('dOfBirth') }}" max="<?= date('Y-m-d'); ?>" placeholder="10/1o/11" required autocomplete="dOfBirth">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Phone Number</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="form-control @error('phoneNumber') is-invalid @enderror" type="tel" name="phoneNumber" value="{{ old('phoneNumber') }}" placeholder="012-3456789" pattern="(01)[0|1|2|3|4|6|7|8|9]{1}-[0-9]{7,8}" required autocomplete="phoneNumber">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="ali@gmail.com" required>
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="form-control @error('password') is-invalid @enderror" name="password" id="password" type="password" minlength="6" title="6 or more characters" placeholder="******" required autocomplete="new-password">
                                    <div><span><a class="fa fa-eye"onclick="viewPass()"></a></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Confirm Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input id="passwordConfirm" class="form-control @error('password') is-invalid @enderror" type="password" placeholder="******" name="password_confirmation" minlength="6" title="6 or more characters" required autocomplete="new-password" required>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary" onclick="history.back()">Back</button>
                            <button class="btn btn-success" type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('templateMosque/register/register/vendor/jquery/jquery.min.js') }}"></script>
    <!-- Vendor JS-->
    <script src="{{ asset('templateMosque/register/register/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('templateMosque/register/register/vendor/datepicker/moment.min.js') }}"></script>
    <script src="{{ asset('templateMosque/register/register/vendor/datepicker/daterangepicker.js') }}"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>
    @include('sweetalert::alert')

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->