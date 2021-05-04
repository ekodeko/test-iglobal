@extends('layouts.main')
@section('pageTitle', 'Kategori' . $title)
@section('title', 'Kategori ' . $title)
@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h6 class="m-0 font-weight-bold text-primary">Kategori {{ $title }}</h6>
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
                    <form class="user" method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="thumbnail_old" value="{{ $category->thumbnail }}">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror"
                                name="name" id="exampleInputPhone" aria-describedby="phoneHelp" placeholder="Nama Kategori"
                                value="{{ $category->name }}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Pilih Gambar Thumbnail</label>
                            @if (!empty($category->thumbnail))
                                <div class="imagePreview"
                                    style="background-image:url({{ asset('images/' . $category->thumbnail) }})">
                                    <input type="file" class="upload" name="thumbnail" onchange="preview(this)">
                                </div>
                            @else
                                <div class="imagePreview">
                                    <input type="file" class="upload" name="thumbnail" onchange="preview(this)">
                                </div>
                            @endif
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ url('category') }}" class=" btn btn-secondary btn-user mr-2">Kembali</a>
                            <button type="submit" class="btn btn-primary btn-user">
                                {{ __('Simpan') }}
                            </button>
                        </div>
                        <hr>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-8">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Pelatihan {{ $title }}</h6>
                        </div>
                        <div class="col">
                            <a href="#" class="btn btn-sm btn-primary btn-icon-split float-right" data-toggle="modal"
                                data-target="#addCourseModal">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Tambah Pelatihan</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($category->courses as $course)
                            <div class="col-12 col-md-6">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <div class="row">
                                            <div class="col-10">
                                                <span class="m-0 font-weight-bold text-primary">{{ $course->title }}
                                                </span>
                                                <a href="{{ url('course/' . $course->id . '/edit') }}"><i
                                                        class="fas fa-edit rotate-n-15"></i>
                                                </a>
                                            </div>
                                            <div class="col-2">
                                                <a href="#" class="badge badge-danger" data-toggle="modal"
                                                    data-target="#deleteCourseModal"
                                                    onclick="confirm_delete_modal('{{ url('course/' . $course->id) }}')">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        {!! $course->link_embed !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal-->
    <div class="modal fade" id="deleteCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="" method="post" id="form-delete">
                @csrf
                @method('delete')
                <input type="hidden" name="course_id" id="course_id" value="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pelatihan ini akan dihapus?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                        <button class="btn btn-primary" type="submit" id="delete_url">Ya, Hapus!</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- modal add --}}
    <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ url('course') }}" method="POST" class="user">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePpModalLabel">Pelatihan Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                                    <input type="text"
                                        class="form-control form-control-user @error('title') is-invalid @enderror"
                                        name="title" id="exampleInputPhone" aria-describedby="phoneHelp"
                                        placeholder="Judul Pelatihan" value="{{ old('title') }}">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <select name="level_requirement" id="level_requirement" class="form-control">
                                        <option value="0" selected>Silver</option>
                                        <option value="1">Gold</option>
                                        <option value="2">Platinum</option>
                                        <option value="3">Diamond</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <textarea name="link_embed" id="link_embed" class="form-control" cols="30" rows="3"
                                        @error('link_embed') is-invalid @enderror
                                        placeholder="Embed Link Youtube">{{ old('link_embed') }}</textarea>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function confirm_delete_modal(url) {
            console.log(url)
            $('#deleteCourseModal').modal('show', {
                keyboard: false
            });
            // $("#delete_url").attr('href', url);
            $("#form-delete").attr('action', url);
            // $("#course_id").val(url);
            $("#delete_url").focus();
        }

    </script>
@endpush
