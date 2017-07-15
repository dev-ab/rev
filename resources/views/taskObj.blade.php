@extends('layouts/app')

@section('title', 'الأهداف')

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

                        <h4 style="text-align:center;"> اهداف المهام </h4>

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
                                <form id="" class="p-t-15" role="form" method="post" action="{{url('taskobj/save')}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" value="null">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class='row'>
                                                <div class='col-md-6 col-md-offset-3'>
                                                    @if(session('status') == 'nothing')
                                                    <h5 class="alert alert-danger" style="text-align: center"> خطأ فى انشاء الهدف</h5>
                                                    @elseif(session('status') == 'created')
                                                    <h5 class="alert alert-success" style="text-align: center">تم انشاء الهدف بنجاح</h5>
                                                    @elseif(session('status') == 'deleted')
                                                    <h5 class="alert alert-success" style="text-align: center">تم حذف الهدف بنجاح</h5>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-xs-12">
                                                <h5>ادخل اسم 
                                                    <span class="semi-bold">اهداف المهام</span>
                                                    الجديد للإنشاء
                                                </h5>
                                                <br>
                                            </div>
                                            <div class="col-xs-12">

                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group form-group-default">
                                                            <label>اسم الهدف</label>
                                                            <input type="text" name="name" value="{{old('name')}}" placeholder="" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group form-group-default">
                                                            <textarea name="description" class="form-control" style="min-height:110px;" placeholder="وصف الهدف">{{old('description')}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <select name='category_id' class="full-width select2-hidden-accessible" data-init-plugin="select2" tabindex="-1" aria-hidden="true">
                                                                <option value="">اختر تصنيف للهدف</option>
                                                                @foreach($cats as $cat)
                                                                <option value='{{$cat->id}}' {{old('category_id') == $cat->id? 'selected' : ''}}>{{$cat->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="checkbox check-success">
                                                    <input name="constant" type="checkbox" {{old('constant') > 0? 'checked': ''}} value="1" id="checkbox01">
                                                    <label for="checkbox01">هدف متكرر</label>
                                                </div>

                                            </div>


                                            <div class="col-xs-12">
                                                <button class="btn btn-primary btn-cons m-t-10" type="submit">إنشاء هدف مهام جديد  </button>
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
                                            <h5>استعراض وتعديل الأهداف</h5>
                                        </div>

                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <div id="condensedTable_wrapper" class="dataTables_wrapper form-inline no-footer">
                                                <table class="table  table-condensed dataTable no-footer" id="condensedTable" role="grid">
                                                    <thead>
                                                        <tr role="row">
                                                            <th style="width:10%" class="sorting" tabindex="0" aria-controls="condensedTable" rowspan="1" colspan="1">ID</th>
                                                            <th style="width:30%" class="sorting_asc" tabindex="0" aria-controls="condensedTable" rowspan="1" colspan="1">اسم الهدف</th>
                                                            <th style="width:30%" class="sorting_asc" tabindex="0" aria-controls="condensedTable" rowspan="1" colspan="1">وصف الهدف</th>
                                                            <th style="width:30%" class="sorting_asc" tabindex="0" aria-controls="condensedTable" rowspan="1" colspan="1">اسم التصنيف</th>
                                                            <th style="width:15%" class="sorting" tabindex="0" aria-controls="condensedTable" rowspan="1" colspan="1">التحكم</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($taskObjs as $taskObj)
                                                        <tr role="row">
                                                            <td class="v-align-middle semi-bold">{{$taskObj->id}}</td>
                                                            <td class="v-align-middle semi-bold">{{$taskObj->name}}</td>
                                                            <td class="v-align-middle semi-bold">{{$taskObj->description}}</td>
                                                            <td class="v-align-middle semi-bold">{{$taskObj->category? $taskObj->category->name : ''}}</td>
                                                            <td style="text-align: center">
                                                                <a onclick="confirmDel(event)" href="{{url('taskobj/delete/' . $taskObj->id)}}" type="button" class="btn btn-danger "><i class="fa fa-trash-o"></i></a>
                                                                <a href="{{url('taskobj/edit/' . $taskObj->id)}}" type="button" class="btn btn-success"><i class="fa fa-pencil"></i></a>
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