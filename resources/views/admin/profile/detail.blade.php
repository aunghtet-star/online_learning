@extends('admin.layouts.master')

@section('title')
    Profile
@endsection

@section('myCss')
    <style>
        /* #changePasswordForm {
                        display: none;
                    }*/

        .change-password:hover {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-5">
            <h2 class="text-center mb-3 font-weight-bold">Profile</h2>
            @if (session('updateSuccess'))
                <div class="row justify-content-end">
                    <div class="col-12">
                        <div class="alert alert-default-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('updateSuccess') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif
            <div class="mb-3 card shadow-lg p-5" style="background-color: var(--purple)">

                <form method="post" action="{{ route('admin.profile.update', Auth::user()->id) }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-6 m-auto">
                        <img class="img-thumbnail" src="@if(Auth::user()->image == null) {{ asset('defaultImage/default_male.png') }} @else {{asset('storage/profileImage/'. Auth::user()->image)}} @endif" alt="">

                        <div class="form-group mt-2">
                            <input name="profileImage" type="file" class="form-control " aria-required="true"
                                aria-invalid="false" placeholder="">
                                @error('profileImage')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <label for="inputName" class="col-form-label text-white">Name *</label>
                        <div class="">
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                                class="form-control" id="inputName" placeholder="Name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label for="inputEmail" class="col-form-label text-white">Email *</label>
                        <div class="">
                            <input type="text" name="email" value="{{ old('email', Auth::user()->email) }}"
                                class="form-control" id="inputEmail" placeholder="Email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-2">
                        <a href="{{ route('admin.profile.changePasswordPage') }}" class="change-password text-white"
                            style="text-decoration: underline">change password</a>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

            </div>

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


        // $('.change-password').click(function(e) {
        //     e.preventDefault();
        //     // console.log("hello world");
        //     $('#changePasswordForm').toggle();
        // })
    </script>
@endsection
