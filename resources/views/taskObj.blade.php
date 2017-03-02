@extends('layouts/app')

@section('content')
<div class="container-fluid">
    <h3 style="text-align: center">Create New Task Objective</h3>
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            @if(session('status') == 'nothing')
            <h5 class="alert alert-danger" style="text-align: center"> Something went wrong.</h5>
            @elseif(session('status') == 'created')
            <h5 class="alert alert-success" style="text-align: center">Task Objective Created Successfully.</h5>
            @elseif(session('status') == 'deleted')
            <h5 class="alert alert-success" style="text-align: center">Task Objective Deleted Successfully.</h5>
            @endif
        </div>
    </div>
    <form method="post" action="{{url('taskobj/save')}}">
        {{csrf_field()}}
        <input type="hidden" name="id" value="null">
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Task Objective Name">
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <textarea name="description" class="form-control" placeholder="Task Objective Description">{{old('description')}}</textarea>
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <select name='category_id' class='form-control'>
                    <option value=''>Select Category...</option>
                    @foreach($cats as $cat)
                    <option value='{{$cat->id}}' {{old('category_id') == $cat->id? 'selected' : ''}}>{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <label><input type="checkbox" {{old('constant') > 0? 'checked': ''}} name="constant" value="1"> This objective is recurring</label>
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-2 col-md-offset-5" style='text-align: center'>
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </form>
    <hr class="divider">
    <h3 style="text-align: center">Manage Existing Task Objectives</h3>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Task Objective Name</th>
                        <th>Task Objective Description</th>
                        <th>Category</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taskObjs as $taskObj)
                    <tr>
                        <td>{{$taskObj->id}}</td>
                        <td>{{$taskObj->name}}</td>
                        <td>{{$taskObj->description}}</td>
                        <td>{{$taskObj->category->name}}</td>
                        <td style="text-align: center">
                            <a href="{{url('taskobj/edit/' . $taskObj->id)}}" style="margin-right: 20px">Edit</a>
                            <a href="{{url('taskobj/delete/' . $taskObj->id)}}" style="margin-right: 20px">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection