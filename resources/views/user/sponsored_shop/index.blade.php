@extends('layouts.user.app', ['pageTitle'=>'Sponsors'])
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/css/shelf.css') }}">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach($sponsor_items as $item)
                <div class="col-md-3">
                    <div class="card rounded-0">
                        <div class="card-body p-0 justify-content-center">
                            <img class="w-100" height="300" src="{{ asset('storage/sponsor_item/' . $item->image) }}" alt="">
                            <div class="card-footer">
                                <div class="card-title text-white">
                                    {{ $item->title }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $sponsor_items->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
