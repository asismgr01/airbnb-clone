@extends('layouts.template')
@section('script')
     <script>
        $('#edit_password').change(function(e){
            var checked = $('#edit_password').prop('checked');
            if(checked){
               $('#password').attr('required');
               $('#re_password').attr('required');
               $('#edit_password_div').removeClass('hidden');
            }
            else{
              $('#password').removeAttr('required');
              $('#re_password').removeAttr('required');
              $('#edit_password_div').addClass('hidden');
            }
        });

        $('#re_password').keyup(function(){
          var pass = $('#password').val();
          var re_pass = $('#re_password').val();

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
   <div class="">
   	  <div class="row">
           	<div class="page-title">
              <div class="title_left">
                <h3>Vendor {{$title}}</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>Vendor {{$title}} Form</h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     @if(isset($vendor_info) && !empty($vendor_info))
                        {{Form::open(['url'=>route('vendor.update',$vendor_info->id),'class'=>'form','enctype'=>'multipart/form-data'])}}
                        @method('PUT')
                      @else
                        {{Form::open(['url'=>route('vendor.store'),'class'=>'form','enctype'=>'multipart/form-data'])}}
                      @endif
                      <div class="form-group row">
                      	{{ Form::label('name','Name:',['class'=>'col-sm-3'])}}
                      	<div class="col-sm-9">
                      		{{ Form::text('name',isset($vendor_info->name) ? $vendor_info->name : '' ,['class'=>'form-control','id'=>'name','required'=>true])}}
                      		@if($errors->has('name'))
                      		<span class="alert-danger">{{ $errors->first('name') }}</span>
                      		@endif
                      	</div>		
                      </div>	 
                      <div class="form-group row">
                        {{ Form::label('email','Email:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::email('email',isset($vendor_info->email) ? $vendor_info->email : '' ,['class'=>'form-control','id'=>'email','required'=>true,'onkeyup'=>'check();'])}}
                          @if($errors->has('email'))
                          <span class="alert-danger">{{ $errors->first('email') }}</span>
                          @endif
                        </div>    
                      </div> 
                      @if($title == 'add')
                      <div class="form-group row">
                        {{ Form::label('password','Password:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::password('password',['class'=>'form-control','placeholder'=>'Password must be atleast 7 characters*','id'=>'password','onchange'=>'check_pass();'])}}
                          @if($errors->has('password'))
                          <span class="alert-danger">{{ $errors->first('password') }}</span>
                          @endif
                        </div>    
                      </div>  
                      <div class="form-group row">
                          {{ Form::label('re_password','Re-Password: ', ['class'=>'col-sm-3']) }}
                          <div class="col-sm-9">
                          {{ Form::password('re_password', ['class'=>'form-control','placeholder'=>'Password must match with password above*','id'=>'re_password']) }}
                          @if($errors->has('re_password'))
                            <span class="alert-danger">{{ $errors->first('re_password') }}</span>
                          @endif
                          <span class="alert-danger hidden re_error"></span>
                          </div>
                      </div>
                      @else
                      <div class="form-group row">
                        {{ Form::label('edit_password','Edit Password:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::checkbox('edit_password',1,false,['id'=>'edit_password'])}}Yes
                          @if($errors->has('edit_password'))
                          <span class="alert-danger">{{ $errors->first('edit_password') }}</span>
                          @endif
                        </div>   
                      </div>
                      <div id="edit_password_div" class="hidden">
                        <div class="form-group row">
                          {{ Form::label('password','Password:',['class'=>'col-sm-3'])}}
                          <div class="col-sm-9">
                            {{ Form::password('password',['class'=>'form-control','placeholder'=>'Password must be atleast 7 characters*','id'=>'password'])}}
                            @if($errors->has('password'))
                            <span class="alert-danger">{{ $errors->first('password') }}</span>
                            @endif
                          </div>    
                        </div>
                        <div class="form-group row">
                          {{ Form::label('re_password','Re-password:',['class'=>'col-sm-3'])}}
                          <div class="col-sm-9">
                            {{ Form::password('re_password',['class'=>'form-control','placeholder'=>'Password must match with password above*','id'=>'re_password'])}}
                            @if($errors->has('re_password'))
                            <span class="alert-danger">{{ $errors->first('re_password') }}</span>
                            @endif
                            <span class="alert-danger hidden re_error"></span>

                          </div>    
                        </div>
                      </div>
                      @endif  
                      <div class="form-group row">
                        {{ Form::label('role','Role:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::select('role',['vendor'=>'Vendor'],@$vendor_info->status,['class'=>'form-control','id'=>'status','required'=>true])}}
                          @if($errors->has('status'))
                          <span class="alert-danger">{{ $errors->first('status') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('mobile_no','Mobile No.:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::tel('mobile_no',isset($vendor_info->mobile_no) ? $vendor_info->mobile_no : '' ,['class'=>'form-control','id'=>'mobile_no'])}}
                          @if($errors->has('mobile_no'))
                          <span class="alert-danger">{{ $errors->first('mobile_no') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('address','Address No.:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::tel('address',isset($vendor_info->address) ? $vendor_info->address : '' ,['class'=>'form-control','id'=>'address'])}}
                          @if($errors->has('address'))
                          <span class="alert-danger">{{ $errors->first('address') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                      	{{ Form::label('status','Status:',['class'=>'col-sm-3'])}}
                      	<div class="col-sm-9">
                      		{{ Form::select('status',['active'=>'Active','inactive'=>'Inactive'],@$vendor_info->status,['class'=>'form-control','id'=>'status','required'=>true])}}
                      		@if($errors->has('status'))
                      		<span class="alert-danger">{{ $errors->first('status') }}</span>
                      		@endif
                      	</div>		
                      </div>         
                      <div class="form-group row">
                      	{{ Form::label('submit','Submit:',['class'=>'col-sm-3'])}}
                      	<div class="col-sm-9">
                      		{{ Form::button('<i class="fas fa-paper-plane"></i> Submit',['id'=>'submit','class'=>'btn btn-success','type'=>'submit'])}}
                          @if(!isset($vendor_info))
                      		{{ Form::button('Reset',['id'=>'reset','class'=>'btn btn-danger','type'=>'reset'])}}
                          @endif
                      	</div>		
                      </div>					
                      {{Form::close()}}
                  </div>                   
                </div>
              </div>
            </div>
           </div>           
   </div>
@endsection
