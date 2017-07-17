@extends('layouts/app')

@section('title', 'انشاء حساب عميل جديد')

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
                            استعراض حسابات العملاء
                        </h4>

                    </div>
                </div>
            </div>
            <!-- END JUMBOTRON -->

            <!-- START CONTAINER FLUID -->
            <div class="container-fluid container-fixed-lg">
                <!-- BEGIN PlACE PAGE CONTENT HERE -->
                @if(session('status') == 'deleted')
                <h5 class="alert alert-success" style="text-align: center">تم حذف العميل بنجاح</h5>
                @endif
                <div>
                    <a href="/client/create" style="margin-right: 100px" class="btn btn-success"><i class="fa fa-plus"></i> اضافة عميل جديد</a>
                </div>
                <div class="panel panel-transparent">
                    <div class="panel-heading">

                        <div class="col-xs-12">
                            <input type="text" id="search-table" class="form-control pull-right" placeholder="البحث">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover demo-table-search" id="tableWithSearch">
                            <thead>
                                <tr>
                                    <th>اسم العميل</th>
                                    <th>نشاط العميل</th>
                                    <th>نوع الشركة / المؤسسة</th>
                                    <th>المعاملة الزكوية</th>
                                    <th>رقم الهاتف</th>
                                    <th style="width: 12%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                <tr>
                                    <td class="v-align-middle semi-bold">
                                        <p>{{$client->company_name}}</p>
                                    </td>
                                    <td class="v-align-middle">
                                        <p>{{$client->company_activity}}</p>
                                    </td>
                                    <td class="v-align-middle">
                                        <p>{{$types[$client->company_type]}}</p>
                                    </td>
                                    <td class="v-align-middle">
                                        <p>{{$zakkat[$client->company_zakkat]}}</p>
                                    </td>
                                    <td class="v-align-middle">
                                        <p>{{$client->contacts[0]->data}}</p>
                                    </td>
                                    <td>
                                        <a class="btn btn-success" href="/client/edit/{{$client->id}}" title="تعديل"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger" href="#" onclick="confirmDel({{$client->id}})" title="حذف"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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

<!-- START OVERLAY -->
<div class="overlay hide" data-pages="search">
    <!-- BEGIN Overlay Content !-->
    <div class="overlay-content has-results m-t-20">
        <!-- BEGIN Overlay Header !-->
        <div class="container-fluid">
            <!-- BEGIN Overlay Logo !-->
            <img class="overlay-brand" src="assets/img/logo.png" alt="logo" data-src="assets/img/logo.png" data-src-retina="assets/img/logo_2x.png" width="78" height="22">
            <!-- END Overlay Logo !-->
            <!-- BEGIN Overlay Close !-->
            <a href="#" class="close-icon-light overlay-close text-black fs-16">
                <i class="pg-close"></i>
            </a>
            <!-- END Overlay Close !-->
        </div>
        <!-- END Overlay Header !-->
        <div class="container-fluid">
            <!-- BEGIN Overlay Controls !-->
            <input id="overlay-search" class="no-border overlay-search bg-transparent" placeholder="ادخل كلمات البحث هنا" autocomplete="off" spellcheck="false">
            <br>

            <div class="inline-block m-l-10">
                <p class="fs-13">اضغط ادخال للبحث</p>
            </div>
            <!-- END Overlay Controls !-->
        </div>
        <!-- BEGIN Overlay Search Results, This part is for demo purpose, you can add anything you like !-->
        <div class="container-fluid">

            <span id="overlay-suggestions"></span>
            <br>
            <div class="search-results m-t-40">
                <p class="bold">نتائج البحث</p>
                <div class="row">
                    <div class="col-md-6">
                        <!-- BEGIN Search Result Item !-->
                        <div class="">
                            <!-- BEGIN Search Result Item Thumbnail !-->
                            <div class="thumbnail-wrapper d48 circular bg-success text-white inline m-t-10">
                                <div>
                                    <img width="50" height="50" src="assets/img/profiles/avatar.jpg" data-src="assets/img/profiles/avatar.jpg" data-src-retina="assets/img/profiles/avatar2x.jpg" alt="">
                                </div>
                            </div>
                            <!-- END Search Result Item Thumbnail !-->
                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5"><span class="semi-bold result-name">عبد الرحمن محمد </span> من العملاء</h5>
                                <p class="hint-text">اى محتوى اخر او تفاصيل هنا</p>
                            </div>
                        </div>
                        <!-- END Search Result Item !-->

                        <!-- BEGIN Search Result Item !-->
                        <div class="">
                            <!-- BEGIN Search Result Item Thumbnail !-->
                            <div class="thumbnail-wrapper d48 circular bg-success text-white inline m-t-10">
                                <div>س</div>
                            </div>
                            <!-- END Search Result Item Thumbnail !-->
                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5"><span class="semi-bold result-name">كريم عبد الحكيم</span> من الموظفين</h5>
                                <p class="hint-text">ى محتوى اخر او تفاصيل هنا</p>
                            </div>
                        </div>
                        <!-- END Search Result Item !-->


                        <!-- BEGIN Search Result Item !-->
                        <div class="">
                            <!-- BEGIN Search Result Item Thumbnail !-->
                            <div class="thumbnail-wrapper d48 circular bg-success text-white inline m-t-10">
                                <div>س</div>
                            </div>
                            <!-- END Search Result Item Thumbnail !-->
                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5"><span class="semi-bold result-name">التحقق من امر ما </span> من المهام</h5>
                                <p class="hint-text">ى محتوى اخر او تفاصيل هنا</p>
                            </div>
                        </div>
                        <!-- END Search Result Item !-->



                    </div>

                </div>
            </div>
        </div>
        <!-- END Overlay Search Results !-->
    </div>
    <!-- END Overlay Content !-->
</div>
<!-- END OVERLAY -->
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
    window.location = '/client/delete/' + id;
    }
</script>
@endsection