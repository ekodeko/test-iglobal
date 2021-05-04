@extends('layouts.main')
@section('pageTitle', $title)
@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card shadow mb-4">
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
                    <form class="user" method="POST" action="">
                        @csrf
                        <div class="form-group">
                            {{-- <input type="text"
                                class="form-control form-control-user text-center @error('name') is-invalid @enderror"
                                name="name" id="exampleInputPhone" aria-describedby="phoneHelp" placeholder="Nama anda..."
                                value="{{ $user->name }}"> --}}
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password"
                                class="form-control form-control-user @error('old_password') is-invalid @enderror"
                                name="old_password" id="exampleInputOldPassword" aria-describedby="oldPasswordHelp"
                                placeholder="Password Lama" value="">
                            @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password"
                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                name="password" id="exampleInputPassword" aria-describedby="passwordHelp"
                                placeholder="Password Baru" value="">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password"
                                class="form-control form-control-user @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" id="exampleInputPasswordConfirmation"
                                aria-describedby="passwordConfirmationHelp" placeholder="Ulang Password Baru" value="">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            {{ __('Ganti Password') }}
                        </button>
                        <hr>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
