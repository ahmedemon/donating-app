@extends('layouts.user.app', ['pageTitle'=>'Sponsors'])
@push('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/css/shelf.css') }}">
@endpush
<style>
    h1 {
        font-size: 80px !important;
        font-weight: 0 !important;
        font-family: 'Dancing Script', cursive;
    }

</style>
@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach ($sponsor_items as $item)
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="card rounded-0">
                        <div class="card-body p-0">
                            <div class="d-flex image">
                                <img class="w-100" height="" src="{{ asset('storage/sponsor_item/' . $item->image) }}" alt="">
                                <p class="bg-secondary lead my-0 point-tag rounded">Price: {{ $item->price }}</p>
                            </div>
                            <div class="card-footer p-2">
                                <div class="h5 text-white text-center">
                                    <p class="lead my-0">Title: {{ $item->title }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $sponsor_items->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
