@extends('admin.layouts.master')

@section('title')
    Zoom Link
@endsection

@section('myCss')

@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            <h2 class="text-center mb-3 font-weight-bold">Users who have been sent zoom link</h2>
            @if (session('message'))
            <div class="row justify-content-end">
                <div class="col-md-5">
                    <div class="alert alert-default-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('message') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            @endif
            {{-- @if (session('updateSuccess'))
            <div class="row justify-content-end">
                <div class="col-md-5">
                    <div class="alert alert-default-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('updateSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
            </div>
            @endif --}}

            <div class="card mt-3">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Zoom Link</th>
                                <th>Course</th>
                                <th>Status</th>
                                <th>Action</th>
                                {{-- <th>Address</th> --}}
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = 1;
                            ?>
                            @foreach ($zoomLinkUsers as $zoom_data)
                            <form method="post" action="{{ route('admin.zoomLink.delete', $zoom_data->id) }}" id="deleteForm">
                                @csrf
                            </form>
                                <tr style="line-height: 90px;">
                                    <td>{{ $num }}</td>
                                    <td>{{ $zoom_data->name }}</td>
                                    <td>{{ $zoom_data->email }}</td>
                                    <td>{{ $zoom_data->link }}</td>
                                    <td>{{ $zoom_data->course_name }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-success"><i class="fa-solid fa-check"></i> Sent</button>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.zoomlink.edit', $zoom_data->id) }}" class="btn btn-warning">Edit</a>
                                        <button data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" class="btn btn-danger">Delete</button>
                                    </td>
                                    {{-- <td class=""><a href="{{ route('admin.zoomLink.create', $user->id) }}" class="payment-send-btn btn btn-warning" title="zoom link ပို့မယ်">
                                        <i class="fa-regular fa-paper-plane me-2"></i>Send</a></td> --}}
                                </tr>

                                <?php $num++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <!-- Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                                <h4 class="text-center mt-4">Are you sure you want to delete?</h4>

                            <div class="modal-body">

                                <div class="text-end mt-3">
                                    <button type="button" class="close-btn btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" onclick="document.querySelector('#deleteForm').submit()" class="btn btn-danger">Delete</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
