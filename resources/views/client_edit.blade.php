@extends('layouts/app')

@section('content')
<div class="container-fluid">
    <h5 style="text-align: center"><a href='{{url('group')}}'>Back to Groups</a></h5>
    <h3 style="text-align: center">Update Group "{{$group->name}}"</h3>
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            @if(session('status') == 'nothing')
            <h5 class="alert alert-danger" style="text-align: center"> Something went wrong.</h5>
            @elseif(session('status') == 'updated')
            <h5 class="alert alert-success" style="text-align: center">Group Updated Successfully.</h5>
            @endif
        </div>
    </div>
    <form method="post" action="{{url('group/save')}}">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$group->id}}">
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <input type="text" name="name" class="form-control" value="{{$group->name}}" placeholder="Group name">
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
                        <label><input type='checkbox' name='objs[{{$obj->id}}]' {{in_array($obj->id, $group->objectives->pluck('id')->toArray())? 'checked' : ''}} value='{{$obj->id}}'> {{$obj->name}}</label>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
        <hr>
        <div class="row" style="padding: 10px">
            <div class="col-md-2 col-md-offset-5">
                <a href="{{url('group/delete/' . $group->id)}}" class="btn btn-danger">Delete</a>
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </form>
    <hr class="divider">
</div>
@endsection