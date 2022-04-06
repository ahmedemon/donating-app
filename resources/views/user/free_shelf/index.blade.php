@extends('layouts.user.app', ['pageTitle'=>$pageTitle])
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/css/shelf.css') }}">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach ($donations as $item)
                @if ($item->user_id == Auth::user()->id)
                @else
                    <div class="col-md-3">
                        <div class="card rounded-0">
                            <div class="card-body p-0">
                                <div class="d-flex image">
                                    <img class="w-100" height="" src="{{ asset('storage/donation/' . $item->images) }}" alt="">
                                    <p class="bg-secondary lead my-0 point-tag rounded">Point: {{ $item->point }}</p>
                                </div>
                                <div class="card-footer p-2">
                                    <div class="h5 text-white text-center">
                                        <p class="lead my-0">Title: {{ $item->title }}</p>
                                        <a href="{{ route('my-order.buy.request', $item->id) }}" class="btn btn-xs btn-secondary rounded-0">Get Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            {{ $donations->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
