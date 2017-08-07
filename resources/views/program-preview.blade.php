@extends('layouts/app')

@section('title', 'استعراض برامج المراجعه')

@section('content')
<!-- START PAGE-CONTAINER -->
<div class="page-container" ng-controller="ClientController">
    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper ">

        <!-- START PAGE CONTENT -->
        <div class="content ">

            <!-- START JUMBOTRON -->
            <div class="jumbotron" data-pages="parallax">
                <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                    <div class="inner">

                        <h4 style="text-align:center;">
                            استعراض برامج المراجعه
                        </h4>

                    </div>
                </div>
            </div>
            <!-- END JUMBOTRON -->

            <!-- START CONTAINER FLUID -->
            <div class="container-fluid container-fixed-lg">
                <!-- BEGIN PlACE PAGE CONTENT HERE -->
                @if(session('status') == 'deleted')
                <h5 class="alert alert-success" style="text-align: center">تم حذف البرنامج بنجاح</h5>
                @endif
                <div>
                    <a href="/program/create" style="margin-right: 100px" class="btn btn-success"><i class="fa fa-plus"></i> اضافة برنامج مراجعه جديد</a>
                </div>
                <div class="panel panel-transparent">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div id="condensedTable_wrapper" class="dataTables_wrapper form-inline no-footer">
                                <table class="table  table-condensed dataTable no-footer" id="condensedTable" role="grid">
                                    <thead>
                                        <tr role="row">

                                            <th style="width:30%" class="sorting" tabindex="0" aria-controls="condensedTable" rowspan="1" colspan="1">اسم البرنامج</th>
                                            <th style="width:30%" class="sorting" tabindex="0" aria-controls="condensedTable" rowspan="1" colspan="1">وصف الرنامج</th>
                                            <th style="width:15%" class="sorting" tabindex="0" aria-controls="condensedTable" rowspan="1" colspan="1">ورقة العمل</th>
                                            <th style="width:15%" rowspan="1" colspan="1">التحكم</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($programs as $program)
                                        <tr role="row">
                                            <td class="v-align-middle semi-bold">{{$program->name}}</td>
                                            <td class="v-align-middle sorting_1">{{$program->title}}</td>
                                            <td class="v-align-middle semi-bold">{{$program->title}}</td>
                                            <td>
                                                <a class="btn btn-success" href="/program/edit/{{$program->id}}" title="تعديل"><i class="fa fa-pencil"></i></a>
                                                <a class="btn btn-danger" href="#" onclick="confirmDel({{$program->id}})" title="حذف"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
<!-- END PAGE-CONTAINER -->

@endsection

@section('js')
<!-- BEGIN PAGE LEVEL JS -->
<script src="{{url('/')}}/assets/plugins/jquery-datatable/media/js/jquery.dataTables.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js" type="text/javascript"></script>
<script type="text/javascript" src="{{url('/')}}/assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
<script type="text/javascript" src="{{url('/')}}/assets/plugins/datatables-responsive/js/lodash.min.js"></script>
<script src="{{url('/')}}/assets/js/datatables.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/js/scripts.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->

<script>
    function confirmDel(id){
    if (!confirm('هل أنت متأكد من الحذف؟'))
            return;
    window.location = '/program/delete/' + id;
    }
</script>
@endsection
