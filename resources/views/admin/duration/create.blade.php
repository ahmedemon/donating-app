@extends('layouts.admin.app', ['pageTitle'=>'Add Category'])
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $headerTitle }}</h4>
                        <a href="javascript:void();" class="btn btn-sm btn-secondary">Go Back</a>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        @endif
                        <div class="basic-form">
                            <form action="{{ route('admin.duration.store') }}" method="POST" class="form-valide-with-icon needs-validation">
                                @csrf
                                <div class="mb-3 row">
                                    <div class="mb-3 col-md-12">
                                        <label class="text-label form-label" for="duration">Duration</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-pen-alt"></i> </span>
                                            <input type="number" name="duration" class="form-control" id="duration" value="{{ old('duration') }}" placeholder="Enter duration here.." required>
                                            @error('duration')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="text-label form-label" for="type">Select Duration Type</label> <span class="small text-danger">*</span>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fas fa-layer-group"></i> </span>
                                            <select class="input-group-text form-control" style="text-align: left" name="type" required id="type">
                                                <option value="Days">Days</option>
                                                <option value="Year">Year</option>
                                                <option value="Months">Months</option>
                                            </select>
                                        </div>
                                        @error('type')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn me-2 btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
