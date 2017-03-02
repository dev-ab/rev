@extends('layouts/app')

@section('content')
<div class="container-fluid">
    <h5 style="text-align: center"><a href='{{url('role')}}'>Back to Roles</a></h5>
    <h3 style="text-align: center">Update Role "{{$role->display_name}}"</h3>
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            @if(session('status') == 'nothing')
            <h5 class="alert alert-danger" style="text-align: center"> Something went wrong.</h5>
            @elseif(session('status') == 'updated')
            <h5 class="alert alert-success" style="text-align: center">Role Updated Successfully.</h5>
            @endif
        </div>
    </div>
    <form method="post" action="{{url('role/save')}}">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$role->id}}">
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <input type="text" name="name" class="form-control" value="{{$role->name}}" placeholder="Role System name">
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <input type="text" name="display_name" class="form-control" value="{{$role->display_name}}" placeholder="Role display name">
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <textarea name="description" class="form-control" placeholder="Role description here...">{{$role->description}}</textarea>
            </div>
        </div>
        <h4 style='text-align: center'>Permissions</h4>
        <div class="row" style="padding: 10px">
            <div class='col-md-8 col-md-offset-2'>
                @foreach($perms as $perm)
                <div class="col-md-2">
                    <label><input type='checkbox' name='perms[{{$perm->id}}]' {{in_array($perm->id, $role->perms->pluck('id')->toArray())? 'checked' : ''}} value='{{$perm->id}}'> {{$perm->display_name}}</label>
                </div>
                @endforeach
            </div>
        </div>
        <hr>
        <div class="row" style="padding: 10px">
            <div class="col-md-2 col-md-offset-5">
                <a href="{{url('role/delete/' . $role->id)}}" class="btn btn-danger">Delete</a>
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </form>
    <hr class="divider">
</div>
@endsection