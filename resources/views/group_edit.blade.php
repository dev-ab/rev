@extends('layouts/app')

@section('title', 'مجموعات الأهداف')

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

                        <h5 style="text-align: center"><a href='{{url('group')}}'>العودة الى مجموعات الأهداف</a></h5>
                        <h3 style="text-align: center">تعديل مجموعة الأهداف "{{$group->name}}"</h3>

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

                            <div class='row'>
                                <div class='col-md-6 col-md-offset-3'>
                                    @if(session('status') == 'nothing')
                                    <h5 class="alert alert-danger" style="text-align: center"> خطأ فى العملية</h5>
                                    @elseif(session('status') == 'updated')
                                    <h5 class="alert alert-success" style="text-align: center">تم تعديل مجموعة الأهداف بنجاح</h5>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <form id="" class="p-t-15" role="form" method="post" action="{{url('group/save')}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" value="{{$group->id}}">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="col-xs-12">

                                                <h5>ادخل اسم 
                                                    <span class="semi-bold">مجموعة الاهداف </span>
                                                    الجديد للإنشاء
                                                </h5>
                                                <br>
                                            </div>
                                            <div class="col-xs-12">

                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group form-group-default">
                                                            <label>اسم المجموعة</label>
                                                            <input type="text" name="name" value="{{$group->name}}" placeholder="" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group form-group-default">
                                                            <textarea name="description" class="form-control" style="min-height:110px;" placeholder="وصف المجموعة">{{$group->description}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4>اختر أهداف المهام</h4>
                                                <div class="row">
                                                    @foreach($objectives as $col)
                                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                                        <h5>{{$col[0]->category->name}}</h5>
                                                        @foreach($col as $obj)
                                                        <div class="checkbox check-success">
                                                            <input type="checkbox" name='objs[{{$obj->id}}]' {{in_array($obj->id, $group->objectives->pluck('id')->toArray())? 'checked' : ''}} value='{{$obj->id}}' id="checkbox01">
                                                            <label for="checkbox01">{{$obj->name}}</label>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    @endforeach

                                                </div>
                                            </div>

                                            <div class="col-xs-12">
                                                <button class="btn btn-primary btn-cons m-t-10" type="submit">حفظ</button>
                                                <a onclick="confirmDel(event)" href="{{url('group/delete/' . $group->id)}}" class="btn btn-danger btn-cons m-t-10">حذف</a>
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