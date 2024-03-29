@extends('layouts.home')
@section('menu')
    @include('site.home.menu1')
@endsection
@section('script')
    <script type="text/javascript">
        $('#password_confirmation').keyup(function(){
          var pass = $('#password').val();
          var re_pass = $('#password_confirmation').val();

          if(pass != re_pass){
            $('.re_error').removeClass('hidden');
            $('.re_error').html('Password does not match.');
            $('#submit').attr('disabled','disabled');
          } else {
            $('.re_error').addClass('hidden');
            $('.re_error').html('');
            $('#submit').removeAttr('disabled','disabled');
          }
        });
    </script>
@endsection
@section('content')
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">


            <div class="row ">
                <div class="col-md-12">
                    <form action="{{route('register-user')}}" method="post" class="form">
                        @csrf
                        <div class="form-group row">
                            {{ Form::label('name','Name:', ['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::text('name','',['id'=>'name','class'=>'form-control', 'required'=>true]) }}
                                @if($errors->has('name'))
                                    <span class="alert-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('email','Email:', ['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::email('email','',['id'=>'email','class'=>'form-control', 'required'=>true]) }}
                                @if($errors->has('email'))
                                    <span class="alert-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('password','Password:', ['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::password('password',['id'=>'password','class'=>'form-control', 'required'=>true]) }}
                                @if($errors->has('password'))
                                    <span class="alert-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('password_confirmation','Re-Password:', ['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::password('password_confirmation',['id'=>'password_confirmation','class'=>'form-control', 'required'=>true]) }}
                                @if($errors->has('password_confirmation'))
                                    <span class="alert-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                                <span class="alert-danger hidden re_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('address','Address:', ['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::textarea('address','', ['id'=>'address','class'=>'form-control', 'required'=>true, 'rows'=>4, 'style'=>'resize:none']) }}
                                @if($errors->has('address'))
                                    <span class="alert-danger">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('mobile_no','Phone:', ['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::tel('mobile_no','', ['id'=>'mobile_no','class'=>'form-control']) }}
                                @if($errors->has('mobile_no'))
                                    <span class="alert-danger">{{ $errors->first('mobile_no') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('role','User Type:', ['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::select('role',['user'=>'User', 'vendor'=>'Seller'],'customer', ['id'=>'role','class'=>'form-control', 'required'=>true]) }}
                                @if($errors->has('role'))
                                    <span class="alert-danger">{{ $errors->first('role') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('','', ['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::submit('Submit',['id'=>'submit','class'=>'btn btn-success']) }}
                            </div>
                        </div>



                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection
