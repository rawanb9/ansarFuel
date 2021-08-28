@extends('layouts.layout')

@section('top_scripts')
    <script type="text/javascript" src="{{asset('DataTables/dataTables.js')}}"></script>
@endsection

@section('top_styles')
    <link rel="stylesheet" href="{{asset('DataTables/dataTables.css')}}">
@endsection

@section('content')
    <div class="card p-5 m-5 bg-dark text-white" style="border: 1px solid rgba(255,255,255,0.12)">
        <div class="card-header" style="background-color: rgba(0, 0, 0, 0.4);border: 1px solid rgba(255,255,255,0.12)">
            <h3>
                Certificates
                <a class="btn-outline-success btn float-right" href="{{route('certificate.create')}}">Create New Certificate</a>
            </h3>
        </div>
        <div class="card-body w-auto " style="border: 1px solid rgba(255,255,255,0.12)">
            <table id="datatable" class="hover  text-white stripe w-100">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Visible</td>
                    <td>Users Count</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($certificates as $certificate)
                    <tr>
                        <td>{{$certificate->id}}</td>
                        <td>{{$certificate->name}}</td>
                        <td>{{$certificate->is_visible ? "Yes" : "No"}}</td>
                        <td>{{sizeof($certificate->users)}}</td>
                        <td>
                            <a href="{{route('certificate.edit',$certificate->id)}}"
                               class="btn btn-outline-primary">Edit</a>
                            <a href="{{route('certificate.show',$certificate->id)}}"
                               class="btn btn-outline-info">Show Details</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('bottom_scripts')
    <script>
        $(document).ready(function () {

            $('#datatable').DataTable();
        })
    </script>
@endsection
