@extends('layouts.main')
@section('pageTitle', $title)
@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-6 col-md-6">
            <div class="card shadow mb-4">
                <form class="user" method="POST" action="{{ url('sale/set_sell_price') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col">
                                <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
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
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <div class="col-2">
                                    <label for="sell_price">Harga Jual</label>
                                </div>
                                <div class="col">
                                    <input type="text"
                                        class="form-control form-control-user @error('sell_price') is-invalid @enderror"
                                        name="sell_price" id="exampleInputTitle" aria-describedby="titleHelp"
                                        placeholder="Masukan harga jual" value="{{ $sell_price }}" required
                                        onkeypress="return onlyNumberKey(event)">
                                    @error('sell_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary btn-user">
                            {{ __('Simpan') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
