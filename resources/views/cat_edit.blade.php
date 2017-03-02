@extends('layouts/app')

@section('content')
<div class="container-fluid">
    <h5 style="text-align: center"><a href='{{url('cat')}}'>Back to Categories</a></h5>
    <h3 style="text-align: center">Update Category "{{$cat->name}}"</h3>
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            @if(session('status') == 'nothing')
            <h5 class="alert alert-danger" style="text-align: center"> Something went wrong.</h5>
            @elseif(session('status') == 'updated')
            <h5 class="alert alert-success" style="text-align: center">Category Updated Successfully.</h5>
            @endif
        </div>
    </div>
    <form method="post" action="{{url('cat/save')}}">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$cat->id}}">
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <input type="text" name="name" class="form-control" value="{{$cat->name}}" placeholder="Category name">
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-2 col-md-offset-5">
                <a href="{{url('cat/delete/' . $cat->id)}}" class="btn btn-danger">Delete</a>
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </form>
    <hr class="divider">
</div>
@endsection