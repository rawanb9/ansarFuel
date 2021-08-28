@extends('layouts.layout')

@section('content')

    <div class="card p-5 m-5 bg-dark text-white" style="border: 1px solid rgba(255,255,255,0.12)">
        <div class="card-header" style="background-color: rgba(0, 0, 0, 0.4);border: 1px solid rgba(255,255,255,0.12)">
            <h3>
                Manage My Certificates
                <a class="btn-outline-primary btn float-right" href="{{route('profile.show')}}">Back</a>
            </h3>
        </div>
        <div class="card-body w-auto " style="border: 1px solid rgba(255,255,255,0.12)">
            <form method="post" action="{{route('certificate.assign')}}">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="m-1">
                            <label for="certificates" class="form-label">Certificates</label>
                            <select type="text" multiple id="certificates" name="certificates[]"
                                    class="form-control multi-select"
                                    data-placeholder="Select At Least 1 Certificate">
                                @foreach($certificates as $certificate)
                                    <option value="{{$certificate->id}}"
                                        {{in_array( $certificate->id,$myCertificates) ? "selected" : ""}}>
                                        {{$certificate->name}}
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
            $('.multi-select').select2(
                {
                    'placeholder': $(this).data('placeholder'),
                    theme:"wehbe"
                }
            );
        });
    </script>
@endsection
