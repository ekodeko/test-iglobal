@extends('layouts.main')
@section('pageTitle', $title)
@section('title', $title)
@section('content')
    <div class="row">
        @if (count($courses) > 0)
            @foreach ($courses as $course)
                {{-- @if (Auth::user()->level >= $course->level_requirement) --}}
                <div class="col-12 col-md-4">
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ url('course/' . $course->id . '/watch') }}">
                                        <h6 class="m-0 font-weight-bold text-primary">{{ $course->title }}</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! $course->link_embed !!}
                            @if (Auth::user()->level < $course->level_requirement)
                                <div class="lock-course-wrapper">
                                    <div class="lock-course">
                                        <div class="lock-course-lock"></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- @endif --}}
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Pelatihan tidak ditemukan!</h4>
                    <p>Belum ada pelatihan untuk kategori ini.</p>
                    <hr>
                    <p class="mb-0">Pelatihan masih dalam tahap pengunggahan, terus tingkatkan level kamu untuk mengakses
                        pelatihan exclusive seharga jutaan rupiah gratis!!!</p>
                </div>
            </div>
        @endif
        <div class="col-12 text-center mt-5">
            <a href="{{ url('course') }}"><i class="fas fa-arrow-alt-circle-left"></i> kembali</a>
        </div>
    </div>


@endsection
