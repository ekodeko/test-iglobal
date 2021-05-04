@extends('layouts.auth')
@section('content')

    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Daftar Akun!</h1>
        </div>
        <form class="user" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" id="exampleInputEmail" name="name" placeholder="Nama Lengkap">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user @error('username') is-invalid @enderror"
                    name="username" value="{{ old('username') }}" id="exampleInputEmail" name="username"
                    placeholder="Username">
            </div>
            <div class="form-group">
                <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" id="exampleInputEmail" name="email" placeholder="Alamat Email">
            </div>
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend ">
                        <div class="input-group-text form-control-user-prepend-left">+62</div>
                    </div>
                    <input type="text" class="form-control form-control-user-right @error('phone') is-invalid @enderror"
                        name="phone" value="{{ old('phone') }}" id="inlineFormInputGroup"
                        placeholder="Nomor Hp / Whatsapp">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                        name="password" id="exampleInputPassword" name="password" placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword"
                        name="password_confirmation" placeholder="Ulang Password">
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                {{ __('Register') }}
            </button>
            {{-- <a href="index.html" class="btn btn-google btn-user btn-block">
                <i class="fab fa-google fa-fw"></i> Register with Google
            </a>
            <a href="index.html" class="btn btn-facebook btn-user btn-block">
                <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
            </a> --}}
        </form>
        <hr>
        <div class="text-center">
            <a class="small" href="forgot-password.html">Lupa Password?</a>
        </div>
        <div class="text-center">
            <a class="small" href="{{ route('login') }}">Sudah jadi reseller? Login!</a>
        </div>
    </div>

@endsection
