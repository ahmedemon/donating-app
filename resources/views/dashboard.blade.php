@extends('layouts.frontend.app')
@push('css')
	<link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
@endpush
@section('content')
	<div class="container-fluid">
		<div class="loop owl-carousel">
			@foreach($products as $product)
				<div class="item card rounded-0">
					<a class="text-decoration-none" href="">
						<div class="p-0 border border-danger rounded-0 bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
						    <div class="">
						        <img class="d-block" height="280" src="{{ asset('storage/donation/'. $product->images) }}" alt="">
						    </div>
						    <div class="bbb_viewed_content text-center py-2 mt-0">
						        <div class="bbb_viewed_price">Points to get : {{ $product->point }}</div>
						        <p class="small my-0 text-uppercase text-dark">{{ $product->title }}</p>
						        <div class="bbb_viewed_name"></div>
							</div>
						</div>
					</a>
				</div>
			@endforeach
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