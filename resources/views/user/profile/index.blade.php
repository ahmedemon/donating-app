@extends('layouts.user.app')
@section('content')
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-outline-info" href="{{ route('profile.edit', Auth::user()->id) }}">Edit</a>
                        <div class="row justify-content-center">
                            <div class="col-12 d-flex justify-content-center align-items-center px-0 mb-3">
                                {{-- {{ Auth::user()->image }} --}}
                                @if (Auth::user()->image == !null)
                                    <img class="border rounded-circle" src="{{ asset('storage/user/' . Auth::user()->image) }}" alt="" height="150" width="150">
                                @else
                                    <img src="{{ asset('frontend/img/avatar.svg') }}" alt="" class="" height="150" width="150">
                                @endif
                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <form action="{{ route('profile.image', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <input class="border" type="file" name="image">
                                        <button type="submit" class="btn-sm btn btn-xs sharp btn-primary">
                                            <i class="fas fa-arrow-circle-up"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-10 col-lg-8 d-flex align-items-center">
                                <table class="w-100 table">
                                    <tr>
                                        <td colspan="2">
                                            <div class="d-flex justify-content-center">
                                                <div class="d-flex">
                                                    <h2>{{ Auth::user()->name }}</h2>
                                                    <small class="small">
                                                        @if (Auth::user()->is_active == 1)
                                                            <i class="fas fa-circle text-success"></i>
                                                        @else
                                                            <i class="fas fa-circle text-warning"></i>
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <ul>
                                                <li>
                                                    <p class="my-0">
                                                        <i class="fas fa-user text-secondary"></i>
                                                        {{ Auth::user()->username }}
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="my-0">
                                                        <i class="fas fa-phone-square-alt text-success"></i>
                                                        0{{ Auth::user()->phone }}
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="my-0">
                                                        <i class="fas fa-envelope-open text-danger"></i>
                                                        {{ Auth::user()->email }}
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="my-0">
                                                        <i class="fas fa-map text-secondary"></i>
                                                        {{ Auth::user()->address }}
                                                    </p>
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>
                                                    <p class="my-0">
                                                        <i class="fa fa-star text-warning"></i>
                                                        Rank : {{ Auth::user()->position ?? 'Not Set' }}
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="my-0">
                                                        <i class="fas fa-check-circle text-warning"></i>
                                                        Joining Date : {{ date('Y-m-d', strtotime(Auth::user()->created_at)) }}
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="my-0">
                                                        <i class="fas fa-check-circle text-warning"></i>
                                                        @php
                                                            $joining_date = Carbon\Carbon::parse(Auth::user()->created_at);
                                                            // $now = Carbon\Carbon::now();
                                                        @endphp
                                                        Joined {{ $joining_date ? $joining_date->diffInDays() : '' }} days ago
                                                    </p>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="my-0">
                                                <i class="fas fa-wallet text-info"></i>
                                                Current Balance: {{ $wallet['current_balance'] }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="my-0">
                                                <i class="fas fa-wallet text-info"></i>
                                                Pucrhase Point : {{ $wallet['total_purchased_balance'] }}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="my-0">
                                                <i class="fas fa-wallet text-info"></i>
                                                Total Sale Balance: {{ $wallet['total_sale_balance'] }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="my-0">
                                                <i class="fas fa-wallet text-info"></i>
                                                Total Sale : {{ $wallet['total_purchased'] }}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        {{-- <td>
                                            <p class="my-0">
                                                <i class="fas fa-wallet text-info"></i>
                                                Total Purchased: {{ $wallet['total_purchased'] }}
                                            </p>
                                        </td> --}}
                                        {{-- <td>
                                            <p class="my-0">
                                                <i class="fas fa-wallet text-info"></i>
                                                Total Sale : {{ $wallet['total_sale'] }}
                                            </p>
                                        </td> --}}
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-10 offset-lg-1 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="fs-20">Description</h4>
                                    <p class="font-w600 mb-2 d-flex"><span class="custom-label-2">Username : </span><span class="font-w400">{{ Auth::user()->username }}</span></p>
                                    <p class="font-w600 mb-2 d-flex"><span class="custom-label-2">Full Name : </span><span class="font-w400">{{ Auth::user()->name }}</span></p>
                                    <p class="font-w600 mb-2 d-flex"><span class="custom-label-2">Phone : </span><span class="font-w400">{{ Auth::user()->phone }}</span></p>
                                    <p class="font-w600 mb-2 d-flex"><span class="custom-label-2">E-mail : </span><span class="font-w400">{{ Auth::user()->email }}</span></p>
                                    <p class="font-w600 mb-2 d-flex"><span class="custom-label-2">Present Address : </span><span class="font-w400">{{ Auth::user()->present_address }}</span></p>
                                    <p class="font-w600 mb-2 d-flex"><span class="custom-label-2">Permanent Address : </span><span class="font-w400">{{ Auth::user()->permanent_address }}</span></p>
                                    <p class="font-w600 mb-2 d-flex"><span class="custom-label-2">Status : </span><span class="font-w400">{{ Auth::user()->status ? 'Active' : 'Inactive' }}</span></p>
                                </div>
                                <div class="col-lg-6">
                                    <h4 class="fs-20">Wallets</h4>
                                    <p class="font-w600 mb-2 d-flex justify-content-between border px-3"><span class="custom-label-2">Daily Income : </span><span class="font-w400">$ {{ $wallet['daily_income'] }}</span></p>
                                    <p class="font-w600 mb-2 d-flex justify-content-between border px-3"><span class="custom-label-2">Current Balance : </span><span class="font-w400">$ {{ $wallet['current_balance'] }}</span></p>
                                    <p class="font-w600 mb-2 d-flex justify-content-between border px-3"><span class="custom-label-2">RID Balance : </span><span class="font-w400">$ {{ $wallet['rid_balance'] }}</span></p>
                                    <p class="font-w600 mb-2 d-flex justify-content-between border px-3"><span class="custom-label-2">Referral Balance : </span><span class="font-w400">$ {{ $wallet['referral_balance'] }}</span></p>
                                    <p class="font-w600 mb-2 d-flex justify-content-between border px-3"><span class="custom-label-2">Generation Balance : </span><span class="font-w400">$ {{ $wallet['generation_balance'] }}</span></p>
                                    <p class="font-w600 mb-2 d-flex justify-content-between border px-3"><span class="custom-label-2">Daily Earning Balance : </span><span class="font-w400">$ {{ $wallet['daily_earning_balance'] }}</span></p>
                                    <p class="font-w600 mb-2 d-flex justify-content-between border px-3"><span class="custom-label-2">Forex E-Coin : </span><span class="font-w400">$ {{ $wallet['forex_balance'] }}</span></p>
                                    <p class="font-w600 mb-2 d-flex justify-content-between border px-3"><span class="custom-label-2">GM Bonus : </span><span class="font-w400">$ {{ $wallet['cm_bonus'] }}</span></p>
                                    <p class="font-w600 mb-2 d-flex justify-content-between border px-3"><span class="custom-label-2">LRI Bonus : </span><span class="font-w400">$ {{ $wallet['rc_bonus'] }}</span></p>
                                    <p class="font-w600 mb-2 d-flex justify-content-between border px-3"><span class="custom-label-2">Investment : </span><span class="font-w400">$ {{ $wallet['investement'] }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
