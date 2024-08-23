<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm" >
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img width="75px" src="{{ asset('blog_3702035.png') }}" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-lg-5 mt-3 mt-lg-0 me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('user.index') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('user.user_courses')}}">MyCourses</a>
          </li>
        </ul>
        <div class="dropdown">
            <button  class="btn nav-bar-btn dropdown-toggle text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu">
                {{-- <li class="p-3"><a class="dropdown-item nav-profile-btn" href="">Profile</a></li> --}}
              <li class="dropdown-item">
                <form action="{{ route('logout') }}" method="post" >
                    @csrf
                    <button class="btn nav-bar-btn w-100" type="submit">Logout</button>
                </form>
              </li>

              {{-- <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
            </ul>
          </div>
      </div>
    </div>
  </nav>
