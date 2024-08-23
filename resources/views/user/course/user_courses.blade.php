@extends('user.layouts.master')

@section('title')
    User Courses
@endsection

@section('myCss')

@endsection

@section('content')
    <div class="row mt-3 justify-content-center" style="min-height: 90vh;">
        <div class="col-10">
            <h2 class="text-center mb-3 font-weight-bold">My Courses</h2>

            <div class="card mt-3">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Zoom Link</th>
                                <th>Course</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $num = 1;
                            ?>
                            @foreach ($user_courses as $user)
                                <tr style="line-height: 90px;">
                                    <td>{{ $num }}</td>
                                    <td>{{ $user->link }}</td>
                                    <td>{{ $user->course_name }}</td>
                                    <td><a href="{{route('user.user_course_details', $user->zoom_link_id)}}" class="btn btn-warning"><i class="fa-solid fa-eye"></i></a></td>
                                    {{-- <td class=""><a href="{{ route('admin.zoomLink.create', $user->id) }}" class="payment-send-btn btn btn-warning" title="zoom link ပို့မယ်">
                                        <i class="fa-regular fa-paper-plane me-2"></i>Send</a></td> --}}
                                </tr>

                                <?php $num++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
