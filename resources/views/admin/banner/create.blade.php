@extends('layouts.admin.app', ['pageTitle'=>'Add Category'])
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
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
                            <form action="{{ route('admin.banner.store') }}" method="POST" class="form-valide-with-icon needs-validation" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="created_by">
                                <div class="mb-3 row">
                                    <div class="mb-3 col-md-6">
                                        <label class="text-label form-label" for="validationtitle">Title</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-pen-alt"></i> </span>
                                            <input type="text" name="title" class="form-control" id="validationtitle" value="{{ old('title') }}" placeholder="Enter title here.." required>
                                            @error('title')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="text-label form-label" for="urlvalidation">URL</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-pen-alt"></i> </span>
                                            <input type="text" name="url" class="form-control" id="urlvalidation" value="{{ old('url') }}" placeholder="Enter url here.." required>
                                            @error('url')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="text-label form-label" for="position">Select Banner Position</label> <span class="small text-danger">*</span>
                                        <div class="input-group">
                                            <select class="input-group-text form-control" style="text-align: left" name="position" required id="position">
                                                <option value="left">Left</option>
                                                <option value="middle">Center</option>
                                                <option value="right">Right</option>
                                            </select>
                                        </div>
                                        @error('position')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="text-label form-label" for="validationimage">Image</label>
                                        <div class="input-group">
                                            <input type="file" name="image" class="" id="validationimage" value="{{ old('image') }}" required>
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
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
