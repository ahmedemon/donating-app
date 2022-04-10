@extends('layouts.frontend.app', ['pageTitle' => 'About Us'])
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
        <div class="row justify-content-center align-items-center my-lg-5 my-2 py-lg-5 py-0">
            <div class="col-md-5">
                <img src="{{ asset('frontend/img/about.png') }}" alt="">
            </div>
            <div class="col-md-5">
                <h1 class="text-lg-left text-center">About Us</h1>
                <p class="custom-font text-justify">
                    We are a group of environmentalists with a clear goal: To protect the environment.
                    People nowadays are not eager to contribute to Reusing and Donating their unused and
                    neglected items because of one simple reason: they are not getting anything back.
                    This is why we have created this site, where people like you can donate your unused items to people who really need it,
                    while earning something back.
                </p>
                <p class="custom-font text-justify">
                    What do you earn? You earn points. With these points, you can buy your item of choice from the website.
                    This way, you can save the environment and benefit from reusing.
                </p>
                <p class="custom-font text-justify">Donate for reuse; help change our environment for the better.</p>
                <p class="custom-font text-justify">For a tutorial on how to buy or sell, check the <a href="{{ route('how') }}" class="">How it works</a> page.</p>
            </div>
        </div>
    </div>
@endsection
