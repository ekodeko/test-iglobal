@extends('layouts.main')
@section('pageTitle', 'Buat Janji dengan Dokter')
@section('title', 'Buat Janji dengan Dokter')
@section('content')
    <div class="card o-hidden border-0 shadow-lg">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                {{-- <div class="col-lg-6 d-none d-lg-block bg-login-image">
                </div> --}}
                <div class="col">
                    <div class="p-3">
                        <form class="user" method="POST" action="{{ url('/reservation') }}">
                            @csrf
                            <div class="row">
                                <div class="col-6">
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
                                                    class="form-control form-control-user datepicker @error('tgl') is-invalid @enderror"
                                                    id="tgl" name="tgl" placeholder="Pilih Tanggal" autocomplete="off"
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
                                                    class="form-control form-control-user timepicker @error('jam') is-invalid @enderror"
                                                    id="jam" name="jam" placeholder="Pilih Jam" value="{{ old('jam') }}"
                                                    autocomplete="off">
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
                                    <input type="reset" name="reset" id="reset" value="Batal"
                                        class="btn btn-secondary btn-user btn-block">
                                </div>
                                <div class="col-6">
                                    <div class="text-center">
                                        @if (session('message'))
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>Peringatan!</strong> {{ session('message') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        @if (session('sukses'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Berhasil!</strong> {{ session('sukses') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
