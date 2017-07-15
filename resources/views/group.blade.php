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

                        <h4 style="text-align:center;">تكوين مجموعات من اهداف المهام  </h4>

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
                                    @elseif(session('status') == 'created')
                                    <h5 class="alert alert-success" style="text-align: center">تم انشاء مجموعة الأهداف بنجاح</h5>
                                    @elseif(session('status') == 'deleted')
                                    <h5 class="alert alert-success" style="text-align: center">تم حذف مجموعة الأهداف بنجاح</h5>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <form id="" class="p-t-15" role="form" method="post" action="{{url('group/save')}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" value="null">
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
                                                            <input type="text" name="name" value="{{old('name')}}" placeholder="" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group form-group-default">
                                                            <textarea name="description" class="form-control" style="min-height:110px;" placeholder="وصف المجموعة">{{old('description')}}</textarea>
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
                                                            <input type="checkbox" name='objs[{{$obj->id}}]' {{old('objs')[$obj->id]? 'checked' : ''}} value='{{$obj->id}}' id="checkbox01">
                                                            <label for="checkbox01">{{$obj->name}}</label>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    @endforeach

                                                </div>
                                            </div>

                                            <div class="col-xs-12">
                                                <button class="btn btn-primary btn-cons m-t-10" type="submit">إنشاء مجموعة اهداف   </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-xs-12">
                                <br>
                                <!-- START PANEL -->
                                <div class="panel" style="margin-top:36px;">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h5>استعراض وتعديل مجموعات المهام</h5>
                                        </div>

                                    </div>


                                    <div class="panel-body">




                                        <div class="table-responsive">
                                            <div id="condensedTable_wrapper" class="dataTables_wrapper form-inline no-footer">
                                                <table class="table  table-condensed dataTable no-footer" id="condensedTable" role="grid">
                                                    <thead>
                                                        <tr role="row">
                                                            <th style="width:10%" class="sorting" tabindex="0" aria-controls="condensedTable" rowspan="1" colspan="1">ID</th>
                                                            <th style="width:20%" class="sorting_asc" tabindex="0" aria-controls="condensedTable" rowspan="1" colspan="1">اسم المجموعة</th>
                                                            <th style="width:30%" class="sorting_asc" tabindex="0" aria-controls="condensedTable" rowspan="1" colspan="1">وصف المجموعة</th>
                                                            <th style="width:15%" class="sorting" tabindex="0" aria-controls="condensedTable" rowspan="1" colspan="1">التحكم</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>


                                                        @foreach($groups as $group)
                                                        <tr role="row">
                                                            <td class="v-align-middle semi-bold">{{$group->id}}</td>
                                                            <td class="v-align-middle semi-bold">{{$group->name}}</td>
                                                            <td class="v-align-middle semi-bold">{{$group->description}}</td>
                                                            <td style="text-align: center">
                                                                <a onclick="confirmDel(event)" href="{{url('group/delete/' . $group->id)}}" type="button" class="btn btn-danger "><i class="fa fa-trash-o"></i></a>
                                                                <a href="{{url('group/edit/' . $group->id)}}" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END PANEL -->
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