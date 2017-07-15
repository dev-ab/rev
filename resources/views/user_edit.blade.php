@extends('layouts/app')

@section('title', 'تعديل المستخدم')

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
                        <h5 style="text-align: center"><a href='{{url('user')}}'>العودة الى المستخدمين</a></h5>
                        <h3 style="text-align: center">تعديل المستخدم"{{$user->name}}"</h3>
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
                                <form id="form-register" class="p-t-15" enctype="multipart/form-data" role="form" method='post' action="{{url('user/save')}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    <div class="panel panel-default">
                                        <div class="panel-body">

                                            <div class='row'>
                                                <div class='col-md-6 col-md-offset-3'>
                                                    @if(session('status') == 'nothing')
                                                    <h5 class="alert alert-danger" style="text-align: center"> خطأ فى انشاء المستخدم</h5>
                                                    @elseif(session('status') == 'updated')
                                                    <h5 class="alert alert-success" style="text-align: center">تم تعديل المستخدم بنجاح</h5>
                                                    @endif
                                                </div>
                                                @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                @endif
                                            </div>

                                            <div class="col-xs-12">

                                                <h5>ادخل معلومات 
                                                    <span class="semi-bold">حساب المستخدم</span>
                                                </h5>
                                                <br>
                                            </div>


                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group form-group-default">
                                                        <label>الاسم بالكامل</label>
                                                        <input type="text" name="name" value="{{$user->name}}" placeholder="" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group form-group-default">
                                                        <label>اسم المستخدم فى النطام</label>
                                                        <input type="text" name="username" value="{{$user->username}}" placeholder="" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group form-group-default">
                                                        <label>كلمة المرور</label>
                                                        <input type="password" name="password" placeholder="على الاقل 6 خانات" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group form-group-default">
                                                        <label>أعد إدخال كلمة المرور</label>
                                                        <input type="password" name="password_confirmation" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group form-group-default">
                                                        <label>البريد الاليكترونى </label>
                                                        <input type="email" name="email" value="{{$user->email}}" placeholder="" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group form-group-default">
                                                        <label>رقم الهاتف</label>
                                                        <input type="text" name="phone" value='{{$user->phone}}' placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group form-group-default">
                                                        <select name='role' class="full-width select2-hidden-accessible" data-init-plugin="select2" tabindex="-1" aria-hidden="true">
                                                            <option value="">اختر صلاحيات الحساب</option>
                                                            @foreach($roles as $role)
                                                            <option value='{{$role->id}}' {{$user->roles[0]->id == $role->id? 'selected' : ''}}>{{$role->display_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group form-group-default" style="height:48px;">
                                                        <input id="pp" style=" float:left;" type="file" name="image">
                                                        <label for="pp" style="float:right;">الصورة الشخصية</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary btn-cons m-t-10" type="submit">حفظ</button>
                                            <a onclick="confirmDel(event)" href='{{url('user/delete/' . $user->id)}}' class="btn btn-danger btn-cons m-t-10">حذف</a>
                                        </div>
                                    </div>

                                </form>
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