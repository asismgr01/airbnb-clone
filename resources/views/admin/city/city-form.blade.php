@extends('layouts.template')
@section('content')
   <div class="">
   	  <div class="row">
           	<div class="page-title">
              <div class="title_left">
                <h3>City {{$title}}</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>City {{$title}} Form</h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     @if(isset($cities_info) && !empty($cities_info))
                        {{Form::open(['url'=>route('city.update',$cities_info->id),'class'=>'form','enctype'=>'multipart/form-data'])}}
                        @method('PUT')
                      @else
                        {{Form::open(['url'=>route('city.store'),'class'=>'form','enctype'=>'multipart/form-data'])}}
                      @endif
                      <div class="form-group row">
                        {{ Form::label('city','City:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::text('city',isset($cities_info->city) ? $cities_info->city : '' ,['class'=>'form-control','id'=>'city','required'=>true])}}
                          @if($errors->has('city'))
                          <span class="alert-danger">{{ $errors->first('city') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                      	{{ Form::label('status','Status:',['class'=>'col-sm-3'])}}
                      	<div class="col-sm-9">
                      		{{ Form::select('status',['active'=>'Active','inactive'=>'Inactive'],@$cities_info->status,['class'=>'form-control','id'=>'status','required'=>true])}}
                      		@if($errors->has('status'))
                      		<span class="alert-danger">{{ $errors->first('status') }}</span>
                      		@endif
                      	</div>		
                      </div>
                      <div class="form-group row">
                        {{ Form::label('summary','Summary:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::textarea('summary',isset($cities_info->summary) ? $cities_info->summary : ''  ,['class'=>'form-control','id'=>'summary','rows'=>4,'style'=>'resize:none'])}}
                          @if($errors->has('summary'))
                          <span class="alert-danger">{{ $errors->first('summary') }}</span>
                          @endif
                        </div>    
                      </div>
                      
                      <div class="form-group row">
                        {{ Form::label('image','City Image:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::file('image',['id'=>'image', 'accept'=>'image/*'])}}
                          @if($errors->has('image'))
                          <span class="alert-danger">{{ $errors->first('image') }}</span>
                          @endif
                          @if(isset($cities_info->image) && file_exists(public_path().'/uploads/city-images/'.$cities_info->image))
                          <img src="{{asset('/uploads/city-images/'.$cities_info->image)}}" class="img img-responsive img-thumbnail" style="width: 200px;">
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                      	{{ Form::label('submit','Submit:',['class'=>'col-sm-3'])}}
                      	<div class="col-sm-9">
                      		{{ Form::button('<i class="fas fa-paper-plane"></i> Submit',['id'=>'submit','class'=>'btn btn-success','type'=>'submit'])}}
                          @if(!isset($cities_info))
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
@section('script')
<script src="{{ asset('plugins/tinymce/tinymce.min.js')}}"></script>
<script type="text/javascript">
  tinymce.init({
      selector: '#description,#summary',
      plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern help',
      toolbar: 'formatselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | link image media pageembed | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment',

    });
</script>
@endsection