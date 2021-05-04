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
                            <a href="{{ url('utility/reseller_marketing_kit/foto_produk') }}">
                                <h6 class="m-0 font-weight-bold text-primary">Foto Produk</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <form class="user" method="POST" action="reseller_marketing_kit/download_foto_produk">
                    @csrf
                    <div class="card-image-square">
                        <img class="card-img" src="{{ asset('assets/sb/img/burst.png') }}">
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-end">
                            <div class="col">Klik tombol untuk mengunduh semua foto product</div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-user btn-block"><i class="fas fa-download"
                                        title="Download Semua Foto Product"></i> Download</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <a href="{{ url('utility/reseller_marketing_kit/foto_produk') }}">
                                <h6 class="m-0 font-weight-bold text-primary">Foto Produk</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <form class="user" method="POST" action="reseller_marketing_kit/download_foto_produk">
                    @csrf
                    <div class="card-image-square">
                        <img class="card-img" src="{{ asset('assets/sb/img/burst.png') }}">
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-end">
                            <div class="col">Klik tombol untuk mengunduh semua foto product</div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-user btn-block"><i class="fas fa-download"
                                        title="Download Semua Foto Product"></i> Download</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <a href="{{ url('utility/reseller_marketing_kit/foto_produk') }}">
                                <h6 class="m-0 font-weight-bold text-primary">Foto Produk</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <form class="user" method="POST" action="reseller_marketing_kit/download_foto_produk">
                    @csrf
                    <div class="card-image-square">
                        <img class="card-img" src="{{ asset('assets/sb/img/burst.png') }}">
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-end">
                            <div class="col">Klik tombol untuk mengunduh semua foto product</div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-user btn-block"><i class="fas fa-download"
                                        title="Download Semua Foto Product"></i> Download</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <a href="{{ url('utility/reseller_marketing_kit/foto_produk') }}">
                                <h6 class="m-0 font-weight-bold text-primary">Foto Produk</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <form class="user" method="POST" action="reseller_marketing_kit/download_foto_produk">
                    @csrf
                    <div class="card-image-square">
                        <img class="card-img" src="{{ asset('assets/sb/img/burst.png') }}">
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-end">
                            <div class="col">Klik tombol untuk mengunduh semua foto product</div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-user btn-block"><i class="fas fa-download"
                                        title="Download Semua Foto Product"></i> Download</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="row justify-content-center mb-4">
        <a href="{{ url('utility/reseller_marketing_kit') }}"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>

@endsection
