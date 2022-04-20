@extends('layouts.user.app', ['pageTitle'=>'All Notifications'])
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

    .bg {
        background-color: #6e6e6e33 !important;
    }

</style>
@section('content')
    <div class="container-fluid py-0">
        <h1 class="text-center border-bottom">All Notifications</h1>
        <p class="lead">Total <span class="badge light text-white bg-primary rounded-circle">{{ $notifications->count() }}</span> notifications</p>
        <div class="row">
            @foreach ($notifications as $item)
                <a href="{{ route('buyer-request.view.request', $item->id) }}" class="">
                    <li class="{{ $item->seen == 0 ? 'bg' : '' }}">
                        <div class="timeline-panel mb-2 border-bottom d-flex">
                            <div class="media me-2 rounded-0">
                                <img alt="image" width="50" src="{{ asset('storage/donation/' . $item->donation->images) }}">
                            </div>
                            <div class="media-body">
                                <h6 class="mb-1" style="color: #14c8ff !important;">{{ $item->user->name }} <small style="color: white !important;">requested for <b>({{ $item->donation->title }})</b>.</small></h6>
                                <small class="d-block">{{ date('M d, Y, h:i a', strtotime($item->created_at)) }}</small>
                            </div>
                        </div>
                    </li>
                </a>
            @endforeach

            {{ $notifications->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
