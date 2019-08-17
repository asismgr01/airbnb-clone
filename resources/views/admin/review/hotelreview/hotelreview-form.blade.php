@extends('layouts.template')
@section('content')
   <div class="">
   	  <div class="row">
           	<div class="page-title">
              <div class="title_left">
                <h3>Hotel Review {{$title}}</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>Hotel Review {{$title}} Form</h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     @if(isset($review_info) && !empty($review_info))
                        {{Form::open(['url'=>route('hotelreview.update',$review_info->id),'class'=>'form','enctype'=>'multipart/form-data'])}}
                        @method('PUT')
                      @endif
                      <div class="form-group row">
                        {{ Form::label('hotel_id','Hotel:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::text('hotel_id',isset($review_info->hotel->hotel_name) ? $review_info->hotel->hotel_name : '' ,['class'=>'form-control','id'=>'hotel_id','required'=>true])}}
                          @if($errors->has('hotel_id'))
                          <span class="alert-danger">{{ $errors->first('hotel_id') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('user_id','User:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::text('user_id',isset($review_info->user_info->name) ? $review_info->user_info->name : '' ,['class'=>'form-control','id'=>'user_id','required'=>true])}}
                          @if($errors->has('user_id'))
                          <span class="alert-danger">{{ $errors->first('user_id') }}</span>
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