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
        <div class="card-body w-auto table-responsive " style="border: 1px solid rgba(255,255,255,0.12)">
            <table id="datatable" class="hover  text-white stripe w-100">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Gender</td>
                    <td>Blood Type</td>
                    <td>Certificates</td>
                    <td>Last Login</td>
                    <td>Registered At</td>
                    <td>Verified At</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                <?php
                /**
                 * @var  App\Models\User[] $users
                 */
                ?>
                @foreach($users as $user)
                    <?php
                    $certificatesArray = $user->certificates()->pluck('name')->toArray();
                    $certificates = sizeof($certificatesArray) > 0 ? implode(", ", $certificatesArray) : "No Certificates";
                    ?>
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->gender}}</td>
                        <td>{{$user->bloodType?$user->bloodType->name:"Not Set"}}</td>
                        <td>{{$certificates}}</td>
                        <td>{{$user->last_login ?? "Never"}}</td>
                        <td>{{$user->created_at}}</td>
                        <td class="verified-at">{{$user->email_verified_at ?? "Not Verified"}}</td>
                        <td>
                            @if ($user->hasVerifiedEmail() )
                                @if (!$user->hasRole('Admin'))
                                    <button
                                        class="unverify btn btn-outline-danger"
                                        data-value="{{$user->id}}">UnVerify
                                    </button>
                                @else
                                    No Actions
                                @endif

                            @else
                                <button
                                    class="verify btn btn-outline-success"
                                    data-value="{{$user->id}}">Verify
                                </button>
                            @endif


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
        function swalError(text) {
            Swal.fire({
                icon: 'error',
                text: text,
                title: 'Error'
            });
        }

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
                                    btn.parents('tr').find('.verified-at').text(response.success.ver_at);
                                    btn.removeClass(["verify", "btn-outline-success"]).addClass(["unverify", "btn-outline-danger"]).text('Unverify')
                                    Swal.fire({
                                        icon: 'success',
                                        text: response.success.message,
                                        title: 'Success'
                                    });
                                } else {
                                    swalError(response.error ?? "error response from server");
                                }
                            },
                            error: function () {
                                swalError("error response from server");
                            },
                            fail: function () {
                                swalError("failed to contact the server");
                            }
                        })
                    }
                })
            })
                .on('click', '.unverify', function () {
                    let btn = $(this);
                    Swal.fire({
                        text: "Are you sure you want to unVerify this user?",
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
                                url: "{{route('user.un-verify-user',"")}}/" + btn.data('value'),
                                method: "POST",
                                data: {
                                    _token: "{{csrf_token()}}",
                                },
                                success: function (response) {
                                    if (response.success) {
                                        btn.parents('tr').find('.verified-at').text("Not Verified");
                                        btn.addClass(["verify", "btn-outline-success"]).removeClass(["unverify", "btn-outline-danger"]).text('Verify')
                                        Swal.fire({
                                            icon: 'success',
                                            text: response.success.message,
                                            title: 'Success'
                                        });
                                    } else {
                                        swalError(response.error ?? "error response from server");
                                    }
                                },
                                error: function () {
                                    swalError("error response from server");
                                },
                                fail: function () {
                                    swalError("failed to contact the server");
                                }
                            })
                        }
                    })
                });
        })
    </script>
@endsection
