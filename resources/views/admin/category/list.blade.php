@extends('admin.layouts.master')

@section('title')
    Category List
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            <h2 class="text-center mb-3 font-weight-bold">Category</h2>
            @if (session('createSuccess'))
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
            @endif

            <a href="{{ route('category.create') }}" class="btn" style="background-color: var(--orange)">
                <span class="text-white" style="font-size: 20px;">Create</span>
            </a>
            <div class="card mt-3">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Created at</th>
                                {{-- <th>Address</th> --}}
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = 1;
                            ?>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $num }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->created_at->format('Y-m-d h:i A') }}</td>
                                    <td >
                                        <div class="d-flex">
                                            <a href="{{ route('category.edit', $category->id) }}"><button class="btn btn-sm bg-dark text-white"
                                                    style="margin-right: 10px;"><i class="fas fa-edit"></i></button></a>

                                            <form action="{{ route('category.delete', $category->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-sm bg-danger text-white"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>

                                        </div>

                                    </td>
                                </tr>
                                <?php
                                $num++;
                                ?>
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
