@extends('layouts/app')

@section('title', 'إنشاء مجموعة خيارات لبرامج المراجعة')

@section('content')
<!-- START PAGE-CONTAINER -->
<div class="page-container" ng-controller="GroupController">
    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper ">

        <!-- START PAGE CONTENT -->
        <div class="content ">

            <!-- START JUMBOTRON -->
            <div class="jumbotron" data-pages="parallax">
                <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                    <div class="inner">

                        <h4 ng-show="group" style="text-align:center;">تعديل مجموعة خيارات <span ng-bind='"(" + group.name + ")"'></span></h4>
                        <h4 ng-hide="group" style="text-align:center;">إنشاء
                            <span class="semi-bold">  مجموعة خيارات    </span> لبرامج المراجعة
                        </h4>
                    </div>
                </div>
            </div>
            <!-- END JUMBOTRON -->

            <!-- START CONTAINER FLUID -->
            <div class="container-fluid container-fixed-lg">
                <div ng-show="errors.length" class="row">
                    <div class="alert alert-danger alert-dismissable col-md-6">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <ul>
                            <li ng-repeat="error in errors" ng-bind="error"></li>
                        </ul>
                    </div>
                </div>
                <div id="success" ng-show="success" class="row">
                    <div class="alert alert-success alert-dismissable col-md-6">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        تم حفظ مجموعة الخيارات بنجاح</div>
                </div>
                <!-- BEGIN PlACE PAGE CONTENT HERE -->
                <div class=" full-height sm-p-t-30 p-b-100">
                    <div class="container-sm-height full-height">
                        <div class="row row-sm-height">
                            <div class="col-xs-12">
                                <form id="group_form" class="p-t-15" role="form" action="">
                                    <input type="hidden" name="id" ng-value="id">

                                    <!-- START PANEL -->
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="col-xs-12">

                                                <h5>ادخل
                                                    <span class="semi-bold">معلومات </span> مجموعة الخيارات
                                                </h5>
                                                <br>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>اسم المجموعة</label>
                                                    <input type="text" name="name" ng-value="group.name" placeholder="" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                                <div class="form-group form-group-default">
                                                    <textarea name="description" ng-bind="group.description" class="form-control" style="min-height:60px;" placeholder="ملحوظات على المجموعة"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PANEL -->

                                    <!-- START PANEL -->
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="col-xs-12">

                                                <h5>اختر مجموعة من
                                                    <span class="semi-bold">الخيارات </span> لحفظها واستخدامها فى انشاء المراجعات لاحقاً
                                                </h5>
                                                <br>
                                            </div>



                                            <div class="col-xs-12" ng-repeat="program in programs">
                                                <div class="panel panel-default" data-pages="portlet">
                                                    <div class="panel-heading separator">
                                                        <div class="panel-title">
                                                            <h4 class="text-primary semi-bold" ng-bind="program.name"></h4>
                                                            <div class="checkbox check-success  ">
                                                                <input ng-click="selectAll(program.id, $event)" type="checkbox" value="1" id="b@{{$index + 1}}">
                                                                <label for="b@{{$index + 1}}">اختيار البرنامج بالكامل</label>
                                                            </div>
                                                        </div>
                                                        <div class="panel-controls">
                                                            <ul>
                                                                <li><a data-toggle="collapse" class="portlet-collapse" href="#"><i class="pg-arrow_maximize"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="checkbox check-success" ng-repeat="obj in program.objs">
                                                            <input name="objs[@{{program.id}}][]" ng-value="obj.id" type="checkbox" ng-checked="objs_ids.indexOf(obj.id) > -1" id="b@{{$parent.$index + 1}}@{{$index + 1}}">
                                                            <label for="b@{{$parent.$index + 1}}@{{$index + 1}}" ng-bind="obj.description"></label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                                <a href="" ng-click="processGroup()" class="btn btn-primary btn-cons m-t-10">حفظ مجموعة الخيارات </a>
                                            </div>
                                        </div>

                                    </div>
                                </form>



                            </div>
                        </div>
                    </div>
                    <!-- END PLACE PAGE CONTENT HERE -->
                </div>
                <!-- END CONTAINER FLUID -->
            </div>

        </div>
        <!-- END PAGE CONTENT -->

    </div>
    <!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE-CONTAINER -->
@endsection

@section('js')
<script src="{{url('/')}}/js/angular.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/js/myapp.js" type="text/javascript"></script>
<script src="{{url('/')}}/js/controllers/GroupController.js" type="text/javascript"></script>
@endsection