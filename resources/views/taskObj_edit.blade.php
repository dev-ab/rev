@extends('layouts/app')

@section('content')
<div class="container-fluid">
    <h5 style="text-align: center"><a href='{{url('taskobj')}}'>Back to Task Objectives</a></h5>
    <h3 style="text-align: center">Update Task Objective "{{$taskObj->name}}"</h3>
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            @if(session('status') == 'nothing')
            <h5 class="alert alert-danger" style="text-align: center"> Something went wrong.</h5>
            @elseif(session('status') == 'updated')
            <h5 class="alert alert-success" style="text-align: center">Task Objective Updated Successfully.</h5>
            @endif
        </div>
    </div>
    <form method="post" action="{{url('taskobj/save')}}">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$taskObj->id}}">
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <input type="text" name="name" class="form-control" value="{{$taskObj->name}}" placeholder="Task Objective Name">
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <textarea name="description" class="form-control" placeholder="Task Objective Description">{{$taskObj->description}}</textarea>
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <select name='category_id' class='form-control'>
                    <option value=''>Select Category...</option>
                    @foreach($cats as $cat)
                    <option value='{{$cat->id}}' {{$taskObj->category->id == $cat->id? 'selected' : ''}}>{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <label><input type="checkbox" {{$taskObj->constant > 0? 'checked': ''}} name="constant" value="1"> This objective is recurring</label>
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-2 col-md-offset-5" style='text-align: center'>
                <a href="{{url('taskobj/delete/' . $taskObj->id)}}" class="btn btn-danger">Delete</a>
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </form>
    <hr class="divider">
</div>
@endsection