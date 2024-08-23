@extends('admin.layouts.master')

@section('title')
    Course List
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            <h2 class="text-center mb-3 font-weight-bold">Course</h2>
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

            <div class="d-flex justify-content-between">
                <a href="{{ route('course.create') }}" class="btn" style="background-color: var(--orange)">
                    <span class="text-white" style="font-size: 20px;">Create</span>
                </a>

                <form action="{{ route('course.list') }}" method="GET" class="d-flex">
                    <select class="form-select" id="searchKey" name="searchKey">
                        <option value="" selected>Search with category</option>
                        @foreach ($categories as $category)
                        {{-- show searchKey in select box after searching --}}
                            <option value="{{ $category->id }}" {{ old('searchKey', request('searchKey') == $category->id? "selected": "") }}>
                               {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn text-white ms-3"
                        style="background-color: var(--purple)">Search</button>
                </form>

            </div>
            <div class="card mt-3">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="col-3">Title</th>

                                <th>Image</th>
                                <th>Instructor</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="table_body">
                            <?php
                            // ((1 - 1) * 5)  + 1 = 1
                            // ((2 - 1) * 5) + 1 = 6
                            // ((3 - 1) * 5) + 1 = 11
                            $num = ($courses->currentPage() - 1) * $courses->perPage() + 1;
                            ?>
                            @foreach ($courses as $course)
                                <tr>
                                    <td>{{ $num }}</td>
                                    <td class="text-wrap">{{ $course->name }}</td>
                                    <td>
                                        <img width="100px" src="{{ asset('storage/courseImage/' . $course->image) }}"
                                            alt="">
                                    </td>
                                    <td>
                                        {{ $course->instructor_name }}
                                    </td>
                                    {{-- <td>{{ $course->created_at->format('Y-m-d h:i A') }}</td> --}}
                                    <td>{{ $course->price }} mmk</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('course.edit', $course->id) }}"><button
                                                    class="btn btn-sm bg-dark text-white" style="margin-right: 10px;"><i
                                                        class="fas fa-edit"></i></button></a>

                                            <form action="{{ route('course.delete', $course->id) }}" method="post">
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

                    <!-- Pagination Links -->
                </div>
                <!-- /.card-body -->
            </div>
            <div class="d-flex justify-content-center">
                {{ $courses->links() }}
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@section('myjs')
    <script></script>
@endsection
