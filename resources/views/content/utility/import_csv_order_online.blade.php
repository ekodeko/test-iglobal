@extends('layouts.main')
@section('pageTitle', 'Data Jadwal Dokter')
@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                        </div>
                    </div>
                </div>
                <form class="user" method="POST" action="do_import_csv_order_online" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Sukses!</strong> {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <input type="file" name="file_order_csv" id="file_order_csv" class="form-control form-control-user">
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-end">
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary btn-user btn-block">Import</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
