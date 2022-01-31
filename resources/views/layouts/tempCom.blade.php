<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>eMosque Website</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('templateMosque/New/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('templateMosque/New/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('templateMosque/New/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="{{ asset('templateMosque/New/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- Custom Css -->
    <link href="{{ asset('templateMosque/New/css/style.css') }}" rel="stylesheet">

    <!-- Morris Chart Css-->
    <link href="{{ asset('templateMosque/New/plugins/morrisjs/morris.css') }}" rel="stylesheet" />

    <!-- Colorpicker Css -->
    <link href="{{ asset('templateMosque/New/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" rel="stylesheet" />

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('templateMosque/New/css/themes/all-themes.css') }}" rel="stylesheet" />

    <!-- Dropzone Css -->
    <link href="{{ asset('templateMosque/New/plugins/dropzone/dropzone.css') }}" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="{{ asset('templateMosque/New/plugins/multi-select/css/multi-select.css') }}" rel="stylesheet">

    <!-- JQuery DataTable Css -->
    <link href="{{ asset('templateMosque/New/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="{{ asset('templateMosque/New/plugins/jquery-spinner/css/bootstrap-spinner.css') }}" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="{{ asset('templateMosque/New/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('templateMosque/New/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

    <!-- noUISlider Css -->
    <link href="{{ asset('templateMosque/New/plugins/nouislider/nouislider.min.css') }}" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="{{ asset('templateMosque/New/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('templateMosque/New/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />


    <style>
        .cuba {
            background-image: url("{{ asset('templateMosque/New/images/bgform.png') }}");
            background-size: auto;
            background-repeat: no-repeat;
        }

        li:hover {
            background-color: pink;
        }
    </style>
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

            //checkdate
            var StartDate = document.getElementById('txtFrom').value;
            var EndDate = document.getElementById('txtTo').value;
            var eDate = new Date(EndDate);
            var sDate = new Date(StartDate);
            if (StartDate != '' && StartDate != '' && sDate > eDate) {
                alert("Please ensure that the End Date is greater than or equal to the Start Date.");
                return false;
            }

            //checktime
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

<body class="theme-deep-brown">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <img class="image" src="{{ asset('templateMosque/New//images/giphy.gif') }}" width="48" height="48" alt="Mosque" />
                <a class="navbar-brand" href="index.html">eMosque Website</a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar bg-grey">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{ asset('templateMosque/New//images/user.jpg ') }}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{auth()->user()->userName}}</div>
                    <div class="email">{{auth()->user()->email}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>\
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="material-icons">input</i>Sign Out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu ">
                <div>
                    <ul class="list">
                        <li class="header"><b class="font-bold col-pink">MAIN NAVIGATION</b></li>
                        <li>
                            <a href="{{ route('committee')}}">
                                <i class="material-icons">home</i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('committees.comProfile',Auth::user()->id)}}">
                                <i class="material-icons">text_fields</i>
                                <span>User Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">assignment</i>
                                <span>Event</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="{{ route('events.create') }}">Create Event</a>
                                </li>
                                <li>
                                    <a href="{{ route('events.committee') }}">Event Available</a>
                                </li>
                                <li>
                                    <a href="{{ route('myBookings.index') }}">My Event</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('participates.index')}}">
                                <i class="material-icons">view_list</i>
                                <span>Participation</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('committees.index') }}">
                                <i class="material-icons">layers</i>
                                <span>Committe Member</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- #Menu -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                @yield('content')
            </div>

        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="{{ asset('templateMosque/New/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('templateMosque/New/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('templateMosque/New/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('templateMosque/New/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('templateMosque/New/plugins/node-waves/waves.js') }}"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('templateMosque/New/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('templateMosque/New/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('templateMosque/New/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('templateMosque/New/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('templateMosque/New/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('templateMosque/New/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('templateMosque/New/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('templateMosque/New/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('templateMosque/New/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('templateMosque/New/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ asset('templateMosque/New/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('templateMosque/New/plugins/morrisjs/morris.js') }}"></script>

    <!-- ChartJs -->
    <script src="{{ asset('templateMosque/New/plugins/chartjs/Chart.bundle.js') }}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{ asset('templateMosque/New/plugins/flot-charts/jquery.flot.js') }}"></script>
    <script src="{{ asset('templateMosque/New/plugins/flot-charts/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('templateMosque/New/plugins/flot-charts/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('templateMosque/New/plugins/flot-charts/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('templateMosque/New/plugins/flot-charts/jquery.flot.time.js') }}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ asset('templateMosque/New/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('templateMosque/New/js/admin.js') }}"></script>
    <script src="{{ asset('templateMosque/New/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="{{ asset('templateMosque/New/js/pages/index.js') }}"></script>
    <script src="{{ asset('templateMosque/New/js/pages/forms/basic-form-elements.js') }}"></script>
    <script src="{{ asset('templateMosque/New/js/pages/forms/advanced-form-elements.js') }}"></script>

    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="{{ asset('templateMosque/New/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>

    <!-- Input Mask Plugin Js -->
    <script src="{{ asset('templateMosque/New/plugins/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>

    <!-- Moment Plugin Js -->
    <script src="{{ asset('templateMosque/New/plugins/momentjs/moment.js') }}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('templateMosque/New/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="{{ asset('templateMosque/New/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>

    <!-- Demo Js -->
    <script src="{{ asset('templateMosque/New/js/demo.js') }}"></script>
    <script>
        /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
        function myDrop() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        function filterFunction() {
            var input, filter, ul, li, a, i;
            input = document.getElementById("role");
            filter = input.value.toUpperCase();
            div = document.getElementById("myDropdown");
            a = div.getElementsByTagName("a");
            for (i = 0; i < a.length; i++) {
                txtValue = a[i].textContent || a[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    a[i].style.display = "";
                } else {
                    a[i].style.display = "none";
                }
            }
        }
    </script>


</html>