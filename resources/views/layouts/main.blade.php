<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('pageTitle') - Ubanone Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/sb/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/timepicker/jquery.timepicker.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/sb/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href=" {{ asset('assets/sb/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <script src="{{ asset('assets/sb/vendor/jquery/jquery.min.js') }}"></script>
    {{-- SWEET ALERT --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/sweetalert/sweetalert.css') }}">
    <script src="{{ asset('/assets/sweetalert/sweetalert.min.js') }}"></script>
    <style>
        .rounded-input {
            border-radius: 10rem;
            font-size: 1rem;
            /* padding: 1.5rem 1rem; */
        }

        select>option {
            font-size: 1rem !important;
            margin: 1rem 0;
        }

        a:hover {
            text-decoration: none;
        }

        .card-image,
        .card-image-square {
            display: inline-block;
            position: relative;
            width: 100px;
            height: 100px;
            overflow: hidden;
            border-radius: 50%;
        }

        .card-image-square {
            height: 250px !important;
            width: 100% !important;
            border-radius: 0;
        }

        .card-image img,
        .card-image-square img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .card-image-square img {
            object-fit: contain;
        }

        .my-card {
            position: relative;
            background: #ffffff url('../assets/sb/img/bg-ubanone-big.png') no-repeat bottom center;
            /* background-size: cover; */
            border: 2px solid rgb(212, 212, 212);
        }

        .my-card .card-badge {
            top: .5rem;
            left: .5rem;
            position: absolute;
            z-index: 1000;
            width: 30px;
            height: auto;
        }

        .my-card span {
            font-size: .8rem;
        }

        .my-card span.detail {
            display: block;
            margin-top: -5px;
            font-size: .8rem;
        }

        .my-card .my-card {
            font-size: .5rem;
        }

        .my-card .card-body img {
            width: 30px;
            height: auto;
        }

        @media screen and (min-width: 992px) {

            .card-image,
            .card-image-square {
                width: 120px;
                height: 120px;
            }

            .my-card span {
                font-size: 1rem !important;
            }

            .my-card .card-badge {
                width: 40px;
            }
        }

        .floating-button {
            position: absolute;
            top: 0;
            right: 35%;
            z-index: 2;
            color: #d8d8d8;
        }

        .floating-button:hover {
            color: #969696;
        }

        .imagePreview {
            width: 100%;
            height: 260px;
            margin-top: 10px;
            margin-right: 50px;
            background: url({{ asset('assets/sb/img/camera.png') }}) no-repeat center center;
            background-position: center center;
            background-size: cover;
            box-shadow: 0px 1px 2px 0px black;
            -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
            -moz-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
            display: inline-block;
            object-fit: cover;
        }

        .imagePreview::after {
            content: 'Pilih Gambar';
            position: absolute;
            top: 75%;
            left: 43%;
            font-size: 1rem;
            color: #000000;
        }

        .imagePreview input.upload {
            position: absolute;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
            width: 100%;
            height: 260px;
        }

        iframe {
            width: 100%;
            height: 250px;
        }

        .carousel-control-next-icon {
            background-image: url({{ asset('assets/sb/img/right-arrow.svg') }});
        }

        .carousel-control-prev-icon {
            background-image: url({{ asset('assets/sb/img/previous.svg') }});
        }

        .carousel-indicators li {
            background-color: #000000;
        }

        .lock-course-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;

            background: #ffffff;
            opacity: .9;
            z-index: 10000000 !important;
        }

        .lock-course {
            width: 100%;
            height: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        .lock-course-lock {
            width: 100px;
            height: 100px;
            background: url(<?= asset('assets/sb/img/padlock.svg')
                ?>
                ) center center no-repeat;
            background-size: contain;
            z-index: 100000000 !important;
        }

    </style>

    <script>
        function onlyNumberKey(evt) {

            // Only ASCII charactar in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }
        $(document).ready(function() {
            var title = '{{ session('GLOBAL_MESSAGE') ? session('GLOBAL_MESSAGE')['title'] : '' }}';
            var type = '{{ session('GLOBAL_MESSAGE') ? session('GLOBAL_MESSAGE')['type'] : '' }}';
            var message = '{{ session('GLOBAL_MESSAGE') ? session('GLOBAL_MESSAGE')['message'] : '' }}';
            if (title && type && message) {
                swal({
                    title: title,
                    type: type,
                    text: message,
                    timer: 10000000,
                });
            }
        });

        var preview = function(el) {
            if (el.files && el.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(el).parent().css({
                        'background-image': 'url(' + e.target.result + ')',
                        'background-size': 'contain',
                        'background-position': 'center center',
                        'background-repeat': 'no-repeat',
                    });
                }
                reader.readAsDataURL(el.files[0]);
            }
        }

    </script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                    </div>

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Reseller Ubanone {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->

    <script src="{{ asset('assets/sb/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/sb/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/sb/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/sb/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/sb/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/sb/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/timepicker/jquery.timepicker.js') }}"></script>
    <script src="{{ asset('assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                orientation: 'bottom'
            });
        });

        var d = new Date();
        $(".timepicker").timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            scrollbar: true,
            startHour: 9,
            maxHour: 16,
            minHour: 08
        });

        // input numeric only

    </script>

    @stack('script')

</body>

</html>
