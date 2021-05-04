<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/sb/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/sb/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/timepicker/jquery.timepicker.css') }}" rel="stylesheet" type="text/css">
    <style>
        .rounded-input {
            border-radius: 10rem;
            font-size: .8rem;
        }

        select>option {
            font-size: .8rem !important;
        }

    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-6 col-md-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            {{-- <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            </div> --}}
                            <div class="col">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Buat Janji Dengan Dokter</h1>
                                        @if (session('message'))
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>Peringatan!</strong> {{ session('message') }}
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        @if (session('sukses'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Berhasil!</strong> {{ session('sukses') }}
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <form class="user" method="POST" action="{{ url('/book/create_booking') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="nama"
                                                class="form-control form-control-user @error('nama') is-invalid @enderror"
                                                id="nama" aria-describedby="nama" placeholder="Nama Lengkap..."
                                                value="{{ old('nama') }}">
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control form-control-user @error('telepon') is-invalid @enderror"
                                                id="telepon" name="telepon" placeholder="No. Telepon"
                                                value="{{ old('telepon') }}">
                                            @error('telepon')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control form-control-user datepicker @error('telepon') is-invalid @enderror"
                                                id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir"
                                                value="{{ old('tgl_lahir') }}">
                                            @error('tgl_lahir')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control rounded-input" id="dokter" name="dokter">
                                                <option selected>Pilih Dokter</option>
                                                @foreach ($list_dokter as $dokter)
                                                    <option value="{{ $dokter->id }}">{{ $dokter->nama_dokter }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="text"
                                                        class="form-control form-control-user datepicker @error('telepon') is-invalid @enderror"
                                                        id="tgl" name="tgl" placeholder="Pilih Tanggal"
                                                        value="{{ old('tgl') }}">
                                                    @error('tgl')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="text"
                                                        class="form-control form-control-user timepicker @error('telepon') is-invalid @enderror"
                                                        id="jam" name="jam" placeholder="Pilih Jam"
                                                        value="{{ old('jam') }}">
                                                    @error('jam')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="pesan" id="pesan" cols="30" rows="4" class="form-control"
                                                placeholder="pesan">{{ old('pesan') }}</textarea>
                                        </div>
                                        <input type="submit" name="submit" id="submit" value="Buat Janji"
                                            class="btn btn-primary btn-user btn-block">
                                        <a href="{{ url('/admin') }}" class="btn btn-secondary btn-user btn-block">Admin
                                            Page</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/sb/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/sb/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/sb/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/sb/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/timepicker/jquery.timepicker.js') }}"></script>

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
            startHour: d.getHours(),
            maxHour: 16,
            minHour: 08
        });

    </script>

</body>

</html>
