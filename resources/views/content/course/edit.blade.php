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
                    <form class="user" method="POST" action="{{ url('course/' . $course->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user @error('title') is-invalid @enderror"
                                name="title" id="exampleInputPhone" aria-describedby="phoneHelp" placeholder="Nama anda..."
                                value="{{ $course->title }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select name="level_requirement" id="level_requirement" class="form-control">
                                <option value="0" {{ $course->level_requirement == 0 ? 'selected' : '' }}>Silver</option>
                                <option value="1" {{ $course->level_requirement == 1 ? 'selected' : '' }}>Gold</option>
                                <option value="2" {{ $course->level_requirement == 2 ? 'selected' : '' }}>Platinum
                                </option>
                                <option value="3" {{ $course->level_requirement == 3 ? 'selected' : '' }}>Diamond</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control form-control-user @error('link_embed') is-invalid @enderror"
                                name="link_embed" id="exampleInputPasswordConfirmation"
                                aria-describedby="passwordConfirmationHelp" placeholder="Link embed Youtube" value=""
                                rows="3">{{ $course->link_embed }}</textarea>
                            @error('link_embed')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            {{ __('Simpan') }}
                        </button>
                        <hr>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
