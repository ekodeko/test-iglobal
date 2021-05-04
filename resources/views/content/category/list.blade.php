@extends('layouts.main')
@section('pageTitle', $title)
@section('title', $title)
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $title }} <a href="#" class="btn btn-primary"
                            data-toggle="modal" data-target="#addCategoryModal"><i class="fas fa-plus"></i> Add Category</a>
                    </h6>
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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ url('category/' . $category->id) }}">{{ $category->name }}</a></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-danger btn-icon-split " data-toggle="modal"
                                                    data-target="#deleteCourseModal"
                                                    onclick="confirm_delete_modal('{{ url('category/' . $category->id) }}')"><span class="icon text-white-50">
                                                        <i class="fas fa-plus"></i>
                                                    </span>
                                                    <span class="text">Hapus</span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
@endsection
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="changePpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post" class="user" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePpModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="text"
                                    class="form-control form-control-user @error('name') is-invalid @enderror"
                                    name="name" id="exampleInputPhone" aria-describedby="phoneHelp"
                                    placeholder="Nama Kategori" value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Pilih Gambar Thumbnail</label>
                                <div class="imagePreview">
                                    <input type="file" class="upload" name="thumbnail" onchange="preview(this)">
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
