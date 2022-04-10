@extends('layouts.frontend.app', ['pageTitle'=>'How It Works?'])
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital@1&display=swap" rel="stylesheet">
@endpush
<style>
    h1 {
        font-size: 80px !important;
        font-weight: 0 !important;
        font-family: 'Dancing Script', cursive;
    }

    p.custom-font {
        font-size: 20px;
        font-family: 'Lato', sans-serif;
    }

</style>
@section('content')
    <div class="container-fluid my-3">
        <div class="row justify-content-center align-items-center my-2">
            <div class="col-md-5">
                <img src="{{ asset('frontend/img/about1.png') }}" alt="">
            </div>
            <div class="col-md-5">
                <h1 class="text-lg-left text-center">How It Works?</h1>
                <p class="custom-font text-justify">
                    <u>How To Donate:</u>
                    First, create your very own unique account by registering. Then, log into your account.
                    Then, press on the donate option in the menu. Fill in the details of the item you are donating.
                    Add a description and set how many points you are willing to donate it for. Add clear pictures of your product.
                    After you are done, wait for an admin to verify your donation. After verification, your item will be up for donation.
                    Once someone is interested in your item, they will message you through the website.
                    Then, they can buy the product using their points, which will be transferred to you in a while.
                </p>
                <p class="custom-font text-justify">
                    <u>How To Order:</u>
                    First, browse and select the product you are interested in. Then, Click on the product. Click on “buy” option.
                    Wait for your purchase to get verified by an admin. Your points will be transferred to the seller,
                    and the product will be delivered to you in a short time. Enjoy your reused product!
                </p>
            </div>
        </div>
    </div>
@endsection
