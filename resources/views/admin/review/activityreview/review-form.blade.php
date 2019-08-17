@extends('layouts.template')
@section('content')
   <div class="">
   	  <div class="row">
           	<div class="page-title">
              <div class="title_left">
                <h3>Activity Review {{$title}}</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>Activity Review {{$title}} Form</h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     @if(isset($review_info) && !empty($review_info))
                        {{Form::open(['url'=>route('activityreview.update',$review_info->id),'class'=>'form','enctype'=>'multipart/form-data'])}}
                        @method('PUT')
                      @endif
                      <div class="form-group row">
                        {{ Form::label('activity_id','Activity:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::text('activity_id',isset($review_info->activity->title) ? $review_info->activity->title : '' ,['class'=>'form-control','id'=>'activity_id','required'=>true])}}
                          @if($errors->has('activity_id'))
                          <span class="alert-danger">{{ $errors->first('activity_id') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('user_id','User Id:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::text('user_id',isset($review_info->user_id) ? $review_info->user_id : '' ,['class'=>'form-control','id'=>'user_id','required'=>true])}}
                          @if($errors->has('user_id'))
                          <span class="alert-danger">{{ $errors->first('user_id') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('name','Name:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::text('name',isset($review_info->name) ? $review_info->name : '' ,['class'=>'form-control','id'=>'name','required'=>true])}}
                          @if($errors->has('name'))
                          <span class="alert-danger">{{ $errors->first('name') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('rate','Rating:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::text('rate',isset($review_info->rate) ? $review_info->rate : '' ,['class'=>'form-control','id'=>'rate','required'=>true])}}
                          @if($errors->has('rate'))
                          <span class="alert-danger">{{ $errors->first('rate') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('review','Review:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::textarea('review',isset($review_info->review) ? $review_info->review : '' ,['class'=>'form-control','id'=>'review','required'=>true,'rows'=>4,'style'=>'resize:none'])}}
                          @if($errors->has('review'))
                          <span class="alert-danger">{{ $errors->first('review') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                      	{{ Form::label('status','Status:',['class'=>'col-sm-3'])}}
                      	<div class="col-sm-9">
                      		{{ Form::select('status',['active'=>'Active','inactive'=>'Inactive'],@$review_info->status,['class'=>'form-control','id'=>'status','required'=>true])}}
                      		@if($errors->has('status'))
                      		<span class="alert-danger">{{ $errors->first('status') }}</span>
                      		@endif
                      	</div>		
                      </div>
                      
                      <div class="form-group row">
                      	{{ Form::label('submit','Submit:',['class'=>'col-sm-3'])}}
                      	<div class="col-sm-9">
                      		{{ Form::button('<i class="fas fa-paper-plane"></i> Submit',['id'=>'submit','class'=>'btn btn-success','type'=>'submit'])}}
                          @if(!isset($review_info))
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