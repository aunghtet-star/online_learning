@extends('user.layouts.master')

@section('title')
    Home
@endsection

@section('mycss')
    <style>
        .card.course-card {
            background-color: #0c84ff;
        }

        #searchBtn {
            background-color: var(--orange);
        }

        .category-title {
            background-color: var(--orange);
        }

        .filter-card {
            background-color: #0c84ff !important;
        }

        .nav-filter-link {
            color: #fff;
            text-decoration: none;
        }

        .nav-filter-link:focus {
            text-decoration: underline;
        }

        .course-card {
            transition: transform 1s;
        }

        .course-card:hover {
            /* background-color: #000 !important; */
            transform: scale(1.05);
            box-shadow: 5px 5px var(--orange) !important;

        }
    </style>
@endsection


@section('content')
    <div class="row my-5">
        <div class="col-12">
            <div style="min-height: 800px">
                <div class="row p-5">
                    <div class="col-xl-4 p-0 mb-4">
                        <!-- Price Start -->
                        <div class="filter-card rounded p-5 shadow">
                            <form>
                                <div class="category-title p-3 d-flex align-items-center justify-content-between mb-3">

                                    <label class="text-white fs-3" for="price-all">Categories</label>
                                    <span class="badge"
                                        style="background-color: var(--purple)">{{ count($categories) }}</span>
                                </div>

                                <div
                                    class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3 ">

                                    <a class="nav-filter-link" href="{{ route('user.index') }}"><span
                                            class="">All</span></a>
                                </div>
                                @if (isset($categories))
                                    @foreach ($categories as $c)
                                        <div class="d-flex align-items-center justify-content-between mb-3 ">
                                            <a class="nav-filter-link"
                                                href="{{ route('user.filterByCategory', $c->id) }}"><span
                                                    class="">{{ $c->name }}</span></a>
                                        </div>
                                    @endforeach
                                @endif

                            </form>
                        </div>
                        <!-- Price End -->
                    </div>
                    <div class="col-xl-8">
                        <div class="row">
                            <div class="col-12">
                                @isset($category)
                                    <h1 class="category-filter-title mb-5 text-center">{{ $category->name }}</h1>
                                @endisset
                            </div>
                        </div>
                        <div class="row justify-content-around gap-2 gap-0 row-gap-5">
                            @if ($courses->count() === 0)
                                <div class="d-flex justify-content-center align-items-center" style="min-height: 600px">
                                    <h1 class="text-center text-danger border border-2 border-dark p-5">Not Found!</h1>
                                </div>
                            @else
                                @foreach ($courses as $course)
                                    <div
                                        class="col-12 col-md-5 col-xxl-3 card course-card shadow-lg rounded-full course-card p-3">
                                        <div class="card-body bg-white">
                                            <div class="d-flex justify-content-center">
                                                <img width="90%"
                                                    src="{{ asset('storage/courseImage/' . $course->image) }}"
                                                    alt="">
                                            </div>
                                            <h4 class="mt-2">{{ $course->name }}</h4>
                                            <p>
                                                <i class="fa-solid fa-user"></i><span
                                                    class="ms-2 fw-bold">{{ $course->instructor_name }}</span>
                                            </p>
                                            <p><i class="fa-solid fa-money-bill"></i><span
                                                    class="ms-2 fw-bold">{{ $course->price }}
                                                    mmk</span></p>
                                            <a href="{{ route('user.course_details', $course->id) }}" class="btn text-white"
                                                style="background-color: var(--orange)">See
                                                Details</a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-5">
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
