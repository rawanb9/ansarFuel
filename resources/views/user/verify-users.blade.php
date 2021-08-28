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
                Unverified Users
            </h3>
        </div>
        <div class="card-body w-auto " style="border: 1px solid rgba(255,255,255,0.12)">
            <table id="datatable" class="hover  text-white stripe w-100">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Gender</td>
                    <td>Blood Type</td>
                    <td>Registered At</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->gender}}</td>
                        <td>{{$user->bloodType->name}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            <button
                                class="verify btn btn-outline-success"
                                data-value="{{$user->id}}">Verify
                            </button>
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
            let table = $('#datatable');
            table.DataTable();
            table.on('click', '.verify', function () {
                let btn = $(this);
                Swal.fire({
                    text: "Are you sure you want to verify this user?",
                    title: "Are You Sure?",
                    icon: "warning",
                    showDenyButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: 'No',
                }).then(result => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Please Wait While Verifying",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                            showCancelButton: false,
                            showConfirmButton: false,
                            showDenyButton: false,
                            showCloseButton: false,
                            willOpen() {
                                Swal.showLoading()
                            },
                            didClose() {
                                Swal.hideLoading()
                            },

                        });
                        $.ajax({
                            url: "{{route('user.verify-user',"")}}/" + btn.data('value'),
                            method: "POST",
                            data: {
                                _token: "{{csrf_token()}}",
                            },
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        text: response.success.message,
                                        title: 'Success'
                                    });
                                    table.DataTable()
                                        .row(btn.parents('tr'))
                                        .remove()
                                        .draw()
                                } else if (response.error) {
                                    Swal.fire({
                                        icon: 'error',
                                        text: response.error,
                                        title: 'Error'
                                    });
                                }
                                else {
                                    Swal.fire({
                                        icon: 'error',
                                        text: "error response from server",
                                        title: 'Error'
                                    });
                                }
                            },
                            error: function () {
                                Swal.fire({
                                    icon: 'error',
                                    text: "error response from server",
                                    title: 'Error'
                                });
                            },
                            fail: function () {
                                Swal.fire({
                                    icon: 'error',
                                    text: "failed to contact the server",
                                    title: 'Error'
                                });
                            }
                        })
                    }
                })
            })
        })
    </script>
@endsection
