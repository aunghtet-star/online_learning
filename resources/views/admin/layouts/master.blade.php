<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">

    @yield('myCss')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"
                            id="nav-menu-button"></i></a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar elevation-4">
            <a href="#" class="brand-link">

                <span class="brand-text text-white font-weight-bolder ml-2" style="font-size: 30px;">Learner
                    Choice</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('admin.profile.detail') }}" class="nav-link">
                                <i class="fas fa-user-circle"></i>
                                <p>
                                    My Profile
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.user_account.list') }}" class="nav-link">
                                <i class="fas fa-users"></i>
                                <p>
                                    User List
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('category.list') }}" class="nav-link">
                                <i class="fas fa-list"></i>

                                <p>
                                    Category
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('course.list') }}" class="nav-link">
                                <i class="fa-solid fa-layer-group"></i>

                                <p>
                                    Course
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.payment.list') }}" class="nav-link">
                                <i class="fa-solid fa-money-bill"></i>
                                <p>
                                    Payment
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.zoomLink.list')}}" class="nav-link">
                                <i class="fa-solid fa-video"></i>
                                <p>
                                    Zoom Link
                                </p>
                            </a>
                        </li>

                        <li class="nav-item mt-5">
                            <form method="post" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" id="logout-btn" class="btn btn-danger w-100">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </button>

                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <section class="content my-5">
                <div class="container-fluid" style="">
                    @yield('content')
                </div>
            </section>
        </div>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>

    {{-- bootstrap js  --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    {{-- ck editor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    @yield('myjs')
</body>

</html>
