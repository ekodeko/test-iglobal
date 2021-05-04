@extends('layouts.main')
@section('pageTitle', $title)
@section('title', $title)
@section('content')
    <div class="row">
        @foreach ($categories as $category)
            <div class="col-12 col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col">
                                <a href="{{ url('course/' . $category->id) }}">
                                    <h6 class="m-0 font-weight-bold text-primary">{{ $category->name }}</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('course/' . $category->id) }}">
                            <div class="card-image-square">
                                <img class="card-img" src="{{ asset("images/$category->thumbnail") }}">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

    @endsection
