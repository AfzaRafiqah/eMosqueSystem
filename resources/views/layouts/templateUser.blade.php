<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('templateMosque/assets/img/mosqueIcon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('templateMosque/assets/img/mosqueIcon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>eMosque Website</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="{{ asset('templateMosque/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('templateMosque/assets/css/light-bootstrap-dashboard.css?v=2.0.0 ') }}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('templateMosque/assets/css/demo.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Sweetalert Css -->
    <link href="{{ asset('templateMosque/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Choose Location-->
    <script type="text/javascript">
        function CheckLocations(val) {
            var element = document.getElementById('location');
            if (val == 'OTHERS')
                element.style.display = 'block';
            else
                element.style.display = 'none';
        }

        function NumPart(val) {
            var element = document.getElementById('numLimit');
            if (val == 'invOthers')
                element.style.display = 'block';
            else
                element.style.display = 'none';
        }

        function ShowHideDiv() {
            var chkTah = document.getElementById("chkTah");
            var chkAkad = document.getElementById("chkAkad");
            var dvlocation = document.getElementById("dvlocation");
            if (chkTah.checked == true || chkAkad.checked == true)
                dvlocation.style.display = "block";
            else
                dvlocation.style.display = "none";

            var chkKem = document.getElementById("chkKem");
            var txtTo = document.getElementById("txtTo");
            txtTo.disabled = chkKem.checked ? false : true;
            if (!txtTo.disabled) {
                txtTo.focus();
            }
        }

        function ShowHideDivPart() {
            var oth = document.getElementById("others");
            var dvpart = document.getElementById("dvpart");
            if (oth.checked == true) {
                dvpart.style.display = "block";
            } else
                dvpart.style.display = "none";
        }

        function Compare() {
            var strStartTime = document.getElementById("txtStartTime").value;
            var strEndTime = document.getElementById("txtEndTime").value;

            var startTime = new Date().setHours(GetHours(strStartTime), GetMinutes(strStartTime), 0);
            var endTime = new Date(startTime)
            endTime = endTime.setHours(GetHours(strEndTime), GetMinutes(strEndTime), 0);
            if (startTime > endTime) {
                alert("Please enter invalid time");
                return false;
            } else {
                confirm("Are you sure?");
            }

        }

        function GetHours(d) {
            var h = parseInt(d.split(':')[0]);
            if (d.split(':')[1].split(' ')[1] == "PM") {
                h = h + 12;
            }
            return h;
        }

        function GetMinutes(d) {
            return parseInt(d.split(':')[1].split(' ')[0]);
        }
    </script>


</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="{{ asset('templateMosque/assets/img/mosqueSidebar.jpg') }}" data-color="green">
            <!--
            Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

            Tip 2: you can also add an image using data-image tag
            -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="./userProfile.html" class="simple-text">
                        eMosque website
                    </a>
                </div>
                <ul class="nav">
                    <li>
                        <a class="nav-link" href="{{ route('user')}}">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.show',Auth::user()->id)}}">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('uEvents.index') }}">
                            <i class="nc-icon nc-paper-2"></i>
                            <p>Event Available</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('myBookings.index') }}">
                            <i class="nc-icon nc-paper-2"></i>
                            <p>My Booking</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('participates.myPartIndex) }}">
                            <i class="nc-icon nc-paper-2"></i>
                            <p>My Application</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="../fullcalendarComm.html">
                            <i class="fa fa-calendar" style="font-size:36px"></i>
                            <p>Calendar</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="./announce.html">
                            <i class="nc-icon nc-notification-70"></i>
                            <p>Announcement</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#pablo"> Dashboard </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="dropdown">
                                    <i class="nc-icon nc-palette"></i>
                                    <span class="d-lg-none">Dashboard</span>
                                </a>
                            </li>
                            <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <i class="nc-icon nc-planet"></i>
                                    <span class="notification">5</span>
                                    <span class="d-lg-none">Notification</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Notification 1</a>
                                    <a class="dropdown-item" href="#">Notification 2</a>
                                    <a class="dropdown-item" href="#">Notification 3</a>
                                    <a class="dropdown-item" href="#">Notification 4</a>
                                    <a class="dropdown-item" href="#">Another notification</a>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nc-icon nc-zoom-split"></i>
                                    <span class="d-lg-block">&nbsp;Search</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#pablo">
                                    <span class="no-icon">Account</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="no-icon">Dropdown</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div class="divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <span class="no-icon">Log out</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <ul class="footer-menu">
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>

</body>
<!--   Core JS Files   -->
<script src="{{ asset('templateMosque/assets/js/core/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('templateMosque/assets/js/core/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('templateMosque/assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{ asset('templateMosque/assets/js/plugins/bootstrap-switch.js') }}"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="{{ asset('templateMosque/assets/js/plugins/chartist.min.js') }}"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset('templateMosque/assets/js/plugins/bootstrap-notify.js') }}"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="{{ asset('templateMosque/assets/js/light-bootstrap-dashboard.js?v=2.0.0') }} " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('templateMosque/assets/js/demo.js') }}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css" rel="Stylesheet" type="text/css" />


<script type="text/javascript">
    $(function() {
        $("#txtFrom").datepicker({
            numberOfMonths: 1,
            minDate: 0,
            onSelect: function(selected) {
                var dt = new Date(selected);
                dt.setDate(dt.getDate() + 1);
                $("#txtTo").datepicker("option", "minDate", dt);
            }
        });
        $("#txtTo").datepicker({
            numberOfMonths: 1,

            onSelect: function(selected) {
                var dt = new Date(selected);
                dt.setDate(dt.getDate() - 1);
                $("#txtFrom").datepicker("option", "maxDate", dt);
            }
        });
    });
</script>

</html>