@extends('layouts.admin.app', ['pageTitle'=>'Edit Category'])
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
                            <form action="{{ route('admin.category.update', $category->id) }}" method="POST" class="form-valide-with-icon needs-validation">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="created_by">
                                <div class="mb-3 row">
                                    <div class="mb-3 col-md-12">
                                        <label class="text-label form-label" for="validationname">Title</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-pen-alt"></i> </span>
                                            <input type="text" name="name" class="form-control" id="validationname" value="{{ old('name', $category->name) }}" placeholder="Enter name here.." required>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="text-label form-label" for="descriptionEditor">Description</label>
                                        <div class="input-group">
                                            <textarea name="description" id="descriptionEditor" class="form-control" placeholder="Enter notice description.." required>{{ old('description', $category->description) }}</textarea>
                                            @error('description')
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