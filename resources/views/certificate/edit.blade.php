@extends('layouts.layout')
@section('content')
    <div class="card p-5 m-5 bg-dark text-white" style="border: 1px solid rgba(255,255,255,0.12)">
        <div class="card-header" style="background-color: rgba(0, 0, 0, 0.4);border: 1px solid rgba(255,255,255,0.12)">
            <h3>
                Edit Certificate
                <a class="btn-outline-primary btn float-right" href="{{route('certificate.index')}}">Back</a>
            </h3>
        </div>
        <div class="card-body w-auto " style="border: 1px solid rgba(255,255,255,0.12)">
            <form method="post" action="{{route('certificate.update',$certificate->id)}}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="m-1">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class=" bg-dark text-white form-control" required value="{{$certificate->name}}">
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-12">
                        <div class="m-1">
                            <input type="checkbox" id="is_visible" name="is_visible"
                                   class=" bg-dark text-white form-check-input"
                                       {{!$certificate->is_visible?:'checked'}}
                                   value="1" style="border-color: white">
                            <label for="is_visible" class="form-check-label">Is Visible</label>
                        </div>
                    </div>
                    <div class="w-100 text-center mt-2">
                        <button type="submit" class="btn btn-outline-info">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
