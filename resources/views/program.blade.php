@extends('layouts/app')

@section('title', 'انشاء برنامج مراجعه')

@section('content')
<!-- START PAGE-CONTAINER -->
<div class="page-container" ng-controller="ProgramController">
    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper ">

        <!-- START PAGE CONTENT -->
        <div class="content ">

            <!-- START JUMBOTRON -->
            <div class="jumbotron" data-pages="parallax">
                <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                    <div class="inner">

                        <h4 ng-show="program" style="text-align:center;">تعديل برنامج المراجعة <span ng-bind='"(" + program.name + ")"'></span></h4>
                        <h4 ng-hide="program" style="text-align:center;">إنشاء
                            <span class="semi-bold">  برنامج مراجعة   </span> جديد
                        </h4>
                    </div>
                </div>
            </div>
            <!-- END JUMBOTRON -->

            <!-- START CONTAINER FLUID -->
            <div class="container-fluid container-fixed-lg">
                <div ng-if="errors.length" class="row">
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
                        تم حفظ البرنامج بنجاح</div>
                </div>
                <!-- BEGIN PlACE PAGE CONTENT HERE -->
                <div class=" full-height sm-p-t-30 p-b-100">

                    <div class="container-sm-height full-height">

                        <div class="row row-sm-height">

                            <div class="col-xs-12">
                                <form id="program_form" class="p-t-15" role="form" method="post" action="">
                                    <input type="hidden" name="id" ng-value="id">

                                    <!-- START PANEL -->
                                    <div class="panel panel-default">
                                        <div class="panel-body">

                                            <div class="col-xs-12">

                                                <h5>ادخل
                                                    <span class="semi-bold">معلومات </span> برنامج المراجعة
                                                </h5>
                                                <br>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>الاسم البرنامج</label>
                                                    <input type="text" name="name" ng-value="program.name" placeholder="" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>عنوان فرعى لبرنامج المراجعة</label>
                                                    <input type="text" name="title" ng-value="program.title" placeholder="" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <select class="full-width select2-hidden-accessible" data-init-plugin="select2" tabindex="-1" aria-hidden="true">
                                                        <option value="AK">اختر ورقة العمل (حساب ميزان المراجعة )</option>
                                                        <option value="HI">Hawaii</option>
                                                        <option value="CA">California</option>
                                                        <option value="NV">Nevada</option>
                                                        <option value="OR">Oregon</option>
                                                        <option value="WA">Washington</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PANEL -->
                                    <!-- START PANEL -->
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="col-xs-12">

                                                <h5>ادخل
                                                    <span class="semi-bold">أهداف </span> برنامج المراجعة
                                                </h5>
                                                <br>
                                            </div>
                                            <div class="col-xs-12" ng-repeat="obj in objs">
                                                <div class="form-group form-group-default pull-left" style="width:90%; ">
                                                    <input type="hidden" name="objs[@{{$index}}][id]" ng-value='obj.id'>
                                                    <input type="text" name="objs[@{{$index}}][description]" ng-value='obj.description' placeholder="أدخل هدف مراجعة جديد " class="form-control" required="">
                                                </div>
                                                <button ng-click="addObj()" ng-show="$index === (objs.length - 1)" type="button" class="btn btn-tag  btn-success  pull-right" style="width:10%;">إضافة</button>
                                                <button ng-click="rmObj($index)" ng-hide="$index === (objs.length - 1)" type="button" class="btn btn-tag  btn-danger  pull-right" style="width:10%;">حذف</button>
                                            </div>

                                            <div class="col-xs-12">
                                                <a href="" ng-click="processProgram()" ng-hide="program || processing" class="btn btn-primary btn-cons m-t-10" >إنشاء برنامج المراجعة </a>
                                                <a href="" ng-click="processProgram()" ng-show="program && !processing" class="btn btn-primary btn-cons m-t-10">تعديل برنامج المراجعة </a>
                                                <div id="processing" class="panel-body text-center" ng-show="processing">
                                                    <img class="image-responsive-height demo-mw-50" src="{{url('/')}}/assets/img/demo/progress.svg" alt="Progress">
                                                </div>
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
<script src="{{url('/')}}/js/controllers/ProgramController.js" type="text/javascript"></script>
@endsection