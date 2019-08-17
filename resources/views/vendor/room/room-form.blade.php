@extends('layouts.template')
@section('content')
   <div class="">
   	  <div class="row">
           	<div class="page-title">
              <div class="title_left">
                <h3>Room {{$title}}</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>Room {{$title}} Form</h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     @if(isset($room_info) && !empty($room_info))
                        {{Form::open(['url'=>route('room.update',$room_info->id),'class'=>'form','enctype'=>'multipart/form-data'])}}
                        @method('PUT')
                      @else
                        {{Form::open(['url'=>route('room.store'),'class'=>'form','enctype'=>'multipart/form-data'])}}
                      @endif
                      <div class="form-group row">
                        {{ Form::label('title','Title:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::text('title',@$room_info->title,['class'=>'form-control','id'=>'title'])}}
                          @if($errors->has('title'))
                          <span class="alert-danger">{{ $errors->first('title') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('hotel_id','Hotel:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::select('hotel_id',$hotel,@$room_info->hotel_id,['class'=>'form-control','id'=>'hotel_id'])}}
                          @if($errors->has('hotel_id'))
                          <span class="alert-danger">{{ $errors->first('hotel_id') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                      	{{ Form::label('room_type','Room Type:',['class'=>'col-sm-3'])}}
                      	<div class="col-sm-9">
                      		{{ Form::select('room_type',['single'=>'Single Room','double'=>'Double Room','triple'=>'Triple Room','quad'=>'Quad Room','queen'=>'Queen Room','king'=>'King Room'],@$room_info->room_type,['class'=>'form-control','id'=>'room_type'])}}
                      		@if($errors->has('room_type'))
                      		<span class="alert-danger">{{ $errors->first('room_type') }}</span>
                      		@endif
                      	</div>		
                      </div>
                      <div class="form-group row">
                      	{{ Form::label('size','Size:',['class'=>'col-sm-3'])}}
                      	<div class="col-sm-9">
                      		{{ Form::text('size',@$room_info->size,['class'=>'form-control','id'=>'size','required'=>true])}}
                      		@if($errors->has('size'))
                      		<span class="alert-danger">{{ $errors->first('size') }}</span>
                      		@endif
                      	</div>		
                      </div>
                      <div class="form-group row">
                        {{ Form::label('beds','Beds Choice:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::text('beds',@$room_info->beds,['class'=>'form-control','id'=>'beds','required'=>true])}}
                          @if($errors->has('beds'))
                          <span class="alert-danger">{{ $errors->first('beds') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('price','Price:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::text('price',@$room_info->price,['class'=>'form-control','id'=>'price','required'=>true])}}
                          @if($errors->has('price'))
                          <span class="alert-danger">{{ $errors->first('price') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('discount','Discount in %:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::text('discount',@$room_info->discount,['class'=>'form-control','id'=>'discount','placeholder'=>(@$room_info->discount) ? $room_info->discount : 'Enter discount if you want to provide'])}}
                          @if($errors->has('discount'))
                          <span class="alert-danger">{{ $errors->first('discount') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                      	{{ Form::label('status','Status:',['class'=>'col-sm-3'])}}
                      	<div class="col-sm-9">
                      		{{ Form::select('status',['available'=>'Available','unavailable'=>'Unavailable'],isset($room_info->status) ? $room_info->status : '' ,['class'=>'form-control','id'=>'status','required'=>true])}}
                      		@if($errors->has('status'))
                      		<span class="alert-danger">{{ $errors->first('status') }}</span>
                      		@endif
                      	</div>		
                      </div>
                      <div class="form-group row">
                        {{ Form::label('summary','Summary:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::textarea('summary',isset($room_info->summary) ? $room_info->summary : '' ,['class'=>'form-control','id'=>'summary','required'=>true,'rows'=>4,'style'=>'resize:none'])}}
                          @if($errors->has('summary'))
                          <span class="alert-danger">{{ $errors->first('summary') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('room_details','Room Details:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::textarea('room_details',@$room_info->room_details ,['class'=>'form-control','id'=>'room_details','required'=>true,'rows'=>4,'style'=>'resize:none'])}}
                          @if($errors->has('room_details'))
                          <span class="alert-danger">{{ $errors->first('room_details') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                      	{{ Form::label('image','Room Images:',['class'=>'col-sm-3'])}}
                      	<div class="col-sm-9">
                      		{{ Form::file('image[]',['id'=>'image', 'accept'=>'image/*','multiple'=>true])}}
                      		@if($errors->has('image'))
                      		<span class="alert-danger">{{ $errors->first('image') }}</span>
                      		@endif
                          @if(isset($roomimages) && !empty($roomimages))
                          @foreach($roomimages as $key => $value)
                          @if(file_exists(public_path().'/uploads/room-images/'.$roomimages[$key]->image))
                          <img src="{{asset('/uploads/room-images/'.$roomimages[$key]->image)}}" class="img img-responsive img-thumbnail" style="width: 200px;">
                          {{Form::checkbox('checkbox[]',$roomimages[$key]->image)}}Delete
                          @endif
                          @endforeach
                          @endif
                      	</div>		
                      </div>
                      <div class="form-group row">
                      	{{ Form::label('submit','Submit:',['class'=>'col-sm-3'])}}
                      	<div class="col-sm-9">
                      		{{ Form::button('<i class="fas fa-paper-plane"></i> Submit',['id'=>'submit','class'=>'btn btn-success','type'=>'submit'])}}
                          @if(!isset($room_info))
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
      selector: '#room_details,#summary',
      plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern help',
      toolbar: 'formatselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | link image media pageembed | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment',
    });
</script>
@endsection