@extends('layouts/app')

@section('title', 'تعديل الصلاحية')

@section('content')

<!-- START PAGE-CONTAINER -->
<div class="page-container ">


    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper ">

        <!-- START PAGE CONTENT -->
        <div class="content ">

            <!-- START JUMBOTRON -->
            <div class="jumbotron" data-pages="parallax">
                <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                    <div class="inner">
                        <h5 style="text-align: center"><a href='{{url('role')}}'>عوده الى الصلاحيات</a></h5>
                        <h4 style="text-align:center;">تعديل الصلاحية "{{$role->display_name}}"</h4>

                    </div>
                </div>
            </div>
            <!-- END JUMBOTRON -->

            <!-- START CONTAINER FLUID -->
            <div class="container-fluid container-fixed-lg">
                <!-- BEGIN PlACE PAGE CONTENT HERE -->


                <div class=" full-height sm-p-t-30">

                    <div class="container-sm-height full-height">

                        <div class="row row-sm-height">


                            <div class="col-xs-12">

                                <form id="" class="p-t-15" role="form"  method="post" action="{{url('role/save')}}">
                                    <div class="panel panel-default">

                                        {{csrf_field()}}
                                        <input type="hidden" name="id" value="{{$role->id}}">
                                        <div class="panel-body">

                                            <div class='row'>
                                                <div class='col-md-6 col-md-offset-3'>
                                                    @if(session('status') == 'nothing')
                                                    <h5 class="alert alert-danger" style="text-align: center"> خطأ فى تعديل الصلاحية</h5>
                                                    @elseif(session('status') == 'updated')
                                                    <h5 class="alert alert-success" style="text-align: center">تم تعديل الصلاحيه بنجاح</h5>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-xs-12">

                                                <h5>ادخل معلومات 
                                                    <span class="semi-bold">مجموعة الصلاحيات </span>
                                                    الجديدة لانشائها
                                                </h5>
                                                <br>
                                            </div>
                                            <div class="col-xs-12 col-md-6">

                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group form-group-default">
                                                            <label>اسم مجموعة الصلاحيات - بالعربية</label>
                                                            <input type="text" name="display_name" class="form-control" value="{{$role->display_name}}" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group form-group-default">
                                                            <label>اسم مجموعة الصلاحيات - بالانجليزية</label>
                                                            <input type="text" name="name"  value="{{ucwords(str_replace('_', ' ',$role->name))}}" class="form-control" required>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group form-group-default">
                                                            <textarea name="description" style="min-height:110px;" class="form-control" placeholder="وصف مجموعة الصلاحيات">{{$role->description}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-xs-12 col-md-6">
                                                <div class="col-sm-12">
                                                    @foreach($perms as $perm)
                                                    <div style="margin-top:10px;margin-bottom:10px;" class="checkbox check-success col-sm-4">
                                                        <input type="checkbox" id="checkbox{{$perm->id}}"  name='perms[{{$perm->id}}]' {{in_array($perm->id, $role->perms->pluck('id')->toArray())? 'checked' : ''}} value='{{$perm->id}}'>
                                                        <label for="checkbox{{$perm->id}}">{{$perm->display_name}}</label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                                <button class="btn btn-primary btn-cons m-t-10" type="submit">حفظ</button>
                                                <a onclick="confirmDel(event)" href="{{url('role/delete/' . $role->id)}}" class="btn btn-danger btn-cons m-t-10">حذف</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PLACE PAGE CONTENT HERE -->
            </div>
            <!-- END CONTAINER FLUID -->
        </div>
        <!-- END PAGE CONTENT -->
    </div>
    <!-- END PAGE CONTENT WRAPPER -->
</div>
@endsection


@section('js')
<script>
    function confirmDel(e) {
        console.log(e)
        console.log('here');
        e.preventDefault();
        if (confirm('هل انت متأكد من الحذف؟'))
            window.location = e.target.href;
    }
</script>
@endsection