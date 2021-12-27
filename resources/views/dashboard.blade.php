@extends('layouts.partials.frontend.app')
@push('css')
	<link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
@endpush
@section('content')
	@include('layouts/partials/animated_perticles')
	<div class="container-fluid">
		<div class="loop owl-carousel">
			<div class="item card rounded-0">
				<a class="text-decoration-none" href="">
					<div class="p-0 border border-danger rounded-0 bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
					    <div class="">
					        <img class="d-block" height="280" src="http://localhost/multi-auth/public/storage/uploads/1/DonatedProducts/non-asperiores-non-s-2021-12-23.jpg" alt="">
					    </div>
					    <div class="bbb_viewed_content text-center py-2 mt-0">
					        <div class="bbb_viewed_price">Points to get : 45</div>
					        <p class="small my-0 text-uppercase text-dark">Non asperiores non s</p>
					        <div class="bbb_viewed_name"></div>
						</div>
					</div>
				</a>
			</div>
			<div class="item card rounded-0">
				<a class="text-decoration-none" href="">
					<div class="p-0 border border-danger rounded-0 bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
					    <div class="">
					        <img class="d-block" height="280" src="http://localhost/multi-auth/public/storage/uploads/1/DonatedProducts/non-asperiores-non-s-2021-12-23.jpg" alt="">
					    </div>
					    <div class="bbb_viewed_content text-center py-2 mt-0">
					        <div class="bbb_viewed_price">Points to get : 45</div>
					        <p class="small my-0 text-uppercase text-dark">Non asperiores non s</p>
					        <div class="bbb_viewed_name"></div>
						</div>
					</div>
				</a>
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