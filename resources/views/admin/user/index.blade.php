@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>List of Users</h2>
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <th width="10%">Serial No</th>
                            <th width="20%">Name</th>
                            <th width="20%">Email</th>
                            <th width="15%">User Role</th>
                            <th width="50%">Action</th>
                        </thead>
                        <tbody>
                            @if (isset($users) && count($users))
                                @php $sl_no = 1; @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{$sl_no}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role->name}}</td>
                                        <td>
                                            <div class="col-sm-12">
                                                <div class="pull-left">

                                                    @if (!$user->isVerified())
                                                        <a href="{{route('user.verifyByAdmin',$user->verification_token)}}" class="btn btn-danger">Verify</a>
                                                    @endif

                                                </div>
                                                <div class="pull-left">
                                                    &nbsp;&nbsp;
                                                    @if ($user->isActive())
                                                        <a href="#" class="btn btn-success">Deactive</a>
                                                        @else
                                                            <a href="#" class="btn btn-danger">Active</a>
                                                    @endif
                                                </div>
                                                <div class="pull-left">
                                                    &nbsp;&nbsp;
                                                    @if ($user->isAdmin())
                                                        <a href="{{route('user.makeRegular',$user->user_id)}}" class="btn btn-success">Make Reguler</a>
                                                        @else
                                                            <a href="{{route('user.makeAdmin',$user->user_id)}}" class="btn btn-danger">Make Admin</a>
                                                    @endif
                                                </div>
                                                <div class="pull-left">
                                                    &nbsp;&nbsp;<a href="{{route('users.edit',$user->user_id)}}" class="btn btn-info">Edit</a>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    @php $sl_no++ @endphp
                                @endforeach
                            @else
                                <p>No data found.</p>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
