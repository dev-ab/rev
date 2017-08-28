@extends('layouts/app')

@section('title', 'البيانات الماليه')

@section('content')
<style>
    .table-center { line-height: 35px !important;}
    .input-font{font-size: 13px !important;width:100% !important;padding:0 !important;}
</style>
<!-- START PAGE-CONTAINER -->
<div class="page-container" ng-controller="BalanceController">
    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper ">

        <!-- START PAGE CONTENT -->
        <div class="content ">

            <!-- START JUMBOTRON -->
            <div class="jumbotron" data-pages="parallax">
                <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                    <div class="inner">

                        <h4 style="text-align:center;">العميل "<span ng-bind="client.company_name"></span>"
                            <br>
                            <span class="small " style="color:#10cfbd;">المعلومات المالية</span>
                        </h4>

                    </div>
                </div>
            </div>
            <!-- END JUMBOTRON -->

            <!-- START CONTAINER FLUID -->
            <div class="container-fluid container-fixed-lg">
                <!-- BEGIN PlACE PAGE CONTENT HERE -->


                <div class="panel panel-white">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h5 style="">
                                ميزان المراجعة الخاص بالعميل
                                <span class="semi-bold text-primary" ng-bind="client.company_name"></span> عن السنه الماليه
                                <span class="semi-bold text-primary" ng-bind="client.company_financial_year"></span>
                            </h5>

                        </div>


                    </div>
                    <div class="panel-body">
                        <div id="tableWithSearch_wrapper" class="dataTables_wrapper form-inline no-footer">
                            <div class="table-responsive">

                                <table class="table dataTable no-footer text-black" role="grid" aria-describedby="tableWithSearch_info" border="1">
                                    <style>
                                        .table thead tr th {
                                            text-align: center !important;
                                        }

                                    </style>
                                    <thead>
                                        <tr role="row" class="bg-primary text-white">
                                            <th colspan="1" rowspan="2" style="width:4% !important;">رقم الحساب</th>
                                            <th colspan="1" rowspan="2" style="width:16% !important;">اسم الحساب</th>
                                            <th colspan="2" rowspan="1" style="width:16%;">الارصدة الافتتاحية</th>
                                            <th colspan="2" rowspan="1" style="width:16%;">حركة الفترة</th>
                                            <th colspan="2" rowspan="1" style="width:16%;">مجاميع الفترة </th>
                                            <th colspan="2" rowspan="1" style="width:13.5%;">الرصيد النهائى</th>
                                            <th colspan="1" rowspan="2" style="width:3.5%;">المطابقة</th>
                                            <th colspan="1" rowspan="2" style="width:7.5%;">بعد المراجعة</th>
                                            <th colspan="1" rowspan="2" style="width:7.5%;">الفرق</th>

                                        </tr>
                                        <tr role="row" class="bg-primary text-white">

                                            <th style="width:7%;">مدين</th>
                                            <th style="width:7%;">دائن</th>

                                            <th style="width:7%;">مدين</th>
                                            <th style="width:7%;">دائن</th>

                                            <th style="width:7%;">مدين</th>
                                            <th style="width:7%;">دائن</th>

                                            <th style="width:7%;">مدين</th>
                                            <th style="width:7%;">دائن</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="p in workPointsModified" 
                                            ng-class="{
                                                        'bg-complete': p.level == 1, 'bg-complete-light': p.level == 2, 'bg-complete-lighter': p.level == 3}"
                                            ng-mouseenter="showBtn(p)" ng-mouseleave="showBtn(p)">
                                            <td>
                                                <div ng-if="p.showBtnAdd" class="table-button">
                                                    <a ng-click="addRow(p)" style="min-width: 50px;" class="btn btn-success btn-cons" title="اضافة بند"><i class="pg-plus"></i></a><br>
                                                </div>
                                                <div ng-if="p.showBtnRm" class="table-button">
                                                    <a ng-click="removeRow(p)" style="min-width: 50px;" class="btn btn-danger btn-cons" title="حذف البند"><i class="pg-trash"></i></a>
                                                </div>
                                                <span>
                                                    <input ng-if="!p.initial" ng-model="p.number" type="text" class="form-control table-input input-font" placeholder="أدخل رقم حساب البند">

                                                </span>
                                                <span ng-if="p.initial" ng-bind="p.number"></span>
                                            </td>
                                            <td>
                                                <input ng-if="!p.initial" ng-model="p.name" type="text" class="form-control table-input" placeholder="أدخل اسم البند">
                                                <span ng-if="p.initial" ng-bind="p.name"></span>
                                            </td>
                                            <td>
                                                <input ng-change="modifyParent(p.parent_id, 'initial_debit')" ng-model="p.initial_debit" ng-if="p.level == 4" type="text" class="form-control table-input">
                                                <span ng-show="p.initial_debit > 0" ng-if="p.level != 4" ng-bind="p.initial_debit"></span>
                                            </td>
                                            <td>
                                                <input ng-change="modifyParent(p.parent_id, 'initial_credit')" ng-model="p.initial_credit" ng-if="p.level == 4" type="text" class="form-control table-input">
                                                <span ng-show="p.initial_credit > 0" ng-if="p.level != 4" ng-bind="p.initial_credit"></span>
                                            </td>
                                            <td>
                                                <input ng-change="modifyParent(p.parent_id, 'move_debit')" ng-model="p.move_debit" ng-if="p.level == 4" type="text" class="form-control table-input">
                                                <span ng-show="p.move_debit > 0" ng-if="p.level != 4" ng-bind="p.move_debit"></span>
                                            </td>
                                            <td>
                                                <input ng-change="modifyParent(p.parent_id, 'move_credit')" ng-model="p.move_credit" ng-if="p.level == 4" type="text" class="form-control table-input">
                                                <span ng-show="p.move_credit > 0" ng-if="p.level != 4" ng-bind="p.move_credit"></span>
                                            </td>
                                            <td class="table-center">
                                                <span ng-show="p.totalD > 0" ng-bind="p.totalD = +p.initial_debit + +p.move_debit"></span>
                                            </td>
                                            <td class="table-center">
                                                <span ng-show="p.totalC > 0" ng-bind="p.totalC = +p.initial_credit + +p.move_credit"></span>
                                            </td>
                                            <td class="table-center">
                                                <span ng-if="p.totalD > p.totalC" ng-bind="p.totalD - p.totalC"></span>
                                            </td>
                                            <td class="table-center">
                                                <span ng-if="p.totalC > p.totalD" ng-bind="p.totalC - p.totalD"></span>
                                            </td>
                                            <td>
                                                <input ng-model="p.match" data-id='@{{p.id}}' onchange="angular.element(this).scope().pMatch($(this).data('id'))" ng-if="p.level == 4" type="checkbox" data-size="small" data-color="primary-light" switch-dir>
                                            </td>
                                            <td>
                                                <input ng-hide="p.match" ng-model="p.afterRev" ng-if="p.level == 4" type="text" class="form-control table-input" placeholder="الرقم بعد المراجعة">
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="">
                            <span style="display: block;color: #c64643" ng-if="error">خطأ! قم بادخال أسماء و أرقام الحسابات للبنود المضافه</span>
                            <span ng-if="processing">جارى حفظ البيانات...</span>
                            <a ng-if="!processing" ng-click="save()" class="btn btn-primary btn-cons m-t-10" title="حفظ">حفظ الميزان</a>
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
<script src="{{url('/')}}/assets/js/scripts.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->

<script src="{{url('/')}}/js/angular.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/js/myapp.js" type="text/javascript"></script>
<script src="{{url('/')}}/js/switchDir.js" type="text/javascript"></script>
<script src="{{url('/')}}/js/controllers/BalanceController.js" type="text/javascript"></script>
@endsection