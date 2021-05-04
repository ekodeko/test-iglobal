@extends('layouts.main')
@section('pageTitle', $title)
@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-12 col-md-12">
            <form class="user" method="POST" action="{{ url('utility/do_upload_testimoni') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col">
                                <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- <div class="row justify-content-center position-relative">
                        <div class="card-image mb-3">
                            <img class="img-profile" src="">
                        </div>
                        <a href="#" class="btn btn-circle floating-button" data-toggle="modal"
                            data-target="#changePpModal"><i class="fas fa-fw fa-edit"></i></a>
                    </div> --}}
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Sukses!</strong> {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-user @error('title') is-invalid @enderror"
                                        name="title" id="exampleInputTitle" aria-describedby="titleHelp"
                                        placeholder="Judul Testimoni" value="{{ old('title') }}" required>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <textarea name="content" id="content"
                                        class="form-control form-control-user @error('content') is-invalid @enderror"
                                        cols="30" rows="3" placeholder="Isi Text Testimoni">{{ old('title') }}</textarea>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="link"
                                        id="exampleInputLink" aria-describedby="linkHelp" placeholder="Link Embed Youtube"
                                        value="">
                                    @error('link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    {{-- <label>Gambar Testimoni</label> --}}
                                    <div class="imagePreview">
                                        <input type="file" class="upload" name="testimonial_picture"
                                            onchange="preview(this)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer  text-center">
                        <button type="submit" class="btn btn-primary btn-user">
                            {{ __('Simpan') }}
                        </button>
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
