@extends('layouts.main')
@section('pageTitle', $title)
@section('title', $title)
@section('content')
    <style>
        iframe {
            height: 70vh;
        }

    </style>
    <div class="row justify-content-center">
        @if (Auth::user()->level >= $course->level_requirement)
            <div class="col-10">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col">
                                <h6 class="m-0 font-weight-bold text-primary">{{ $course->title }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! $course->link_embed !!}
                    </div>
                </div>
            </div>
        @else
            <div class="col-12">
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Halo {{ Auth::user()->name }}!</h4>
                    <p><strong>Level</strong> kamu tidak cukup untuk melanjutkan menonton pelatihan ini.</p>
                    <hr>
                    <p class="mb-0">Terus tingkatkan level kamu untuk mengakses
                        pelatihan exclusive seharga jutaan rupiah gratis!!!</p>
                </div>
            </div>
        @endif
        <div class="col-12 text-center mt-5">
            <a href="{{ url('course/' . $course->category_id) }}"><i class="fas fa-arrow-alt-circle-left"></i> kembali</a>
        </div>
    </div>


@endsection
