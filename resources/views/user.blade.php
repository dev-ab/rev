@extends('layouts/app')

@section('content')
<div class="container-fluid">
    <h3 style="text-align: center">Create New User</h3>
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            @if(session('status') == 'nothing')
            <h5 class="alert alert-danger" style="text-align: center"> Something went wrong.</h5>
            @elseif(session('status') == 'created')
            <h5 class="alert alert-success" style="text-align: center">User Created Successfully.</h5>
            @elseif(session('status') == 'deleted')
            <h5 class="alert alert-success" style="text-align: center">User Deleted Successfully.</h5>

            @endif
        </div>
    </div>
    <form method="post" action="{{url('user/save')}}">
        {{csrf_field()}}
        <input type="hidden" name="id" value="null">
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="User Full Name">
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <input type="email" name="email" class="form-control" value="{{old('email')}}" placeholder="User Email Address">
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <input type="password" name="password" class="form-control" value="" placeholder="User Password">
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <input type="password" name="password_confirmation" class="form-control" value="" placeholder="Confirm Password">
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <select name='role' class='form-control'>
                    <option value=''>Select Role...</option>
                    @foreach($roles as $role)
                    <option value='{{$role->id}}' {{old('role') == $role->id? 'selected' : ''}}>{{$role->display_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row" style="padding: 10px">
            <div class="col-md-2 col-md-offset-5" style='text-align: center'>
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </form>
    <hr class="divider">
    <h3 style="text-align: center">Manage Existing Users</h3>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>User Role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->roles[0]->display_name}}</td>
                        <td style="text-align: center">
                            <a href="{{url('user/edit/' . $user->id)}}" style="margin-right: 20px">Edit</a>
                            <a href="{{url('user/delete/' . $user->id)}}" style="margin-right: 20px">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection