@extends('layouts.user.app', ['pageTitle'=>'User Dashboard'])
@section('content')
    <div class="card bg-dark text-white">
        <div class="card-header bg-dark">Dashboard</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            {{ __('You are logged in!') }}
        </div>
    </div>
@endsection