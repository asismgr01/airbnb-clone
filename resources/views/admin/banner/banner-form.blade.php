@extends('layouts.template')
@section('content')
   <div class="">
   	  <div class="row">
           	<div class="page-title">
              <div class="title_left">
                <h3>Banner {{$title}}</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>Banner {{$title}} Form</h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     @if(isset($banner) && !empty($banner))
                        {{Form::open(['url'=>route('banner.update',$banner->id),'class'=>'form','enctype'=>'multipart/form-data'])}}
                        @method('PUT')
                      @else
                        {{Form::open(['url'=>route('banner.store'),'class'=>'form','enctype'=>'multipart/form-data'])}}
                      @endif
                      <div class="form-group row">
                        {{ Form::label('title','Title:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::text('title',isset($banner->title) ? $banner->title : '' ,['class'=>'form-control','id'=>'title'])}}
                          @if($errors->has('title'))
                          <span class="alert-danger">{{ $errors->first('title') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('description','Description:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::textarea('description',isset($banner->description) ? $banner->description : '' ,['class'=>'form-control','id'=>'description','rows'=>'4'])}}
                          @if($errors->has('description'))
                          <span class="alert-danger">{{ $errors->first('description') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('link','Link:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::text('link',isset($banner->link) ? $banner->link : '' ,['class'=>'form-control','id'=>'link','rows'=>'4'])}}
                          @if($errors->has('link'))
                          <span class="alert-danger">{{ $errors->first('link') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('status','Status:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::select('status',['active'=>'Active','inactive'=>'Inactive'],@$banner->status,['class'=>'form-control','id'=>'status','required'=>true])}}
                          @if($errors->has('status'))
                          <span class="alert-danger">{{ $errors->first('status') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('banner','Banners:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::file('banner',['id'=>'banner', 'accept'=>'image/*'])}}
                          @if($errors->has('banner'))
                          <span class="alert-danger">{{ $errors->first('banner') }}</span>
                          @endif
                          @if(isset($banner->banner) && file_exists(public_path().'/uploads/banner/'.$banner->banner))
                          <img src="{{asset('/uploads/banner/'.$banner->banner)}}" class="img img-responsive img-thumbnail" style="width: 200px;">
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                      	{{ Form::label('submit','Submit:',['class'=>'col-sm-3'])}}
                      	<div class="col-sm-9">
                      		{{ Form::button('<i class="fas fa-paper-plane"></i> Submit',['id'=>'submit','class'=>'btn btn-success','type'=>'submit'])}}
                          @if(!isset($banner))
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