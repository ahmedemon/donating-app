@extends('layouts.frontend.app')
@push('css')
	<link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
@endpush
@section('content')
	<div class="container-fluid my-3">
		<div class="loop owl-carousel">
			@foreach($products as $product)
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
						        <img class="d-block" style="height: 280px !important; width: 300px !important;" src="{{ asset('storage/donation/'. $product->images) }}" alt="">
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
			@endforeach
		</div>
	</div>
    <div class="container-fluid bg-dark py-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="h4 font-weight-normal text-center">Top 10 Donator</div>
                    </div>
                    @if ($donators->count() == 0)
                        <div class="card-body d-flex justify-content-center align-items-center" style="height: 254px !important; user-select: none;">
                            <p class="lead">Top buyer is not available</p>
                        </div>
                    @else
                        <div class="card-body py-0" style="height: 254px !important; overflow-y: scroll;">
                            @foreach ($donators as $donator)
                                <div class="row {{ $loop->last ? 'border-bottom-0' : 'border-bottom' }} py-2 align-items-center">
                                    <div class="col-md-12 d-flex justify-content-between px-5" style="user-select: none;">
                                        <p class="my-0">{{ $donator->user->name . ' | Join ' . $donator->user->created_at->diffInDays() . ' days ago!' }}</p>
                                        <p class="my-0 bg-success text-white rounded-0 btn-sm">{{ $donator->user->donation->count(); }} Items</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-4 mt-3 mt-lg-0">
                <div class="card">
                    <div class="card-header">
                        <div class="h4 font-weight-normal text-center">Top 10 Buyer</div>
                    </div>
                    @if ($buyers->count() == 0)
                        <div class="card-body d-flex justify-content-center align-items-center" style="height: 254px !important; user-select: none;">
                            <p class="lead">Top buyer is not selected</p>
                        </div>
                    @else
                        <div class="card-body py-0" style="height: 254px !important; overflow-y: scroll;">
                            @foreach ($buyers as $buyer)
                                <div class="row {{ $loop->last ? 'border-bottom-0' : 'border-bottom' }} py-3 align-items-center">
                                    <div class="col-md-12 d-flex justify-content-between px-5" style="user-select: none;">
                                        <p class="my-0">{{ $buyer->user->name . ' | Join ' . $donator->user->created_at->diffInDays() . ' days ago!' }}</p>
                                        <p class="my-0 bg-success text-white rounded-0 btn-sm">{{ $buyer->user->donation->count(); }} Items</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
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
        items:2,
        loop:true,
        margin:10,
        responsive:{
            600:{
                items:7
            }
        }
    });
  </script>
@endpush
