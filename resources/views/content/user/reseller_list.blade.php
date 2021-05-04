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
                            <th>Nama Reseller</th>
                            <th>No. Telp / HP</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resellers as $reseller)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $reseller->name }}</td>
                                <td>{{ $reseller->phone }}</td>
                                <td>{{ $reseller->address }}</td>
                                <td>
                                    <a href="https://api.whatsapp.com/send?text=halo%20kk%2C%20harap%20buat%20pesanan%20agar%20akun%20reseller%20kk%20tidak%20di%20nonaktifkan%20ya&phone={{ $reseller->phone }}"
                                        target="_blank" class="btn btn-info btn-sm">Edit</a>
                                    <form action="{{ url('user/' . $reseller->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" name="submit" id="submit" class="btn btn-danger btn-sm"
                                            value="Delete">
                                        {{-- <a
                                            href="{{ url('/dokter/delete/' . $dokter->id) }}"
                                            class="btn btn-danger btn-sm">Delete</a> --}}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
