@extends('admin.layouts.master')

@section('title')
    Create Category
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            <h2 class="text-center mb-3 font-weight-bold">Category</h2>


            <form  method="post" action="{{ route('category.store') }}">
                @csrf
                <div class="form-group row mt-3">
                    <label for="inputTitle" class="col-11 col-form-label">Name *</label>
                    <div class="col-11">
                        <input type="text" name="categoryTitle" value="{{ old('categoryTitle') }}"
                            class="form-control form-control-lg
                            id="inputTitle" placeholder="Name">
                        @error('categoryTitle')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row ">
                    <div class="col-sm-11 d-flex justify-content-end">
                        <a href="{{ route('category.list') }}" class="btn btn-secondary">Back</a>
                        <button class="btn btn-primary px-4 ml-3" type="submit">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
