@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
@endpush
@section('content')
    <div class="container-fluid mt-3">
        <div class="owl-carousel owl-theme">
            @foreach ($products as $product)
                <div class="item card rounded-0">
                    @auth
                        @if ($product->user_id == Auth::user()->id)
                            <a href="{{ route('donation.pending', $product->id) }}">
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
                                        <a href="{{ route('donation.pending', $product->id) }}" class="btn btn-sm rounded-0 btn-danger">View</a>
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
            @endforeach
        </div>
    </div>
    <div class="container-fluid bg-dark py-lg-5 py-4">
        <div class="row justify-content-center">
        </div>
        <div class="row justify-content-center px-3">
            <div class="col-md-2 mb-lg-auto mb-3">
                <a href="" class="" target="_blank">
                    <img class="" style="height: auto; width: 100%;" src="{{ asset('frontend/img/ad1.jpg') }}" alt="">
                </a>
            </div>
            <div class="col-md-8">
                <div class="col-md-12 mb-lg-4 mb-5 px-0">
                    <a href="" class="" target="_blank">
                        <img class="rounded-lg" style="height: 200px; width: 100%;" src="{{ asset('frontend/img/ad.jpg') }}" alt="">
                    </a>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="h4 font-weight-normal text-center">Top 10 Donator</div>
                            </div>
                            @if ($donators->count() == 0)
                                <div class="card-body d-flex justify-content-center align-items-center" style="height: 254px !important; ">
                                    <p class="lead">Top donator is not available</p>
                                </div>
                            @else
                                <div class="card-body py-0" style="height: 254px !important; overflow-y: scroll;">
                                    @foreach ($donators as $donator)
                                        @if ($total_donation >= 100)
                                            <div class="row {{ $loop->last ? 'border-bottom-0' : 'border-bottom' }} py-2 align-items-center">
                                                <div class="col-md-12 d-flex justify-content-between px-5" style="">
                                                    <p class="my-0">{{ $donator->user->name . ' | Join ' . $donator->user->created_at->diffInDays() . ' days ago!' }}</p>
                                                    <p class="my-0 bg-success text-white rounded-0 btn-sm">{{ $donator->user->donation->count() }} Items</p>
                                                </div>
                                            </div>
                                        @else
                                            <div class="card-body d-flex justify-content-center align-items-center" style="height: 254px !important; ">
                                                <p class="lead">Top Donator is not available</p>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mt-3 mt-lg-0">
                        <div class="card">
                            <div class="card-header">
                                <div class="h4 font-weight-normal text-center">Top 10 Receiver</div>
                            </div>
                            @if ($buyers->count() == 0)
                                <div class="card-body d-flex justify-content-center align-items-center" style="height: 254px !important; ">
                                    <p class="lead">Top receiver is not selected</p>
                                </div>
                            @else
                                <div class="card-body py-0" style="height: 254px !important; overflow-y: scroll;">
                                    @foreach ($buyers as $buyer)
                                        @if ($total_purchase >= 100)
                                            <div class="row {{ $loop->last ? 'border-bottom-0' : 'border-bottom' }} py-3 align-items-center">
                                                <div class="col-md-12 d-flex justify-content-between px-5" style="">
                                                    <p class="my-0">{{ $buyer->user->name . ' | Join ' . $donator->user->created_at->diffInDays() . ' days ago!' }}</p>
                                                    <p class="my-0 bg-success text-white rounded-0 btn-sm">{{ $buyer->user->donation->count() }} Items</p>
                                                </div>
                                            </div>
                                        @else
                                            <div class="card-body d-flex justify-content-center align-items-center" style="height: 254px !important; ">
                                                <p class="lead">Top Receiver is not selected</p>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mt-lg-0 mt-5">
                <a href="" class="" target="_blank">
                    <img class="" style="height: auto; width: 100%;" src="{{ asset('frontend/img/ad1.jpg') }}" alt="">
                </a>
            </div>
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
        $('.owl-carousel').owlCarousel({
            dots: true,
            nav: true,
            autoplay: true,
            autoplayHoverPause: true,
            mergeFit: true,
            startPosition: 1,
            smartSpeed: 250,
            center: true,
            items: 2,
            loop: true,
            margin: 10,
            responsive: {
                1500: {
                    items: 7
                },
                1400: {
                    items: 7
                },
                1300: {
                    items: 5
                },
                1200: {
                    items: 5
                },
                1100: {
                    items: 4
                },
                1000: {
                    items: 4
                },
                900: {
                    items: 3
                },
                800: {
                    items: 3
                },
                700: {
                    items: 3
                },
                600: {
                    items: 2
                },
                450: {
                    items: 2
                },
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
                1500: {
                    items: 7
                },
                1400: {
                    items: 7
                },
                1300: {
                    items: 5
                },
                1200: {
                    items: 5
                },
                1100: {
                    items: 4
                },
                1000: {
                    items: 4
                },
                900: {
                    items: 3
                },
                800: {
                    items: 3
                },
                700: {
                    items: 3
                },
                600: {
                    items: 2
                },
                450: {
                    items: 2
                },
            }
        });
    </script>
@endpush
