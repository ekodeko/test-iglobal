@extends('layouts.main')
@section('pageTitle', 'Data Jadwal Dokter')
@section('title', 'Data Jadwal Dokter')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">Data Jadwal Dokter</h6>
                </div>
                {{-- <div class="col">
                    <a href="{{ url('/dokter/create') }}" class="btn btn-primary btn-icon-split float-right">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah dokter</span>
                    </a>
                </div> --}}
            </div>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="table-responsive">
                <div class="row">
                    <div class="form-group col-md-3">
                        <h6>Tanggal Kunjungan <span class="text-danger"></span></h6>
                        <div class="controls">
                            <input type="text" name="date_visit" id="date_visit" class="form-control datepicker">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <h6>Jam Kunjungan <span class="text-danger"></span></h6>
                        <div class="controls">
                            <input type="text" name="time_visit" id="time_visit" class="form-control timepicker">
                        </div>
                    </div>
                    <div class="form-group col-md-2 mt-4">
                        <div class="controls">
                            <button type="button" id="btn-filter" class="btn btn-secondary form-control">filter</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pasien</th>
                            <th>Dokter</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Jam Kunjungan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $("#dataTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('reservation') }}",
                    type: 'GET',
                    data: function(d) {
                        d.date_visit = $('#date_visit').val();
                        d.time_visit = $('#time_visit').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },
                    {
                        data: 'dokter',
                        name: 'dokter'
                    },
                    {
                        data: 'tanggal_kunjungan',
                        name: 'tanggal_kunjungan'
                    },
                    {
                        data: 'jam_kunjungan',
                        name: 'jam_kunjungan'
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ],

            })
            $('#btn-filter').click(function() {
                $('#dataTable').DataTable().draw();
            });
        });

    </script>
@endpush
