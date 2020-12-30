@extends('layouts.main')
@section('pageTitle', 'Edit Data Dokter')
@section('title', 'Edit Data Dokter')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Data Dokter</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form class="user" method="POST" action="{{ url('dokter/' . $dokter->id) }}">
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3 align-self-center">
                                    <label for="nama_dokter">Nama Dokter</label>
                                </div>
                                <div class="col">
                                    <input type="text" name="nama_dokter"
                                        class="form-control form-control-user @error('nama_dokter') is-invalid @enderror"
                                        id="nama_dokter" aria-describedby="nama_dokter" placeholder="Nama Dokter..."
                                        value="{{ $dokter->nama_dokter }}">
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
                                        name="telepon_dokter" placeholder="No. Telepon" value="{{ $dokter->telepon }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ url('/dokter') }}" class="btn btn-warning btn-user btn-block"><i
                                            class="fas fa fa-backward mr-2"></i>Back</a>
                                </div>
                                <div class="col">
                                    <input type="submit" name="submit" id="submit" value="Save"
                                        class="btn btn-primary btn-user btn-block">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
