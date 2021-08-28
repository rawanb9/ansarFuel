@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row h-100 align-items-center align-content-center justify-content-center">
            <div class="card bg-dark text-white ">
                <div class="card-header"><h3>Register</h3></div>
                <div class="card-body">
                    <form method="POST" action="{{route('register')}}">
                        @csrf
                        <div class="row text-center justify-content-center">
                            <div class="col-11 col-md-5 mb-2 mx-2">
                                <label for="email"></label>
                                <input class="form-control  bg-dark text-white " type="email" name="email" id="email"
                                       placeholder="Email" required
                                       autofocus>
                            </div>
                            <div class="col-11 col-md-5 mb-2 mx-2">
                                <label for="name"></label>
                                <input class="form-control bg-dark text-white " type="text" name="name" id="name"
                                       placeholder="Name" required
                                >
                            </div>
                            <div class="col-11 col-md-5 mb-2  mx-2">
                                <label for="password"></label>
                                <input class="form-control bg-dark text-white" type="password" name="password"
                                       id="password"
                                       required
                                       autocomplete="new-password"
                                       placeholder="Password">
                            </div>
                            <div class="col-11 col-md-5 mb-2  mx-2">
                                <label for="password_confirmation"></label>
                                <input class="form-control bg-dark text-white" type="password"
                                       name="password_confirmation"
                                       id="password_confirmation" required
                                       autocomplete="new-password"
                                       placeholder="Confirm Password">
                            </div>

                            <div class="col-11 col-md-5 mb-2  mx-2">
                                <label for="blood_type"></label>
                                <select class="single-select bg-dark text-white " style="width:100%" name="blood_type"
                                        id="blood_type"
                                        required
                                        data-placeholder="Select Your Blood Type">
                                    <option></option>
                                    @foreach($bloodTypes as $bloodType)
                                        <option value="{{$bloodType->id}}">{{$bloodType->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-11 col-md-5 mb-2  mx-2">
                                <label for="gender"></label>
                                <select class="single-select bg-dark text-white" style="width:100%" name="gender"
                                        id="gender" required
                                        data-placeholder="Select Your Gender">
                                    <option></option>
                                    <option value="Male">
                                        Male
                                    </option>
                                    <option value="Female">
                                        Female
                                    </option>
                                </select>
                            </div>

                            <div class="col-12 m-2">
                                <button class="btn btn-outline-primary" type="submit">
                                    {{__('Sign Up')}}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="card-footer text-center">
                    <div class="col-12 mb-1">
                        {{ __('Already Registered?') }}
                    </div>
                    <div class="col-12">
                        <a class="btn btn-outline-light" href="{{route('login')}}">
                            {{ __('Sign In') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('bottom_scripts')
    <script>
        $(document).ready(function () {
            $('.single-select').select2({
                placeholder: $(this).data('placeholder'),
                theme: 'wehbe'
            })
        });
    </script>
@endsection

