@extends('layouts.main')
@section('pageTitle', 'Informasi Dokter')
@section('title', $dokter->nama_dokter)
@section('content')
    <div class="row">
        <div class="col-6">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h6 class="m-0 font-weight-bold text-primary">Data Dokter</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form class="user">
                        <div class=" form-group">
                            <div class="row">
                                <div class="col-3 align-self-center">
                                    <label for="nama_dokter">Nomor Sertifikat Dokter</label>
                                </div>
                                <div class="col">
                                    <input type="text" name="nama_dokter"
                                        class="form-control form-control-user @error('nama_dokter') is-invalid @enderror"
                                        id="nama_dokter" aria-describedby="nama_dokter" placeholder="Nama Dokter..."
                                        value="{{ $dokter->certificate ? $dokter->certificate->certificate_number : '-' }}"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div class=" form-group">
                            <div class="row">
                                <div class="col-3 align-self-center">
                                    <label for="nama_dokter">Nama Dokter</label>
                                </div>
                                <div class="col">
                                    <input type="text" name="nama_dokter"
                                        class="form-control form-control-user @error('nama_dokter') is-invalid @enderror"
                                        id="nama_dokter" aria-describedby="nama_dokter" placeholder="Nama Dokter..."
                                        value="{{ $dokter->nama_dokter }}" readonly>
                                    @error('nama_dokter')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3 align-self-center">
                                    <label for="telepon_dokter">No. Telp. Dokter</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control form-control-user" id="telepon_dokter"
                                        name="telepon_dokter" placeholder="No. Telepon" value="{{ $dokter->telp }}"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ url('/dokter') }}" class="btn btn-warning btn-user btn-block"><i
                                            class="fas fa fa-backward mr-2"></i>Back</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h6 class="m-0 font-weight-bold text-primary">Review Dokter</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            @foreach ($dokter->reviews as $review)
                                <div class="card border-left-primary mb-3">
                                    <div class="card-body">
                                        {{ $review->content }}
                                    </div>
                                    <div class="card-footer py-0">
                                        <small>{{ $review->created_at }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
