@extends('layouts/app')

@section('content')
<div class="container-fluid">
    <h3 style="text-align: center">Create New Role</h3>
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            @if(session('status') == 'nothing')
            <h5 class="alert alert-danger" style="text-align: center"> Something went wrong.</h5>
            @elseif(session('status') == 'created')
            <h5 class="alert alert-success" style="text-align: center">Role Created Successfully.</h5>
            @elseif(session('status') == 'deleted')
            <h5 class="alert alert-success" style="text-align: center">Role Deleted Successfully.</h5>

            @endif
        </div>
    </div>
    <form method="post" action="{{url('role/save')}}">
        {{csrf_field()}}
        <input type="hidden" name="id" value="null">
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Role System name">
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <input type="text" name="display_name" class="form-control" value="{{old('display_name')}}" placeholder="Role display name">
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <textarea name="description" class="form-control" placeholder="Role description here...">{{old('description')}}</textarea>
            </div>
        </div>
        <h4 style='text-align: center'>Permissions</h4>
        <div class="row" style="padding: 10px">
            <div class='col-md-8 col-md-offset-2'>
                @foreach($perms as $perm)
                <div class="col-md-2">
                    <label><input type='checkbox' name='perms[{{$perm->id}}]' {{old('perms')[$perm->id]? 'checked' : ''}} value='{{$perm->id}}'> {{$perm->display_name}}</label>
                </div>
                @endforeach
            </div>
        </div>
        <hr>
        <div class="row" style="padding: 10px">
            <div class="col-md-2 col-md-offset-5" style='text-align: center'>
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </form>
    <hr class="divider">
    <h3 style="text-align: center">Manage Existing Roles</h3>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role System Name</th>
                        <th>Role Display Name</th>
                        <th>Role Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td>{{$role->display_name}}</td>
                        <td>{{$role->description}}</td>
                        <td style="text-align: center">
                            <a href="{{url('role/edit/' . $role->id)}}" style="margin-right: 20px">Edit</a>
                            <a href="{{url('role/delete/' . $role->id)}}" style="margin-right: 20px">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection