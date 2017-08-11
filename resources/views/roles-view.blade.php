@extends('layouts/app')

@section('title', 'الصلاحيات')

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

                        <h4 style="text-align:center;">أدوار وصلاحيات المستخدمين </h4>

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
                                <br>
                                <div>
                                    <a href="/role" style="margin-right: 100px" class="btn btn-success"><i class="fa fa-plus"></i> اضافة مجموعة صلاحيات</a>
                                </div>
                                <!-- START PANEL -->
                                <div class="panel" style="margin-top:36px;">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h5>استعراض وتعديل مجموعات الصلاحيات</h5>
                                        </div>

                                    </div>

                                    <div class="panel-body">
                                        <div class='row'>
                                            <div class='col-md-6 col-md-offset-3'>
                                                @if(session('status') == 'nothing')
                                                <h5 class="alert alert-danger" style="text-align: center"> خطأ فى انشاء مجموعة الصلاحيات</h5>
                                                @elseif(session('status') == 'created')
                                                <h5 class="alert alert-success" style="text-align: center">تم انشاء مجموعة الصلاحيات بنجاح</h5>
                                                @elseif(session('status') == 'deleted')
                                                <h5 class="alert alert-success" style="text-align: center">تم حذف مجموعة الصلاحيات بنجاح</h5>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <div id="condensedTable_wrapper" class="dataTables_wrapper form-inline no-footer">
                                                <table class="table  table-condensed dataTable no-footer" id="condensedTable" role="grid">
                                                    <thead>
                                                        <tr role="row">
                                                            <th style="width:25%" class="sorting" tabindex="0" aria-controls="condensedTable" rowspan="1" colspan="1">اسم مجموعة الصلاحيات بالعربية</th>
                                                            <th style="width:25%" class="sorting_asc" tabindex="0" aria-controls="condensedTable" rowspan="1" colspan="1">اسم مجموعة الصلاحيات بالانجليزية</th>
                                                            <th style="width:30%" class="sorting" tabindex="0" aria-controls="condensedTable" rowspan="1" colspan="1">وصف مجموعة الصلاحيات</th>
                                                            <th style="width:20%" class="sorting" tabindex="0" aria-controls="condensedTable" rowspan="1" colspan="1">التحكم بمجموعة الصلاحيات</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>


                                                        @foreach($roles as $role)
                                                        <tr>
                                                            <td class="v-align-middle semi-bold">{{$role->display_name}}</td>
                                                            <td class="v-align-middle sorting_1">{{ucwords(str_replace('_', ' ',$role->name))}}</td>
                                                            <td class="v-align-middle semi-bold">{{$role->description}}</td>
                                                            <td style="text-align: center">
                                                                <a onclick="confirmDel(event)" href="{{url('role/delete/' . $role->id)}}" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                                                <a href="{{url('role/edit/' . $role->id)}}" class="btn btn-success"><i class="fa fa-pencil"></i></a>
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