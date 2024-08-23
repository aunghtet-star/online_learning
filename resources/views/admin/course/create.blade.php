@extends('admin.layouts.master')

@section('title')
    Create Course
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            <h2 class="text-center mb-3 font-weight-bold">Create Course</h2>

            <form method="post" action="{{ route('course.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row mt-3">
                    <label for="" class="col-11 col-form-label">Name *</label>
                    <div class="col-11">
                        <input type="text" name="courseName" value="{{ old('courseName') }}" class="form-control"
                            id="" placeholder="Name">
                        @error('courseName')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mt-3">
                    <label class="col-11 col-form-label">Category Name *</label>
                    <div class="col-11 ">
                        <select name="courseCategoryId" id="" class="form-control">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                {{-- <option value="{{ $category->id }}"
                                    {{ old('courseCategoryId') == $category->id ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option> --}}
                                <option value="{{ $category->id }}"
                                    {{ old('courseCategoryId') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('courseCategoryId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mt-3">
                    <label for="courseTextArea" class="col-11 col-form-label">Description *</label>

                    <div class="col-11">
                        <textarea name="courseDescription" class="form-control" id="courseTextArea" rows="7">{{ old('courseDescription') }}</textarea>
                        @error('courseDescription')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="form-group row mt-3">
                    <label for="" class="col-11 col-form-label">Video *</label>
                    <div class="col-11">
                        <input type="file" name="courseVideo" value="" class="form-control form-control-lg"
                            id="" placeholder="Title">
                        @error('courseVideo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mt-3">
                    <label for="" class="col-11 col-form-label">Image *</label>
                    <div class="col-11">
                        <input type="file" name="courseImage" value="" class="form-control form-control-lg"
                            id="" placeholder="Title">
                        @error('courseImage')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mt-3">
                    <label for="" class="col-11 col-form-label">Instructor Name *</label>
                    <div class="col-11">
                        <input type="text" name="courseInstructorName" value="{{ old('courseInstructorName') }}" class="form-control"
                            id="courseInstructorName" placeholder="Instructor Name">
                        @error('courseInstructorName')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mt-3">
                    <label for="" class="col-11 col-form-label">Price *</label>
                    <div class="col-11">
                        <input type="number" name="coursePrice" value="{{ old('coursePrice') }}" class="form-control" id="inputTitle"
                            placeholder="price (mmk)">
                        @error('coursePrice')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="row ">

                    <div class="col-11 d-flex justify-content-end">
                        <a href="{{ route('course.list') }}" class="btn btn-secondary me-3">Back</a>
                        <button class="btn btn-primary px-4" type="submit">Create</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection

@section('myjs')
    <script>
        // ckeditor
        ClassicEditor
            .create(document.querySelector('#courseTextArea'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
