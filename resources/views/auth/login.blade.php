@extends('layouts.auth')

@section('content')
    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
        </div>
        <form class="user" method="POST" action="{{ route('login') }}">
            @csrf
            {{-- <div class="form-group">
                <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email"
                    id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div> --}}
            <div class="form-group">
                <input type="text" class="form-control form-control-user @error('username') is-invalid @enderror"
                    name="username" id="exampleInputUsername" aria-describedby="usernameHelp"
                    placeholder="Enter Username...">
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                    name="password" id="exampleInputPassword" placeholder="Password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox small">
                    <input type="checkbox" class="custom-control-input" id="remember" name="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="customCheck">Remember Me</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                {{ __('Login') }}
            </button>
            <hr>
        </form>
        @if (Route::has('password.request'))
            <div class="text-center">
                <a class="small" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
        @endif
        <div class="text-center">
            <a class="small" href="{{ route('register') }}">Create an Account!</a>
        </div>
    </div>
@endsection
