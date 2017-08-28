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
                            <span ng-if="!client">انشاء حساب عميل جديد</span>
                            <span ng-if="client">تعديل حساب عميل " <span ng-bind="client.company_name"></span>"</span>
                            <br>
                            <span class="small " style="color:#10cfbd;">المعلومات القانونية</span>
                        </h4>

                    </div>
                </div>
            </div>
            <!-- END JUMBOTRON -->

            <!-- START CONTAINER FLUID -->
            <div class="container-fluid container-fixed-lg">
                <!-- BEGIN PlACE PAGE CONTENT HERE -->
                <div ng-if="errors.length" class="row">
                    <div class="alert alert-danger alert-dismissable col-md-6">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <ul>
                            <li ng-repeat="error in errors" ng-bind="error"></li>
                        </ul>
                    </div>
                </div>
                <div id="rootwizard">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-linetriangle">
                        <li class="active">
                            <a data-toggle="tab" href="#tab1"><i class="fa fa-2x fa-building-o  tab-icon"></i> <span>معلومات اساسية</span></a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#tab2"><i class="fa fa-2x  fa-user tab-icon"></i> <span>  الشركاء و الممثلين</span></a>
                        </li>

                        <li class="">
                            <a data-toggle="tab" href="#tab3"><i class="fa fa-2x  fa-paperclip tab-icon"></i> <span> الملحقات</span></a>
                        </li>
                    </ul>
                    <!-- Nav tabs -->

                    <form id='client_form' enctype='multipart/form-data' role="form">
                        <input name="id" type="hidden" ng-value="id">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane slide-left padding-20 active" id="tab1">
                                <h5 style="color:#10cfbd;">معلومات العميل الاساسية</h5>
                                <div class="form-group-attached">
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default required">
                                                <label>اسم الشركة </label>
                                                <input name='company_name' ng-value='client.company_name' type="text" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default required">
                                                <label>نشاط الشركة</label>
                                                <input name='company_activity' ng-value='client.company_activity' type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default required">
                                                <label>عنوان الشركة</label>
                                                <input name='company_address' ng-value='client.company_address' type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default required">
                                                <label>تاريخ السنه الماليه</label>
                                                <input name='company_financial_year' ng-value='client.company_financial_year' type="text" class="form-control datepicker">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h5 style="color:#10cfbd;"> السجل التجارى</h5>
                                <div class="form-group-attached">
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default required">
                                                <label>رقم السجل التجارى </label>
                                                <input name='company_register_number' ng-value='client.company_register_number' type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default required">
                                                <label>تاريخ الانتهاء</label>
                                                <input name='company_register_expiration' ng-value="client.company_register_expiration" type="text" class="form-control datepicker">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h5 style="color:#10cfbd;">رأس المال</h5>
                                <div class="form-group-attached">
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default required">
                                                <label>رأس المال العينى </label>
                                                <input name='company_apparent_capital' ng-value="client.company_apparent_capital" type="text" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default required">
                                                <label>رأس المال النقدى</label>
                                                <input name='company_money_capital' ng-value="client.company_money_capital" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-default required">
                                        <label>إجمالى رأس المال</label>
                                        <input name='company_total_capital' ng-value="client.company_total_capital" type="text" class="form-control">
                                    </div>
                                </div>
                                <br>
                                <h5 style="color:#10cfbd;">نوع الشركة والمعاملة الزكوية</h5>
                                <div class="form-group-attached">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default required">
                                                <select name='company_type' class="form-control">
                                                    <option value="">نوع الشركة / المؤسسة</option>
                                                    <option ng-selected="client.company_type == 'individual'" value="individual">مؤسسة فردية</option>
                                                    <option ng-selected="client.company_type == 'limited'" value="limited">شركة محدودة</option>
                                                    <option ng-selected="client.company_type == 'solidarity'" value="solidarity">شركة تضامن</option>
                                                    <option ng-selected="client.company_type == 'contributory'" value="contributory">شركة مساهمة</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">

                                            <div class="form-group-attached">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default required">
                                                            <select name='company_zakkat' class="form-control">
                                                                <option value="">نوع المعاملة الزكوية</option>
                                                                <option ng-selected="client.company_zakkat == 'zakkat'" value="zakkat">زكاة</option>
                                                                <option ng-selected="client.company_zakkat == 'tax'" value="tax">ضريبة</option>
                                                                <option ng-selected="client.company_zakkat == 'mixed'" value="mixed">مختلطة</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h5 style="color:#10cfbd;">بيانات الاتصال</h5>
                                <div class="form-group-attached">
                                    <div class="row clearfix">
                                        <div class="col-sm-3">
                                            <div class="form-group form-group-default required" ng-repeat="phone in company_phones">
                                                <label>رقم الهاتف  <span ng-if="$index > 0" ng-bind="$index + 1"></span></label>
                                                <input name="company_phone[@{{$index}}][id]" type="hidden" ng-value="phone.id">
                                                <input name="company_phone[@{{$index}}][type]" type="hidden" value="phone">
                                                <input name="company_phone[@{{$index}}][data]" ng-value="phone.data" type="text" class="form-control">
                                            </div>
                                            <button ng-click="addContact('phone')" class="btn btn-default btn-cons m-b-10" type="button" style="min-width:auto;"><i class="pg-plus"></i> </button>
                                            <button ng-click="rmContact('phone')" ng-if="company_phones.length > 1" class="btn btn-danger btn-cons m-b-10 delContact" type="button" style="min-width:auto;"><i class="pg-minus"></i> </button>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group form-group-default" ng-repeat="fax in company_faxes">
                                                <label>فاكس <span ng-if="$index > 0" ng-bind="$index + 1"></span></label>
                                                <input name="company_fax[@{{$index}}][id]" type="hidden" ng-value="fax.id">
                                                <input name="company_fax[@{{$index}}][type]" type="hidden" value="fax">
                                                <input name="company_fax[@{{$index}}][data]" ng-value="fax.data" type="text" class="form-control">
                                            </div>
                                            <button ng-click="addContact('fax')" class="btn btn-default btn-cons m-b-10" type="button" style="min-width:auto;"><i class="pg-plus"></i> </button>
                                            <button ng-click="rmContact('fax')" ng-if="company_faxes.length > 1" class="btn btn-danger btn-cons m-b-10 delContact" type="button" style="min-width:auto;"><i class="pg-minus"></i> </button>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group form-group-default required" ng-repeat="email in company_emails">
                                                <label>بريد اليكترونى  <span ng-if="$index > 0" ng-bind="$index + 1"></span></label>
                                                <input name="company_email[@{{$index}}][id]" type="hidden" ng-value="email.id">
                                                <input name="company_email[@{{$index}}][type]" type="hidden" value="email">
                                                <input name="company_email[@{{$index}}][data]" ng-value="email.data" type="text" class="form-control">
                                            </div>
                                            <button ng-click="addContact('email')" class="btn btn-default btn-cons m-b-10" type="button" style="min-width:auto;"><i class="pg-plus"></i> </button>
                                            <button ng-click="rmContact('email')" ng-if="company_emails.length > 1" class="btn btn-danger btn-cons m-b-10 delContact" type="button" style="min-width:auto;"><i class="pg-minus"></i> </button>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group form-group-default" ng-repeat="website in company_websites">
                                                <label>موقع اليكترونى <span ng-if="$index > 0" ng-bind="$index + 1"></span></label>
                                                <input name="company_website[@{{$index}}][id]" type="hidden" ng-value="website.id">
                                                <input name="company_website[@{{$index}}][type]" type="hidden" value="website">
                                                <input name="company_website[@{{$index}}][data]" ng-value="website.data" type="text" class="form-control">
                                            </div>
                                            <button ng-click="addContact('website')" class="btn btn-default btn-cons m-b-10" type="button" style="min-width:auto;"><i class="pg-plus"></i> </button>
                                            <button ng-click="rmContact('website')" ng-if="company_websites.length > 1" class="btn btn-danger btn-cons m-b-10 delContact" type="button" style="min-width:auto;"><i class="pg-minus"></i> </button>
                                        </div>
                                    </div>

                                </div>
                                <br>
                            </div>

                            <div class="tab-pane slide-left padding-20" id="tab2">
                                <h5 style="color:#10cfbd;">الشركاء</h5>
                                <div class="form-group-attached" ng-repeat="partner in partners">
                                    <input name="partners[@{{$index}}][id]" type="hidden" ng-value="partner.id">
                                    <div class="row clearfix">
                                        <div class="col-sm-8">
                                            <div class="form-group form-group-default">
                                                <label>اسم الشريك</label>
                                                <input name="partners[@{{$index}}][name]" ng-value="partner.name" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-group-default">
                                                <label>نسبة رأس المال </label>
                                                <input name="partners[@{{$index}}][percentage]" ng-value="partner.percentage" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-4">
                                            <div class="form-group form-group-default">
                                                <label>رقم الهاتف </label>
                                                <input name="partners[@{{$index}}][phone]" ng-value="partner.phone" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-group-default">
                                                <label>فاكس</label>
                                                <input name="partners[@{{$index}}][fax]" ng-value="partner.fax" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-group-default">
                                                <label>بريد اليكترونى </label>
                                                <input name="partners[@{{$index}}][email]" ng-value="partner.email" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <button ng-click="addPartner()" class="btn btn-default btn-cons m-b-10" type="button"><i class="pg-plus"></i> إضافة شريك اخر</button>
                                <button ng-click="rmPartner()" ng-if="partners.length > 1" class="btn btn-danger btn-cons m-b-10" type="button"><i class="pg-minus"></i> </button>

                                <h5 style="color:#10cfbd;">الممثلين الرسميين للشركة</h5>
                                <div class="form-group-attached" ng-repeat="rep in representatives">
                                    <input name="reps[@{{$index}}][id]" type="hidden" ng-value="rep.id">
                                    <div class="row clearfix">
                                        <div class="col-sm-8">
                                            <div class="form-group form-group-default">
                                                <label>اسم الممثل</label>
                                                <input name="reps[@{{$index}}][name]" ng-value="rep.name" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-group-default">
                                                <label>الوظيفة </label>
                                                <input name="reps[@{{$index}}][job]" ng-value="rep.job" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-sm-4">
                                            <div class="form-group form-group-default">
                                                <label>رقم الهاتف </label>
                                                <input name="reps[@{{$index}}][phone]" ng-value="rep.phone" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-group-default">
                                                <label>فاكس</label>
                                                <input name="reps[@{{$index}}][fax]" ng-value="rep.fax" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-group-default">
                                                <label>بريد اليكترونى </label>
                                                <input name="reps[@{{$index}}][email]" ng-value="rep.email" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <button ng-click="addRep()" class="btn btn-default btn-cons m-b-10" type="button"><i class="pg-plus"></i> إضافة ممثل اخر للعميل</button>
                                <button ng-click="rmRep()" ng-if="representatives.length > 1" class="btn btn-danger btn-cons m-b-10" type="button"><i class="pg-minus"></i> </button>

                                <h5 style="color:#10cfbd;">بيانات المراجع السابق</h5>
                                <div class="form-group-attached" ng-repeat="aud in auditors">
                                    <input name="auds[@{{$index}}][id]" type="hidden" ng-value="aud.id">
                                    <div class="row clearfix">
                                        <div class="col-sm-8">
                                            <div class="form-group form-group-default">
                                                <label>اسم المراجع</label>
                                                <input name="auds[@{{$index}}][name]" ng-value="aud.name" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-group-default">
                                                <label>الوظيفة </label>
                                                <input name="auds[@{{$index}}][job]" ng-value="aud.job" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-sm-4">
                                            <div class="form-group form-group-default">
                                                <label>رقم الهاتف </label>
                                                <input name="auds[@{{$index}}][phone]" ng-value="aud.phone" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-group-default">
                                                <label>فاكس</label>
                                                <input name="auds[@{{$index}}][fax]" ng-value="aud.fax" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-group-default">
                                                <label>بريد اليكترونى </label>
                                                <input name="auds[@{{$index}}][email]" ng-value="aud.email" type="text" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                </div>
                                <button ng-click="addAud()" class="btn btn-default btn-cons m-b-10" type="button"><i class="pg-plus"></i> إضافة مراجع اخر </button>
                                <button ng-click="rmAud()" ng-if="auditors.length > 1" class="btn btn-danger btn-cons m-b-10" type="button"><i class="pg-minus"></i> </button>
                            </div>

                            <div class="tab-pane slide-left padding-20" id="tab3">
                                <h5 style="color:#10cfbd;">ملحقات العميل</h5>
                                <div class="form-group-attached">
                                    <div class="row clearfix">
                                        <div class="col-sm-4" ng-repeat="att in attachments">
                                            <div class="form-group form-group-default">
                                                <input type="text" name="attachments[@{{$index}}][name]" ng-value="att.name" class="form-control" placeholder="ادخل اسم الملحق هنا">
                                                <input type="file" name="attachments[@{{$index}}][file]" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br> 
                                <button ng-click="addAtt()" class="btn btn-default btn-cons m-b-10" type="button"><i class="pg-plus"></i> إضافة ملحق اخر </button>
                                <button ng-if="attachments.length > 14" ng-click="rmAtt()" class="btn btn-danger btn-cons m-b-10" type="button"><i class="pg-minus"></i> حذف ملحق</button>
                                <br>
                                <div class="row" ng-if="client">
                                    <h4>الملحقات الحاليه</h4>
                                    <div class="col-md-4 col-sm-6" ng-repeat="att in view_attachments">
                                        <div class="form-group form-group-default">
                                            <h5 ng-bind="att.name"></h5>
                                            <a ng-href="/att/@{{att.path}}" target="_blank" class="pull-right" title="تحميل"><i class="fa fa-download"></i></a>
                                            <a href="" ng-click="delAtt($index)" class="pull-right" style="margin-left: 10px" title="حذف"><i class="fa fa-trash" style="color: orangered"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="padding-20 bg-white">
                                <ul class="pager wizard">
                                    <li class="next" style="display: inline;">
                                        <button class="btn btn-primary btn-cons pull-right btn-animated from-left fa fa-credit-card" type="button">
                                            <span>التالى</span>
                                        </button>
                                    </li>
                                    <li class="next finish" style="display: none;">
                                        <button ng-hide="processing || success" ng-click="processClient()" class="btn btn-primary btn-cons pull-right btn-animated from-left fa fa-credit-card" type="button">
                                            <span>إنهاء وإضافة العميل</span>
                                        </button>
                                    </li>
                                    <li class="previous first hidden">
                                        <button class="btn btn-default btn-cons pull-right btn-animated from-left fa fa-shopping-cart" type="button">
                                            <span>الأول</span>
                                        </button>
                                    </li>
                                    <li class="previous">
                                        <button class="btn btn-default btn-cons pull-right btn-animated from-left fa fa-shopping-cart" type="button">
                                            <span>السابق</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Tab panes -->
                    </form>
                </div>
                <!-- END PLACE PAGE CONTENT HERE -->
            </div>
            <!-- END CONTAINER FLUID -->

            <!-- START CONTAINER FLUID -->
            <div class="container-fluid container-fixed-lg">
                <!-- BEGIN PlACE PAGE CONTENT HERE -->

                <div id="processing" class="panel-body text-center" ng-show="processing">
                    <img class="image-responsive-height demo-mw-50" src="{{url('/')}}/assets/img/demo/progress.svg" alt="Progress">
                </div>
                <div id="success" ng-show="success" class="col-xs-12 sortable-column ui-sortable padding-0">
                    <div class="panel panel-default bg-success" data-pages="portlet">
                        <div class="panel-body">
                            <div ng-if="!client">
                                <h3 class="text-white">
                                    <i data-brackets-id="26822" class="fa  fa-check-square-o  hint-text text-white"></i> تمت إضافة العميل بنجاح
                                </h3>
                                <p class="text-white">تم إنشاء ملف للعميل فى قاعدة بيانات العملاء وإضافة الجزء الاول <span class="bold"> البيانات القانونية
                                    </span></p>
                                <a ng-href="{{url('/client')}}/@{{id}}/balance" class="btn btn-default btn-cons">إستكمال البيانات المالية</a>
                            </div>
                            <div ng-if="client">
                                <h3 class="text-white">
                                    <i data-brackets-id="26822" class="fa  fa-check-square-o  hint-text text-white"></i> تم تعديل العميل بنجاح
                                </h3>
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
<script src="{{url('/')}}/assets/js/form_elements.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/js/form_wizard.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/js/scripts.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->

<script src="{{url('/')}}/js/angular.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/js/myapp.js" type="text/javascript"></script>
<script src="{{url('/')}}/js/controllers/ClientController.js" type="text/javascript"></script>


<script>
    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>
@endsection