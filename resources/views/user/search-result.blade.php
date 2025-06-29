@extends('layouts.user.app', ['pageTitle'=>'Search Result'])
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
    <div class="container-fluid py-0">
        <h1 class="text-center border-bottom">Search Results</h1>
        <p class="lead">- Found {{ $products->count() }} result of "{{ request()->search }}"</p>
        <div class="row">
            @if ($products->count() == 0)
                <h4 class="text-center">No Result Found</h4>
            @else
                @foreach ($products as $item)
                    @if ($item->user_id == Auth::user()->id)
                    @else
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="card rounded-0">
                                <div class="card-body p-0">
                                    <div class="d-flex image">
                                        <img class="w-100" height="" src="{{ asset('storage/donation/' . $item->images) }}" alt="">
                                        <p class="bg-danger lead my-0 point-tag rounded">Point: {{ $item->point }}</p>
                                    </div>
                                    <div class="card-footer p-2">
                                        <div class="h5 text-white text-center">
                                            <p class="lead my-0">Title: {{ $item->title }}</p>
                                            <a href="{{ route('my-order.buy.request', $item->id) }}" class="btn btn-xs btn-danger rounded-0">Get Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
