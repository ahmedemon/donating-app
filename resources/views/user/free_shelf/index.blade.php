@extends('layouts.user.app', ['pageTitle'=>$pageTitle])
@push('css')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach($donations as $item)
                <div class="col-md-3">
                    <div class="card rounded-0">
                        <div class="card-body p-0 justify-content-center">
                            <img class="w-100" height="300" src="{{ asset('storage/donation/' . $item->images) }}" alt="">
                            <div class="card-footer">
                                <div class="h5 text-white">
                                    {{ $item->title }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection