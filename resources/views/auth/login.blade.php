@extends('layouts.layout')
@section('content')

    <div class="container">
        <div class="row h-100 align-items-center align-content-center justify-content-center">
            <div class="card bg-dark text-white w-auto">
                <div class="card-header"><h3>Login</h3></div>
                <div class="card-body">
                    <form method="POST" action="{{route('login')}}">
                        @csrf
                        <div class="row text-center justify-content-center">
                            <div class="col-11 col-md-5 mb-2">
                                <label for="email"></label>
                                <input class="form-control bg-dark text-white mx-2" type="email" name="email" id="email"
                                       placeholder="Email"
                                       required
                                       autofocus>
                            </div>
                            <div class="col-11 col-md-5 mb-2 ">
                                <label for="password"></label>
                                <input class="form-control bg-dark text-white mx-2" type="password" name="password" id="password" required
                                       autocomplete="current-password"
                                       placeholder="Password">
                            </div>

                            <div class="col-12 mb-2 mx-2">
                                <input class="form-check-input bg-dark text-white "  style="border-color: white" type="checkbox" id="remember_me" name="remember">
                                <label class="form-check-label" for="remember_me">
                                    {{ __('Remember me') }}
                                </label>
                            </div>

                            <div class="col-12 mb-2 mx-2">
                                <button class="btn btn-outline-primary" type="submit">
                                    {{__('Log in')}}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="card-footer text-center">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-300 hover:text-gray-600 mb-3"
                           href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                    <div class="col-12 mb-1">
                        {{ __('Not a member?') }}
                    </div>
                    <div class="col-12">
                        <a class="btn btn-outline-light" href="{{route('register')}}">
                            {{ __('Sign up now') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
