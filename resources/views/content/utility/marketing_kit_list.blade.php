@extends('layouts.main')
@section('pageTitle', $title)
@section('title', $title)
@section('content')
    <a href="#" class="btn btn-sm btn-primary btn-icon-split mb-2" data-toggle="modal" data-target="#addCategoryModal">
        <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
        <span class="text">Tambah</span>
    </a>
    <div class="row">
        @foreach ($marketing_kits as $marketing_kit)
            <div class="col-12 col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col">
                                <a href="{{ url('utility/reseller_marketing_kit/items/' . $marketing_kit->id) }}">
                                    <h6 class="m-0 font-weight-bold text-primary">{{ $marketing_kit->title }}</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-image-square">
                        <img class="card-img" src="{{ asset('images/thumb/' . $marketing_kit->thumbnail) }}">
                    </div>
                    @if (!$marketing_kit->is_many_file)
                        <form class="user" method="POST" action="reseller_marketing_kit/download_foto_produk">
                            @csrf
                            <div class="card-footer">
                                <div class="row justify-content-end align-items-center">
                                    <div class="col">Klik tombol untuk mengunduh file</div>
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-primary btn-user btn-block"><i
                                                class="fas fa-download" title="Download Semua Foto Product"></i>
                                            Download</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="card-footer"></div>
                    @endif
                </div>
            </div>
        @endforeach

    </div>

@endsection
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="changePpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST" class="user" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePpModalLabel">Tambah Reseller Marketing Kit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="form-group">
                                <input type="text"
                                    class="form-control form-control-user @error('title') is-invalid @enderror"
                                    name="title" id="exampleInputPhone" aria-describedby="phoneHelp"
                                    placeholder="Judul Marketing Kit" value="{{ old('title') }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_many_file" id="is_many_file_1"
                                        value="1" checked>
                                    <label class="form-check-label" for="is_many_file_1">
                                        Banyak File
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_many_file" id="is_many_file_2"
                                        value="0">
                                    <label class="form-check-label" for="is_many_file_2">
                                        1 File
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Pilih File</label>
                                <div class="imagePreview">
                                    <input type="file" class="upload" name="image" onchange="preview(this)">
                                </div>
                            </div>
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
        function confirm_delete_modal(url) {
            console.log(url)
            $('#deleteCourseModal').modal('show', {
                keyboard: false
            });
            $("#form-delete").attr('action', url);
            $("#delete_url").focus();
        }

    </script>
@endpush
