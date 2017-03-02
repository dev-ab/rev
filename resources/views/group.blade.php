@extends('layouts/app')

@section('content')
<div class="container-fluid">
    <h3 style="text-align: center">Create New Group</h3>
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            @if(session('status') == 'nothing')
            <h5 class="alert alert-danger" style="text-align: center"> Something went wrong.</h5>
            @elseif(session('status') == 'created')
            <h5 class="alert alert-success" style="text-align: center">Group Created Successfully.</h5>
            @elseif(session('status') == 'deleted')
            <h5 class="alert alert-success" style="text-align: center">Group Deleted Successfully.</h5>
            @endif
        </div>
    </div>
    <form method="post" action="{{url('group/save')}}">
        {{csrf_field()}}
        <input type="hidden" name="id" value="null">
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Group name">
            </div>
        </div>
        <h4 style='text-align: center'>Select Tasks Objectives for this Group</h4>
        <div class="row" style="padding: 10px">
            <div class='col-md-8 col-md-offset-2'>
                @foreach($objectives as $col)
                <div class='row' style='margin-bottom: 15px;'>
                    <h5 style='font-weight: bold;'>{{$col[0]->category->name}}</h5>
                    @foreach($col as $obj)
                    <div class="col-md-3">
                        <label><input type='checkbox' name='objs[{{$obj->id}}]' {{old('objs')[$obj->id]? 'checked' : ''}} value='{{$obj->id}}'> {{$obj->name}}</label>
                    </div>
                    @endforeach
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
    <h3 style="text-align: center">Manage Existing Groups</h3>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Group Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groups as $group)
                    <tr>
                        <td>{{$group->id}}</td>
                        <td>{{$group->name}}</td>
                        <td style="text-align: center">
                            <a href="{{url('group/edit/' . $group->id)}}" style="margin-right: 20px">Edit</a>
                            <a href="{{url('group/delete/' . $group->id)}}" style="margin-right: 20px">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection