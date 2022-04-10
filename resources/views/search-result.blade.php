@extends('layouts.frontend.app', ['pageTitle'=>'Search Result'])
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
@endpush
<style>
    h1 {
        font-size: 80px !important;
        font-weight: 0 !important;
        font-family: 'Dancing Script', cursive;
    }

</style>
@section('content')
    <div class="container-fluid my-3">
        <h1 class="text-center border-bottom">Search Results</h1>
        <p class="lead">- Found {{ $products->count() }} result of "{{ request()->search }}"</p>
        <div class="row">
            @if ($products->count() == 0)
                <h4 class="text-center">No result found</h4>
            @else
                @foreach ($products as $product)
                    <div class="col-lg-2 col-md-4 col-6 mb-lg-auto mb-4">
                        <div class="item card rounded-0">
                            @auth
                                @if ($product->user_id == Auth::user()->id)
                                    <a href="{{ route('donation.approved', $product->id) }}">
                                    @else
                                        <a href="{{ route('category.index', $product->category_id) }}">
                                @endif
                            @else
                                <a href="{{ route('category.index', $product->category_id) }}">
                                @endauth
                                <div class="p-0 border border-danger rounded-0 bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="">
                                        <img class="d-block" style="height: 280px !important; width: 300px !important;" src="{{ asset('storage/donation/' . $product->images) }}" alt="">
                                    </div>
                                    <div class="bbb_viewed_content text-center py-2 mt-0">
                                        <div class="bbb_viewed_price">Points to get : {{ $product->point }}</div>
                                        <p class="small my-0 text-uppercase text-dark">{{ $product->title }}</p>
                                        @auth
                                            @if ($product->user_id == Auth::user()->id)
                                                <a href="{{ route('donation.approved', $product->id) }}" class="btn btn-sm rounded-0 btn-danger">View</a>
                                            @else
                                                <a href="{{ route('my-order.buy.request', $product->id) }}" class="btn btn-sm rounded-0 btn-danger">Get Now</a>
                                            @endif
                                        @else
                                            <a href="{{ route('my-order.buy.request', $product->id) }}" class="btn btn-sm rounded-0 btn-danger">Get Now</a>
                                        @endauth
                                        <div class="bbb_viewed_name"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="container-fluid bg-white py-5">
        <div class="ad-loop owl-carousel">
            <div class="item card rounded-0">
                <img src="{{ asset('frontend/img/company-logo.png') }}" alt="" class="w-100">
            </div>
            <div class="item card rounded-0">
                <img src="{{ asset('frontend/img/company-logo.png') }}" alt="" class="w-100">
            </div>
            <div class="item card rounded-0">
                <img src="{{ asset('frontend/img/company-logo.png') }}" alt="" class="w-100">
            </div>
            <div class="item card rounded-0">
                <img src="{{ asset('frontend/img/company-logo.png') }}" alt="" class="w-100">
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script>
        $('.loop').owlCarousel({
            dots: false,
            autoplay: true,
            mergeFit: true,
            startPosition: 1,
            smartSpeed: 250,
            center: true,
            items: 2,
            loop: true,
            margin: 10,
            responsive: {
                600: {
                    items: 7
                }
            }
        });
        $('.ad-loop').owlCarousel({
            dots: false,
            autoplay: true,
            mergeFit: true,
            startPosition: 1,
            smartSpeed: 250,
            center: true,
            items: 2,
            loop: true,
            margin: 10,
            responsive: {
                600: {
                    items: 7
                }
            }
        });
    </script>
@endpush
