@extends('layouts.user.app')

@section('content')
    <div class="container-fluid">
        <div class="col-xl-12">
            <div class="row">
                @foreach ($wallet as $key => $balance)
                    <div class="col-sm-4 col-md-4 col-6 col-lg-3 border-bottom-0">
                        <div class="card">
                            <div class="card-body">
                                <div class="job-icon" style="position: relative;">
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-lg-8 col-md-6 small-device text-center">
                                            <div>
                                                <div class="d-flex align-items-center justify-content-center mb-1">
                                                    @if (intval(str_replace(',', '', $balance)) > 9999)
                                                        <marquee scrollamount="3">
                                                            <h2 class="mb-0">{{ str_replace('.00', '', $balance) }}
                                                                <i class="fas fa-circle" style="font-size: 8px;"></i>
                                                            </h2>
                                                        </marquee>
                                                    @else
                                                        <h2 class="mb-0">{{ str_replace('.00', '', $balance) }}
                                                            <i class="fas fa-circle" style="font-size: 8px;"></i>
                                                        </h2>
                                                    @endif
                                                </div>
                                                <span class="fs-14 d-block mb-2">{{ $wallet_name[$key] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection