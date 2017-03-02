@extends('layouts/app')

@section('content')
<div class="container-fluid">
    <h3 style="text-align: center">Create New Category</h3>
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            @if(session('status') == 'nothing')
            <h5 class="alert alert-danger" style="text-align: center"> Something went wrong.</h5>
            @elseif(session('status') == 'created')
            <h5 class="alert alert-success" style="text-align: center">Category Created Successfully.</h5>
            @elseif(session('status') == 'deleted')
            <h5 class="alert alert-success" style="text-align: center">Category Deleted Successfully.</h5>

            @endif
        </div>
    </div>
    <form method="post" action="{{url('cat/save')}}">
        {{csrf_field()}}
        <input type="hidden" name="id" value="null">
        <div class="row" style="padding: 10px">
            <div class="col-md-6 col-md-offset-3">
                <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Category name">
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-2 col-md-offset-5" style='text-align: center'>
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </form>
    <hr class="divider">
    <h3 style="text-align: center">Manage Existing Categories</h3>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cats as $cat)
                    <tr>
                        <td>{{$cat->id}}</td>
                        <td>{{$cat->name}}</td>
                        <td style="text-align: center">
                            <a href="{{url('cat/edit/' . $cat->id)}}" style="margin-right: 20px">Edit</a>
                            <a href="{{url('cat/delete/' . $cat->id)}}" style="margin-right: 20px">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection