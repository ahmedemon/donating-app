@extends('layouts.user.app', ['pageTitle'=>$pageTitle])
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/css/shelf.css') }}">
    <style>
        .hover-bg:hover{
            background-color: #167069 !important;
            border-color: #c0c0c0 !important;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <p class="card-title text-white">{{ $pageTitle }}</p>
            </div>
            <div class="card-body pb-0">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-md-2">
                            <a href="{{ route('category.index', $category->id) }}" class="">
                                <div class="card border bg-secondary hover-bg">
                                    <div class="card-body text-center">{{ $category->name }}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
