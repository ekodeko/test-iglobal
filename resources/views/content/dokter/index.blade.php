@extends('layouts.main')
@section('pageTitle', 'Dokter')
@section('title', 'Dokter')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">Data Dokter</h6>
                </div>
                @if (Auth::user()->role_id == 2)
                    <div class="col">
                        <a href="{{ url('/dokter/create') }}" class="btn btn-primary btn-icon-split float-right">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Tambah dokter </span>
                        </a>
                    </div>
                @endif
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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Dokter</th>
                            <th>No. Sertifikat</th>
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
                ajax: 'dokter/getDataJson',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_dokter',
                        name: 'nama_dokter'
                    },
                    {
                        data: 'certificate.certificate_number',
                        name: 'certificate.certificate_number'
                    },
                ]
            })
        });

    </script>
@endpush
