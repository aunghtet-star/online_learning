@extends('admin.layouts.master')

@section('title')
    Zoom Link
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-7">
            <h2 class="text-center mb-3 font-weight-bold">Zoom Link</h2>

            <form method="post" action="{{route('admin.zoomlink.update', $zoom_data->id)}}">
                @csrf
                <input type="hidden" value="{{ $zoom_data->user_id }}" name="userId">
                <input type="hidden" value="{{ $zoom_data->course_id }}" name="courseId">

                <div class="form-group row mt-3">
                    <label for="" class="col-11 col-form-label">Name</label>
                    <div class="col-11">
                        <input type="text" value="{{ $zoom_data->name }}" disabled class="form-control" id="">
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label for="" class="col-11 col-form-label">Email</label>
                    <div class="col-11">
                        <input type="email" value="{{ $zoom_data->email }}" disabled class="form-control" id="">
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label for="" class="col-11 col-form-label">Course</label>
                    <div class="col-11">
                        <input type="text" value="{{ $zoom_data->course_name }}" disabled class="form-control" id="">
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label for="inputZoomLink" class="col-11 col-form-label">Zoom Link *</label>
                    <div class="col-11">
                        <input type="text" name="zoomLink"  class="form-control" value="{{ old('zoomLink', $zoom_data->link) }}"
                            id="inputZoomLink" placeholder="Zoom Link">
                    </div>
                    @error('zoomLink')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group row mt-3">
                    <label for="inputDescription" class="col-11 col-form-label">Description *</label>

                    <div class="col-11">
                        <textarea name="zoomLinkDescription" class="form-control" id="courseTextArea" rows="10">
                            {{ old('zoomLinkDescription', $zoom_data->description) }}
                        </textarea>
                    </div>
                    @error('zoomLinkDescription')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
                <div class="row ">

                    <div class="col-11 d-flex justify-content-end">
                        <a href="{{ route('admin.payment.list') }}" class="btn btn-secondary me-3">Back</a>
                        <button class="btn btn-primary px-4" type="submit">Update</button>
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
