@extends('admin.layouts.master')

@section('title')
    Password Change
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
            <h2 class="text-center mb-3 font-weight-bold ">Change Password</h2>
            @if (session('updateSuccess'))
                <div class="row justify-content-end">
                    <div class="col-md-5">
                        <div class="alert alert-default-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('updateSuccess') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            <div>
                @if (session('changePasswordFail'))
                <div class="row justify-content-end">
                    <div class="col-md-5">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('changePasswordFail') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif
                <div class="card shadow-lg p-4" style="background-color: var(--purple)">
                    <form method="post" action="{{ route('admin.profile.changePassword') }}" id="changePasswordForm">
                        @csrf
                        {{-- <h2 class="text-center  mb-3 font-weight-bold">Change Password</h2> --}}

                        <div class="form-group row mt-3">
                            <label for="oldpassword" class="text-white col-form-label">Old Password *</label>
                            <div class="">
                                <input type="text" name="oldPassword" value="{{ old('oldPassword') }}" class="form-control"
                                    id="oldpassword" placeholder="Old Password">
                                @error('oldPassword')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="newPassword" class="text-white col-form-label">New Password *</label>
                            <div class="">
                                <input type="text" name="newPassword" value="{{ old('newPassword') }}" class="form-control"
                                    id="newPassword" placeholder="New Password">
                                @error('newPassword')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <label for="confirmPassword" class="text-white col-form-label">Confirm Password *</label>
                            <div class="">
                                <input type="text" name="confirmPassword" value="{{ old('confirmPassword') }}"
                                    class="form-control" id="confirmPassword" placeholder="Confirm Password">
                                @error('confirmPassword')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <a href="{{route('admin.profile.detail')}}" class="btn btn-dark">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
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
