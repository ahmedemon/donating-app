@extends('layouts.user.app', ['pageTitle'=>$pageTitle])
<link rel="stylesheet" href="{{ asset('backend/css/profile-cropper.css') }}">
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4 class="card-title">Receiver Profile</h4>
                        <a href="{{ url()->previous() }}" class="btn btn-xs btn-secondary">Go Back</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 px-0 mb-3">
                                <div class="container d-flex justify-content-center align-items-center mt-0">
                                    <div class="avatar-upload">
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image: url('{{ $buyer->image ? asset('storage/user/' . $buyer->image) : asset('frontend/img/avatar.svg') }}')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="d-flex">
                                        <h3>{{ $buyer->name }}</h3>
                                        <small class="small">
                                            @if ($buyer->is_active == 1)
                                                <i class="fas fa-circle text-success"></i>
                                            @else
                                                <i class="fas fa-circle text-warning"></i>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <div class="d-flex justify-content-center">
                                            <ul>
                                                <li>
                                                    <p class="my-0 lead text-white">
                                                        <i class="fas fa-phone-square-alt text-success"></i>
                                                        <span class="text-success">Cell No:</span> 0{{ $buyer->phone }}
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="my-0 lead text-white">
                                                        <i class="fas fa-map text-info"></i>
                                                        <span class="text-info">Area:</span> {{ $buyer->address }}
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
