<html xmlns="http://www.w3.org/1999/html" lang="en">
<head>
    <title>{{__('Hassan Wehbe')}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}}">

    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    @livewireStyles
    @yield('top_styles')
    @yield('top_scripts')
</head>
<body class="bg-dark bg-gradient bg-no-repeat">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('home')}}">Hassan Wehbe</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @if (Auth::user() && Auth::user()->hasVerifiedEmail())

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- <li class="nav-item">
                        <a class="mx-1 btn @if(Route::getCurrentRoute()->getName()=='home') btn-primary @else btn-outline-primary @endif"
                           aria-current="page" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="mx-1 btn @if(Route::getCurrentRoute()->getName()=='certificate.assignIndex') btn-primary @else btn-outline-primary @endif"
                           aria-current="page" href="{{route('certificate.assignIndex')}}">Manage My Certificates</a>
                    </li> -->
                    @if (\Illuminate\Support\Facades\Auth::user()->hasRole('Admin'))
                        <li class="nav-item">
                            <a class="mx-1 btn @if(Route::getCurrentRoute()->getName()=='serial') btn-primary @else btn-outline-primary @endif"
                               href="{{route('serial')}}">Search Serial</a>
                        </li>
                        <!-- 
                        <li class="nav-item">
                            <a class="mx-1 btn @if(Route::getCurrentRoute()->getName()=='certificate.index') btn-primary @else btn-outline-primary @endif"
                               href="{{route('certificate.index')}}">Certificates</a>
                        </li>
                        <li class="nav-item">
                            <a class="mx-1 btn @if(Route::getCurrentRoute()->getName()=='blood-type.index') btn-primary @else btn-outline-primary @endif"
                               href="{{route('blood-type.index')}}">Blood Types</a>
                        </li>
                        <li class="nav-item">
                            <a class="mx-1 btn @if(Route::getCurrentRoute()->getName()=='user.get-verify-users') btn-primary @else btn-outline-primary @endif"
                               href="{{route('user.get-verify-users')}}">Verify Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="mx-1 btn @if(Route::getCurrentRoute()->getName()=='user.all') btn-primary @else btn-outline-primary @endif"
                               href="{{route('user.all')}}">All Users</a>
                        </li> -->
                        <!-- 
                        {{--                    <li class="nav-item dropdown">--}}
                        {{--                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"--}}
                        {{--                           data-bs-toggle="dropdown" aria-expanded="false">--}}
                        {{--                            Dropdown--}}
                        {{--                        </a>--}}
                        {{--                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
                        {{--                            <li><a class="dropdown-item" href="#">Action</a></li>--}}
                        {{--                            <li><a class="dropdown-item" href="#">Another action</a></li>--}}
                        {{--                            <li>--}}
                        {{--                                <hr class="dropdown-divider">--}}
                        {{--                            </li>--}}
                        {{--                            <li><a class="dropdown-item" href="#">Something else here</a></li>--}}
                        {{--                        </ul>--}}
                        {{--                    </li>--}}
                        {{--                    <li class="nav-item">--}}
                        {{--                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>--}}
                        {{--                    </li>--}} -->
                    @endif
                </ul>
                <div class="d-flex">
                    @if(Route::getCurrentRoute()->getName()=='profile.show')
                        <button class="btn me-2 btn-primary" disabled>Profile</button>
                    @else
                        <a class="btn me-2 btn-outline-primary" href="{{route('profile.show')}}">Profile</a>
                    @endif
                    <form method="POST" action="{{route('logout')}}" class="mb-0">
                        @csrf
                        <button class="btn btn-outline-danger me-2" type="submit">Logout</button>
                    </form>
                </div>
            @elseif(Auth::user() && !Auth::user()->hasVerifiedEmail())
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                    <li class="text-warning">Please Wait The Admin To Verify Your Email</li>
                </ul>
                <form method="POST" action="{{route('logout')}}" class="mb-0">
                    @csrf
                    <button class="btn btn-outline-danger me-2" type="submit">Logout</button>
                </form>
            @else
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                <div class="d-flex">
                    @if(Route::getCurrentRoute()->getName()=='login')
                        <button class="btn btn-light me-2" disabled="">Login</button>
                    @else
                        <a class="btn btn-outline-light me-2" href="{{route('login')}}">Login</a>
                    @endif
                    @if(Route::getCurrentRoute()->getName()=='register')
                        <button class="btn btn-light" disabled="">Register</button>
                    @else
                        <a class="btn btn-outline-light" href="{{route('register')}}">Register</a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</nav>
<section class="d-block">
@if (isset($slot))
    <!-- Page Content -->
        {{ $slot }}
    @endif

    @yield('content')
</section>
@include('controller-messages')
@stack('modals')
@livewireScripts
<script src="{{asset('js/alpinejs.js')}}"></script>@yield('bottom_scripts')

</body>
</html>
