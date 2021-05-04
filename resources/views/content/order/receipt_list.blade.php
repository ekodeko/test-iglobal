@extends('layouts.main')
@section('pageTitle', 'Upload Testimoni')
@section('title', $title)
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">Data Reseller</h6>
                </div>
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
                            <th>No. Resi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>49821948902428742</td>
                            <td>
                                <a href="https://resi.id/" target="_blank" class="btn btn-primary rounded-pill"
                                    data-action="share/whatsapp/share">Cek Resi</a>
                                {{-- <a href="https://api.whatsapp.com://send?text=tes%20share%20wahtsapp"
                                    data-action="share/whatsapp/share">Share
                                    via Whatsapp</a> --}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
