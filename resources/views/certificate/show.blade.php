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
                <span>{{$certificate->name}} Certificate Users</span>
                <span class="btn disabled btn-outline-warning">Count: {{$count}}</span>
                <a class="btn-outline-primary btn float-right" href="{{route('certificate.index')}}">Back</a>
            </h3>
        </div>
        <div class="card-body w-auto " style="border: 1px solid rgba(255,255,255,0.12)">
            <table id="datatable" class="hover  text-white stripe w-100">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Last Login</td>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->last_login ?? "Never"}}</td>
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
