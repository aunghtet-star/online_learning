@extends('admin.layouts.master')

@section('title')
    Accounts
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            <h2 class="text-center mb-3 font-weight-bold">User List</h2>
            {{-- @if (session('createSuccess'))
            <div class="row justify-content-end">
                <div class="col-md-5">
                    <div class="alert alert-default-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('createSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
            </div>
            @endif
            @if (session('updateSuccess'))
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
                                <th>Role</th>
                                {{-- <th>Address</th> --}}
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = 1;
                            ?>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $num }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
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
