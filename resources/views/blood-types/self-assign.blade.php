@extends('layouts.layout')

@section('content')

    <div class="card p-5 m-5 bg-dark text-white" style="border: 1px solid rgba(255,255,255,0.12)">
        <div class="card-header" style="background-color: rgba(0, 0, 0, 0.4);border: 1px solid rgba(255,255,255,0.12)">
            <h3>
                Change My Blood Type
                <a class="btn-outline-primary btn float-right" href="{{route('profile.show')}}">Back</a>
            </h3>
        </div>
        <div class="card-body w-auto " style="border: 1px solid rgba(255,255,255,0.12)">
            <form method="post" action="{{route('blood-type.assign')}}">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="m-1">
                            <label for="blood_type" class="form-label">Blood Type</label>
                            <select type="text" id="blood_type" name="blood_type"
                                    class="form-control single-select"
                                    data-placeholder="Select A Blood Type">
                                @foreach($bloodTypes as $bloodType)
                                    <option value="{{$bloodType->id}}"
                                        {{$bloodType->id==$myBloodType ? "selected" : ""}}>
                                        {{$bloodType->name}}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="w-100 text-center mt-2">
                        <button type="submit" class="btn btn-outline-info">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('bottom_scripts')
    <script>
        $(document).ready(function () {
            $('.single-select').select2(
                {
                    'placeholder': $(this).data('placeholder'),
                    theme: "wehbe"
                }
            );
        });
    </script>
@endsection
