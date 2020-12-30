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
                        @foreach ($list_reservation as $reservation)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $reservation->user->name }}</td>
                                <td>Dr. {{ $reservation->dokter->nama_dokter }}</td>
                                <td>{{ $reservation->tanggal_kunjungan }}</td>
                                <td>{{ $reservation->jam_kunjungan }}</td>
                                <td>
                                    {{-- <a
                                        href="{{ url('dokter/' . $dokter->id . '/edit') }}"
                                        class="btn btn-info btn-sm">Edit</a> --}}
                                    <form action="{{ url('book/' . $reservation->id) }}" method="POST" class="d-inline">
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
