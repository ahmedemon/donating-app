@extends('layouts.admin.app')
@section('content')
<div class="container">
    <div class="card text-white">
        <div class="card-header">Dashboard</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            {{ __('You are logged in!') }}
        </div>
    </div>
</div>
@endsection