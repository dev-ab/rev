@extends('layouts/app')

@section('content')
<div class="container-fluid">
    <h5 style="text-align: center"><a href='{{url('user')}}'>Back to Users</a></h5>
    <h3 style="text-align: center">Update User "{{$user->name}}"</h3>
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            @if(session('status') == 'nothing')
            <h5 class="alert alert-danger" style="text-align: center"> Something went wrong.</h5>
            @elseif(session('status') == 'updated')
            <h5 class="alert alert-success" style="text-align: center">User Updated Successfully.</h5>
            @endif
        </div>
    </div>
    <form method="post" action="{{url('user/save')}}">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$user->id}}">
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <input type="text" name="name" class="form-control" value="{{$user->name}}" placeholder="User Full Name">
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <input type="email" name="email" class="form-control" value="{{$user->email}}" placeholder="User Email Address">
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
                    <option value='{{$role->id}}' {{$user->roles[0]->id == $role->id? 'selected' : ''}}>{{$role->display_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row" style="padding: 10px">
            <div class="col-md-2 col-md-offset-5" style='text-align: center'>
                <a href="{{url('user/delete/' . $user->id)}}" class="btn btn-danger">Delete</a>
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </form>
    <hr class="divider">
</div>
@endsection