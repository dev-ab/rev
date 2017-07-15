@extends('layouts.app')


@section('title', 'تسجبل دخول')


@section('content')

<div class="login-wrapper ">

    <!-- START Login Background Pic Wrapper-->
    <div class="bg-pic">
        <!-- START Background Pic-->
        <img src="{{url('/')}}/assets/img/demo/login_bg.jpg"  class="lazy">
        <!-- END Background Pic-->
        <!-- START Background Caption-->
        <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
            <h2 class="semi-bold text-white">
                يمكننا هنا كتابة اى رسالة او محتوى تريدة ان يظهر للموظفين</h2>
            <p class="small">
                يمكن هنا كتابة اى محتوى فرعى تريده ان يظهر فى صفحة الدخول  كرسالة تحفيزية للموظفين او اى التزام من التزامات الشركة
            </p>
        </div>
        <!-- END Background Caption-->
    </div>
    <!-- END Login Background Pic Wrapper-->


    <!-- START Login Right Container-->
    <div class="login-container bg-white">
        <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
            <img src="{{url('/')}}/assets/img/logo.png" alt="logo" data-src="{{url('/')}}/assets/img/logo.png" data-src-retina="{{url('/')}}/assets/img/logo_2x.png" width="78" height="22">
            <p class="p-t-35">ادخل اسم المستخدم وكلمة المرور لتسجيل الدخول الى حسابك</p>
            <!-- START Login Form -->
            <form id="form-login" role="form" class="p-t-15"  method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <!-- START Form Control-->
                <div class="form-group form-group-default{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for='email'>اسم المستخدم</label>

                    <div class="controls">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <!-- END Form Control-->
                <!-- START Form Control-->
                <div class="form-group form-group-default{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for='password'>كلمة المرور</label>

                    <div class="controls">
                        <input id="password" type="password" class="form-control" name="password" value="" required autofocus>
                    </div>
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <!-- END Form Control-->
                <div class="row">
                    <div class="col-md-6 no-padding">
                        <div class="checkbox ">
                            <input id="checkbox1" type="checkbox" value='1' name="remember" {{ old('remember') ? 'checked' : '' }}>
                                   <label for="checkbox1">تذكر معلومات الدخول</label>
                        </div>
                    </div>

                </div>
                <!-- END Form Control-->
                <button class="btn btn-primary btn-cons m-t-10" type="submit">تسجيل الدخول </button>
            </form>

            <!--END Login Form-->
        </div>
    </div>
    <!-- END Login Right Container-->
</div>






@endsection

@section('js')

<script>
$(function ()
{
    $('#form-login').validate()
})
</script>

@endsection
