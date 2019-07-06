@include('layouts.header')
<body class="body">
    <div >
            <nav class="navbar navbar-expand-lg navbar-light backgroundhome ">
                <a class="navbar-brand" href="/home">
                    <img class="imgindex" src="/image/LogoVigilantSolutions.png" alt="" >
                </a>
                <div class="collapse navbar-collapse borderleft" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto ">
                            <h3>  Computer Portfolio</h3>
                    </ul>
                    <ul class="navbar-nav text-right">
                        {{-- <form class="form-inline my-2 my-lg-0"> --}}
                            <li class="nav-item dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                       <i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item admin" href="/login"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                       <i class="fa fa-sign-out fa-fw"></i>  {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf 
                                    </form>
                                </div>
                                <!-- /.dropdown-user -->
                            </li>
                        {{-- </form> --}}
                    </ul>
                </div>
            </nav>
            <div class="row row-body">
                <div class="col-md-2 menu">
                    @include('layouts.menu')
                </div>
                <div class="col-md-10">
                    @yield('content')
                </div>
            </div>
    </div>
    @yield('script')
</body>
</html>
