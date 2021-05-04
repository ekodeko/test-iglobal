@extends('layouts.main')
@section('pageTitle', $title)
@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            @if (PASSWORD_VERIFY($user->phone, $user->password))
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Peringatan!!!</h4>
                    <p>Halo <b>{{ $user->name }}</b> sistem kami mendeteksi kamu belum mengganti password dan masih sama
                        dengan
                        nomer telpon, harap ganti password kamu sekarang demi keamanan akun dengan mengklik link di bawah.
                    </p>
                    <hr>
                    <a href="{{ url('user/change_password') }}" class="alert-link">Ganti Password</a>
                </div>
            @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
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
                </div>
                <div class="card-body">
                    <div class="row justify-content-center position-relative">
                        <div class="card-image mb-3">
                            <img class="img-profile"
                                src="{{ $user->profile_picture != 'default_profile_picture.png' ? asset('images/reseller/' . $user->profile_picture) : asset('assets/sb/img/default_profile_picture.png') }}">
                        </div>
                        <a href="#" class="btn btn-circle floating-button" data-toggle="modal"
                            data-target="#changePpModal"><i class="fas fa-fw fa-edit"></i></a>
                    </div>
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
                        <div class="row">
                            <div class="col text-center">
                                <label for="" class="text-dark">{{ $user->name }}</label>
                            </div>
                        </div>
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
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-user @error('phone') is-invalid @enderror"
                                        name="phone" id="exampleInputPhone" aria-describedby="phoneHelp"
                                        placeholder="No. Hp / Whatsapp anda..." value="{{ $user->phone }}" readonly>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="email"
                                        class="form-control form-control-user @error('email') is-invalid @enderror"
                                        name="email" id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Email anda..." value="{{ $user->email }}" readonly>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user @error('address') is-invalid @enderror"
                                name="address" id="exampleInputPhone" aria-describedby="phoneHelp"
                                placeholder="Alamat anda..." value="{{ $user ? $user->address : '' }}" readonly>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="province"
                                        id="exampleInputPhone" aria-describedby="phoneHelp" placeholder="Provinsi"
                                        value="{{ $user ? $user->province : '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="city"
                                        id="exampleInputPhone" aria-describedby="phoneHelp" placeholder="Kota / Kabupaten"
                                        value="{{ $user ? $user->city : '' }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="subdistrict"
                                        id="exampleInputPhone" aria-describedby="phoneHelp" placeholder="Kecamatan"
                                        value="{{ $user ? $user->subdistrict : '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="zip"
                                        id="exampleInputPhone" aria-describedby="phoneHelp" placeholder="Kode Pos"
                                        value="{{ $user ? $user->zip : '' }}" readonly>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block" hidden>
                            {{ __('Simpan') }}
                        </button>
                        <hr>
                    </form>
                </div>
            </div>
            <div class="card shadow mb-4">
                <form class="user" method="POST" action="{{ url('sale/set_sell_price') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col">
                                <h6 class="m-0 font-weight-bold text-primary">Atur Harga Jual</h6>
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
                                        placeholder="Masukan harga jual" value="{{ Auth::user()->sell_price }}" required
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
            {{-- set product price --}}
        </div>
        <div class="col-12 col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h6 class="m-0 font-weight-bold text-primary">Level kamu saat ini</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12 col-lg-9">
                            <div class="card shadow-lg mb-4 my-card py-2 py-lg-4" style="max-width: 540px;">
                                @if ($user->orders->sum('quantity') >= $user->bronze)
                                    <img src="{{ asset('assets/sb/img/badge-silver.png') }}" alt="" class="card-badge">
                                @elseif($user->orders->sum('quantity') >= $user->silver)
                                    <img src="{{ asset('assets/sb/img/badge-gold.png') }}" alt="" class="card-badge">
                                @elseif($user->orders->sum('quantity') >= $user->gold)
                                    <img src="{{ asset('assets/sb/img/badge-platinum.png') }}" alt="" class="card-badge">
                                @else
                                    <img src="{{ asset('assets/sb/img/badge-silver.png') }}" alt="" class="card-badge">
                                @endif
                                <div class="row no-gutters">
                                    <div class="col-5 align-self-center text-center py-4">
                                        <div class="card-image">
                                            <img class="img-profile"
                                                src="{{ $user->profile_picture != 'default_profile_picture.png' ? asset('images/reseller/' . $user->profile_picture) : asset('assets/sb/img/default_profile_picture.png') }}">
                                        </div>
                                        <h6 class="card-title my-1 text-capitalize">
                                            <strong>{{ Auth::user()->name }}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-7">
                                        <div class="card-body">
                                            <div class="row align-items-center mb-2">
                                                <div class="col-3">
                                                    <img src="{{ asset('assets/sb/img/box.png') }}" alt="">
                                                </div>
                                                <div class="col-9">
                                                    <span>Stock</span>
                                                    <span class="detail"><strong>{{ $user->orders->sum('quantity') * $product_per_box - $user->sales->sum('quantity') }}
                                                            (Rp.
                                                            {{ $user->orders->sum('quantity') * $product_per_box * $product_het }})</strong></span>
                                                </div>
                                            </div>
                                            <div class="row align-items-center mb-2">
                                                <div class="col-3">
                                                    <img src="{{ asset('assets/sb/img/tree.png') }}" alt="">
                                                </div>
                                                <div class="col-8">
                                                    <span>Profit</span>
                                                    <span class="detail"><strong>Rp.
                                                            {{ ($user->sell_price - $product_het) * $user->sales->sum('quantity') }}</strong></span>
                                                </div>
                                            </div>
                                            <div class="row align-items-center mb-2">
                                                <div class="col-3">
                                                    <img src="{{ asset('assets/sb/img/graph.png') }}" alt="">
                                                </div>
                                                <div class="col-8">
                                                    <span>Omset</span>
                                                    <span class="detail"><strong>Rp.
                                                            {{ $user->sell_price * $user->sales->sum('quantity') }}</strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col text-center">
                            Naikkan terus level kamu untuk mendapat benefit berlimpah
                        </div>
                    </div>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row justify-content-center">
                                    <div class="col-12 col-md-12 col-lg-9">
                                        <div class="card shadow-lg mb-4 my-card py-2 py-lg-4" style="max-width: 540px;">
                                            <img src="{{ asset('assets/sb/img/badge-silver.png') }}" alt=""
                                                class="card-badge">
                                            <div class="row no-gutters">
                                                <div class="col-5 align-self-center text-center py-4">
                                                    <div class="card-image">
                                                        <img class="img-profile"
                                                            src="{{ $user->profile_picture != 'default_profile_picture.png' ? asset('images/reseller/' . $user->profile_picture) : asset('assets/sb/img/default_profile_picture.png') }}">
                                                    </div>
                                                    <h6 class="card-title my-1 text-capitalize">
                                                        <strong>{{ Auth::user()->name }}</strong>
                                                    </h6>
                                                </div>
                                                <div class="col-7">
                                                    <div class="card-body">
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-3">
                                                                <img src="{{ asset('assets/sb/img/box.png') }}" alt="">
                                                            </div>
                                                            <div class="col-9">
                                                                <span>Stock</span>
                                                                <span class="detail"><strong>{{ $user->orders->sum('quantity') * $product_per_box - $user->sales->sum('quantity') }}
                                                                        (Rp.
                                                                        {{ $user->orders->sum('quantity') * $product_per_box * $product_het }})</strong></span>
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-3">
                                                                <img src="{{ asset('assets/sb/img/tree.png') }}" alt="">
                                                            </div>
                                                            <div class="col-8">
                                                                <span>Profit</span>
                                                                <span class="detail"><strong>Rp.
                                                                        {{ ($user->sell_price - $product_het) * $user->sales->sum('quantity') }}</strong></span>
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-3">
                                                                <img src="{{ asset('assets/sb/img/graph.png') }}" alt="">
                                                            </div>
                                                            <div class="col-8">
                                                                <span>Omset</span>
                                                                <span class="detail"><strong>Rp.
                                                                        {{ $user->sell_price * $user->sales->sum('quantity') }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            benfit
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row justify-content-center">
                                    <div class="col-12 col-md-12 col-lg-9">
                                        <div class="card shadow-lg mb-4 my-card py-2 py-lg-4" style="max-width: 540px;">
                                            <img src="{{ asset('assets/sb/img/badge-gold.png') }}" alt=""
                                                class="card-badge">
                                            <div class="row no-gutters">
                                                <div class="col-5 align-self-center text-center py-4">
                                                    <div class="card-image">
                                                        <img class="img-profile"
                                                            src="{{ $user->profile_picture != 'default_profile_picture.png' ? asset('images/reseller/' . $user->profile_picture) : asset('assets/sb/img/default_profile_picture.png') }}">
                                                    </div>
                                                    <h6 class="card-title my-1 text-capitalize">
                                                        <strong>{{ Auth::user()->name }}</strong>
                                                    </h6>
                                                </div>
                                                <div class="col-7">
                                                    <div class="card-body">
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-3">
                                                                <img src="{{ asset('assets/sb/img/box.png') }}" alt="">
                                                            </div>
                                                            <div class="col-9">
                                                                <span>Stock</span>
                                                                <span class="detail"><strong>{{ $user->orders->sum('quantity') * $product_per_box - $user->sales->sum('quantity') }}
                                                                        (Rp.
                                                                        {{ $user->orders->sum('quantity') * $product_per_box * $product_het }})</strong></span>
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-3">
                                                                <img src="{{ asset('assets/sb/img/tree.png') }}" alt="">
                                                            </div>
                                                            <div class="col-8">
                                                                <span>Profit</span>
                                                                <span class="detail"><strong>Rp.
                                                                        {{ ($user->sell_price - $product_het) * $user->sales->sum('quantity') }}</strong></span>
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-3">
                                                                <img src="{{ asset('assets/sb/img/graph.png') }}" alt="">
                                                            </div>
                                                            <div class="col-8">
                                                                <span>Omset</span>
                                                                <span class="detail"><strong>Rp.
                                                                        {{ $user->sell_price * $user->sales->sum('quantity') }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            benfit
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row justify-content-center">
                                    <div class="col-12 col-md-12 col-lg-9">
                                        <div class="card shadow-lg mb-4 my-card py-2 py-lg-4" style="max-width: 540px;">
                                            <img src="{{ asset('assets/sb/img/badge-platinum.png') }}" alt=""
                                                class="card-badge">
                                            <div class="row no-gutters">
                                                <div class="col-5 align-self-center text-center py-4">
                                                    <div class="card-image">
                                                        <img class="img-profile"
                                                            src="{{ $user->profile_picture != 'default_profile_picture.png' ? asset('images/reseller/' . $user->profile_picture) : asset('assets/sb/img/default_profile_picture.png') }}">
                                                    </div>
                                                    <h6 class="card-title my-1 text-capitalize">
                                                        <strong>{{ Auth::user()->name }}</strong>
                                                    </h6>
                                                </div>
                                                <div class="col-7">
                                                    <div class="card-body">
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-3">
                                                                <img src="{{ asset('assets/sb/img/box.png') }}" alt="">
                                                            </div>
                                                            <div class="col-9">
                                                                <span>Stock</span>
                                                                <span class="detail"><strong>{{ $user->orders->sum('quantity') * $product_per_box - $user->sales->sum('quantity') }}
                                                                        (Rp.
                                                                        {{ $user->orders->sum('quantity') * $product_per_box * $product_het }})</strong></span>
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-3">
                                                                <img src="{{ asset('assets/sb/img/tree.png') }}" alt="">
                                                            </div>
                                                            <div class="col-8">
                                                                <span>Profit</span>
                                                                <span class="detail"><strong>Rp.
                                                                        {{ ($user->sell_price - $product_het) * $user->sales->sum('quantity') }}</strong></span>
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-3">
                                                                <img src="{{ asset('assets/sb/img/graph.png') }}" alt="">
                                                            </div>
                                                            <div class="col-8">
                                                                <span>Omset</span>
                                                                <span class="detail"><strong>Rp.
                                                                        {{ $user->sell_price * $user->sales->sum('quantity') }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            benfit
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row justify-content-center">
                                    <div class="col-12 col-md-12 col-lg-9">
                                        <div class="card shadow-lg mb-4 my-card py-2 py-lg-4" style="max-width: 540px;">
                                            <img src="{{ asset('assets/sb/img/badge-diamond.png') }}" alt=""
                                                class="card-badge">
                                            <div class="row no-gutters">
                                                <div class="col-5 align-self-center text-center py-4">
                                                    <div class="card-image">
                                                        <img class="img-profile"
                                                            src="{{ $user->profile_picture != 'default_profile_picture.png' ? asset('images/reseller/' . $user->profile_picture) : asset('assets/sb/img/default_profile_picture.png') }}">
                                                    </div>
                                                    <h6 class="card-title my-1 text-capitalize">
                                                        <strong>{{ Auth::user()->name }}</strong>
                                                    </h6>
                                                </div>
                                                <div class="col-7">
                                                    <div class="card-body">
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-3">
                                                                <img src="{{ asset('assets/sb/img/box.png') }}" alt="">
                                                            </div>
                                                            <div class="col-9">
                                                                <span>Stock</span>
                                                                <span class="detail"><strong>{{ $user->orders->sum('quantity') * $product_per_box - $user->sales->sum('quantity') }}
                                                                        (Rp.
                                                                        {{ $user->orders->sum('quantity') * $product_per_box * $product_het }})</strong></span>
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-3">
                                                                <img src="{{ asset('assets/sb/img/tree.png') }}" alt="">
                                                            </div>
                                                            <div class="col-8">
                                                                <span>Profit</span>
                                                                <span class="detail"><strong>Rp.
                                                                        {{ ($user->sell_price - $product_het) * $user->sales->sum('quantity') }}</strong></span>
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center mb-2">
                                                            <div class="col-3">
                                                                <img src="{{ asset('assets/sb/img/graph.png') }}" alt="">
                                                            </div>
                                                            <div class="col-8">
                                                                <span>Omset</span>
                                                                <span class="detail"><strong>Rp.
                                                                        {{ $user->sell_price * $user->sales->sum('quantity') }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            benfit
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            {{-- card input sales --}}
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

{{-- Modal --}}
<div class="modal fade" id="changePpModal" tabindex="-1" aria-labelledby="changePpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePpModalLabel">Ganti Foto Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('user/change_picture') }}" method="post" class="user"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Pilih File</label>
                        <div class="imagePreview">
                            <input type="file" class="upload" name="profile_picture" onchange="preview(this)">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
@push('script')
    <script>
        $('.carousel').carousel({
            interval: false
        });

    </script>
@endpush
