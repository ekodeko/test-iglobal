@extends('layouts.main')
@section('pageTitle', $title)
@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h6 class="m-0 font-weight-bold text-primary">Input Penjualan</h6>
                        </div>
                    </div>
                </div>
                <form class="user" method="POST" action="{{ url('sale/input_sale') }}">
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
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <label for="quantity" class="">Jumlah Barang</label>
                                </div>
                                <div class="col">
                                    <input type="text" name="quantity" id="quantity"
                                        class="form-control form-control-user @error('quantity') is-invalid @enderror"
                                        placeholder="Masukan jumlah barang" onkeypress="return onlyNumberKey(event)">
                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-end">
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
