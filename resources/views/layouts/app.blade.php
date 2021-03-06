<!DOCTYPE html>
<html lang="{{ config('app.locale')}}" ng-app="MyApp">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>برنامج المراجعه  - @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
        <link rel="apple-touch-icon" href="{{url('/')}}/pages/ico/60.png">
        <link rel="apple-touch-icon" sizes="76x76" href="{{url('/')}}/pages/ico/76.png">
        <link rel="apple-touch-icon" sizes="120x120" href="{{url('/')}}/pages/ico/120.png">
        <link rel="apple-touch-icon" sizes="152x152" href="{{url('/')}}/pages/ico/152.png">
        <link rel="icon" type="image/x-icon" href="{{url('/')}}/favicon.ico" />
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta name="csrf-token" content="{{ csrf_token()}}">
        <link href="{{url('/')}}/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
        <link href="{{url('/')}}/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('/')}}/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <link href="{{url('/')}}/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="{{url('/')}}/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="{{url('/')}}/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />


        <link href="{{url('/')}}/assets/plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('/')}}/assets/plugins/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
        <link href="{{url('/')}}/assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css" />
        <link href="{{url('/')}}/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" media="screen">
        <link href="{{url('/')}}/assets/plugins/summernote/css/summernote.css" rel="stylesheet" type="text/css" media="screen">
        <link href="{{url('/')}}/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" media="screen">
        <link href="{{url('/')}}/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" media="screen">

        <link class="main-stylesheet" href="{{url('/')}}/pages/css/pages-icons.css" rel="stylesheet" type="text/css" />
        <link class="main-stylesheet" href="{{url('/')}}/pages/css/pages.rtl.css" rel="stylesheet" type="text/css" />
        <!--[if lte IE 9]>
            <link href="{{url('/')}}/pages/css/ie9.css" rel="stylesheet" type="text/css" />
        <![endif]-->
        <script type="text/javascript">
            window.onload = function ()
            {
                // fix for windows 8
                if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
                    document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="{{url(' / ')}}/pages/css/windows.chrome.fix.css" />'
            }
        </script>
        <script>
            window.Laravel = {!! json_encode([
                    'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>
    <body  class="fixed-header rtl">


        @if(Auth::check())
        <!-- BEGIN SIDEBPANEL-->
        <nav class="page-sidebar" data-pages="sidebar">

            <!-- BEGIN SIDEBAR MENU HEADER-->
            <div class="sidebar-header">
                <img src="{{url('/')}}/assets/img/logo_white.png" alt="logo" class="brand" data-src="{{url('/')}}/assets/img/logo_white.png" data-src-retina="{{url('/')}}/assets/img/logo_white_2x.png" width="78" height="22">
                <div class="sidebar-header-controls">
                    <button type="button" class="btn btn-link visible-lg-inline" data-toggle-pin="sidebar"><i class="fa fs-12"></i>
                    </button>
                </div>
            </div>
            <!-- END SIDEBAR MENU HEADER-->

            <!-- START SIDEBAR MENU -->
            <div class="sidebar-menu">
                <!-- BEGIN SIDEBAR MENU ITEMS-->
                <ul class="menu-items">
                    <li class="m-t-30">
                        <a href="{{url('/')}}" class="detailed">
                            <span class="title">الرئيسية</span>
                        </a>
                        <span class="bg-success icon-thumbnail"><i class="pg-home"></i></span>
                    </li>
                    <li>
                        <a href="javascript:;"><span class="title">الادارة</span>
                            <span class=" arrow"></span></a>
                        <span class="icon-thumbnail">M</span>
                        <ul class="sub-menu">
                            <!--<li class="">
                                <a href='{{url('task')}}' class="detailed">
                                    <span class="title">المهام</span>
                                </a>
                                <span class="icon-thumbnail">T</span>
                            </li>
                            <li class="">
                                <a href='{{url('group')}}' class="detailed">
                                    <span class="title">البرامج</span>
                                </a>
                                <span class="icon-thumbnail">P</span>
                            </li>
                            <li class="">
                                <a href='{{url('taskobj')}}' class="detailed">
                                    <span class="title">الأهداف</span>
                                </a>
                                <span class="icon-thumbnail">O</span>
                            </li>
                            <li class="">
                                <a href='{{url('cat')}}' class="detailed">
                                    <span class="title">التصنيفات</span>
                                </a>
                                <span class="icon-thumbnail">C</span>
                            </li>-->
                            <li class="">
                                <a href='javascript:;' class="detailed">
                                    <span class="title">مجموعات الخيارات</span>
                                </a>
                                <span class="icon-thumbnail">G</span>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{url('group/create')}}">
                                            <span><i class="fa fa-plus-circle"></i> انشاء مجموعة</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('group')}}">
                                            <span><i class="fa fa-list-ul"></i> عرض المجموعات</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <a href='javascript:;' class="detailed">
                                    <span class="title">برامج المراجعه</span>
                                </a>
                                <span class="icon-thumbnail">P</span>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{url('program/create')}}">
                                            <span><i class="fa fa-plus-circle"></i> انشاء برنامج</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('program')}}">
                                            <span><i class="fa fa-list-ol"></i> عرض البرامج</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <a href='javascript:;' class="detailed">
                                    <span class="title">العملاء</span>
                                </a>
                                <span class="icon-thumbnail">C</span>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{url('client/create')}}">
                                            <span><i class="fa fa-user-plus"></i> انشاء عميل</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('client')}}">
                                            <span><i class="fa fa-users"></i> عرض العملاء</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <a href='javascript:;' class="detailed">
                                    <span class="title">الموظفين</span>
                                </a>
                                <span class="icon-thumbnail">E</span>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{url('user')}}">
                                            <span><i class="fa fa-user-plus"></i> انشاء موظف</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('users-view')}}">
                                            <span><i class="fa fa-users"></i> عرض الموظفين</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <a href='javascript:;' class="detailed">
                                    <span class="title">الصلاحيات</span>
                                </a>
                                <span class="icon-thumbnail">E</span>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{url('role')}}">
                                            <span><i class="fa fa-plus-circle"></i> انشاء مجموعة صلاحيات</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('roles-view')}}">
                                            <span><i class="fa fa-eye"></i> عرض الصلاحيات</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="">
                        <a href="{{ route('logout')}}"
                           onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();" class="detailed">
                            <span class="title">تسجيل خروج</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout')}}" method="POST" style="display: none;">
                            {{ csrf_field()}}
                        </form>
                        <span class="icon-thumbnail">T</span>
                    </li>

                </ul>
                <div class="clearfix"></div>
            </div>
            <!-- END SIDEBAR MENU -->

        </nav>
        <!-- END SIDEBPANEL-->
        @endif



        @yield('content')


        <!-- START OVERLAY -->

        <!-- END OVERLAY -->
        <!-- BEGIN VENDOR JS -->
        <script src="{{url('/')}}/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
        <script src="{{url('/')}}/assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script src="{{url('/')}}/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
        <script src="{{url('/')}}/assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <script src="{{url('/')}}/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="{{url('/')}}/assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
        <script src="{{url('/')}}/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
        <script src="{{url('/')}}/assets/plugins/jquery-bez/jquery.bez.min.js"></script>
        <script src="{{url('/')}}/assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
        <script src="{{url('/')}}/assets/plugins/jquery-actual/jquery.actual.min.js"></script>
        <script src="{{url('/')}}/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
        <script type="text/javascript" src="{{url('/')}}/assets/plugins/bootstrap-select2/select2.min.js"></script>
        <script type="text/javascript" src="{{url('/')}}/assets/plugins/classie/classie.js"></script>
        <script src="{{url('/')}}/assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
        <!-- END VENDOR JS -->

        <script src="{{url('/')}}/assets/plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <script type="text/javascript" src="{{url('/')}}/assets/plugins/jquery-autonumeric/autoNumeric.js"></script>
        <script type="text/javascript" src="{{url('/')}}/assets/plugins/dropzone/dropzone.min.js"></script>
        <script type="text/javascript" src="{{url('/')}}/assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js"></script>
        <script type="text/javascript" src="{{url('/')}}/assets/plugins/jquery-inputmask/jquery.inputmask.min.js"></script>
        <script src="{{url('/')}}/assets/plugins/boostrap-form-wizard/js/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
        <script src="{{url('/')}}/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="{{url('/')}}/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="{{url('/')}}/assets/plugins/summernote/js/summernote.min.js" type="text/javascript"></script>
        <script src="{{url('/')}}/assets/plugins/moment/moment.min.js"></script>
        <script src="{{url('/')}}/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="{{url('/')}}/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>

        @include('layouts.footer')


        <script src="{{url('/')}}/pages/js/pages.min.js"></script>

        @yield('js')



    </body>
</html>