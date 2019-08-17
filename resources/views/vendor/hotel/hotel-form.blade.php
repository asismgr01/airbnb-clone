@extends('layouts.template')
@section('content')
   <div class="">
   	  <div class="row">
           	<div class="page-title">
              <div class="title_left">
                <h3>Hotel {{$title}}</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>Hotel {{$title}} Form</h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     @if(isset($hotel_info) && !empty($hotel_info))
                        {{Form::open(['url'=>route('hotel.update',$hotel_info->id),'class'=>'form','enctype'=>'multipart/form-data'])}}
                        @method('PUT')
                      @else
                        {{Form::open(['url'=>route('hotel.store'),'class'=>'form','enctype'=>'multipart/form-data'])}}
                      @endif
                      <div class="form-group row">
                      	{{ Form::label('hotel_name','Hotel Name:',['class'=>'col-sm-3'])}}
                      	<div class="col-sm-9">
                      		{{ Form::text('hotel_name',isset($hotel_info->hotel_name) ? $hotel_info->hotel_name : '' ,['class'=>'form-control','id'=>'hotel_name','required'=>true])}}
                      		@if($errors->has('hotel_name'))
                      		<span class="alert-danger">{{ $errors->first('hotel_name') }}</span>
                      		@endif
                      	</div>		
                      </div>	
                      <div class="form-group row">
                      	{{ Form::label('type','Hotel Type:',['class'=>'col-sm-3'])}}
                      	<div class="col-sm-9">
                      		{{ Form::select('type',['small'=>'Small (hotel with 100 rooms and less)','medium'=>'Medium (hotel which has 100-300 rooms)','large'=>'Large (hotel which have more than 300 rooms)','mega'=>'Mega (hotels with more than 1000 rooms)'],@$hotel_info->type,['class'=>'form-control','id'=>'type'])}}
                      		@if($errors->has('type'))
                      		<span class="alert-danger">{{ $errors->first('type') }}</span>
                      		@endif
                      	</div>		
                      </div>
                      <div class="form-group row">
                      	{{ Form::label('status','Status:',['class'=>'col-sm-3'])}}
                      	<div class="col-sm-9">
                      		{{ Form::select('status',['active'=>'Active','inactive'=>'Inactive'],@$hotel_info->status,['class'=>'form-control','id'=>'status','required'=>true])}}
                      		@if($errors->has('status'))
                      		<span class="alert-danger">{{ $errors->first('status') }}</span>
                      		@endif
                      	</div>		
                      </div>
                      <div class="form-group row">
                      	{{ Form::label('city','City:',['class'=>'col-sm-3'])}}
                      	<div class="col-sm-9">
                      		{{ Form::select('city',@$city,isset($hotel_info->city) ? $hotel_info->city : '' ,['class'=>'form-control','id'=>'city','required'=>true])}}
                      		@if($errors->has('city'))
                      		<span class="alert-danger">{{ $errors->first('city') }}</span>
                      		@endif
                      	</div>		
                      </div>
                      <div class="form-group row">
                      	{{ Form::label('address','Address:',['class'=>'col-sm-3'])}}
                      	<div class="col-sm-9">
                      		{{ Form::text('address',isset($hotel_info->address) ? $hotel_info->address : '' ,['class'=>'form-control','id'=>'address','required'=>true])}}
                      		@if($errors->has('address'))
                      		<span class="alert-danger">{{ $errors->first('address') }}</span>
                      		@endif
                      	</div>		
                      </div>
                      <div class="form-group row">
                        {{ Form::label('summary','Summary:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::textarea('summary',isset($hotel_info->summary) ? $hotel_info->summary : ''  ,['class'=>'form-control','id'=>'summary','rows'=>4,'style'=>'resize:none'])}}
                          @if($errors->has('summary'))
                          <span class="alert-danger">{{ $errors->first('summary') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('description','Description:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::textarea('description',@$hotel_info->description ,['class'=>'form-control','id'=>'description','required'=>true,'rows'=>8,'style'=>'resize:none'])}}
                          @if($errors->has('description'))
                          <span class="alert-danger">{{ $errors->first('description') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                      	{{ Form::label('image','Thumbnail:',['class'=>'col-sm-3'])}}
                      	<div class="col-sm-9">
                      		{{ Form::file('image',['id'=>'image' ])}}
                      		@if($errors->has('image'))
                      		<span class="alert-danger">{{ $errors->first('image') }}</span>
                      		@endif
                          @if(isset($hotel_info->image) && file_exists(public_path().'/uploads/hotel-thumbnails/'.$hotel_info->image))
                          <img src="{{asset('/uploads/hotel-thumbnails/'.$hotel_info->image)}}" class="img img-responsive img-thumbnail" style="width: 400px;">
                          @endif
                      	</div>		
                      </div>
                      <div class="form-group row">
                        {{ Form::label('images','Hotel Images:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::file('images[]',['id'=>'images', 'accept'=>'image/*','multiple'=>true])}}
                          @if($errors->has('images'))
                          <span class="alert-danger">{{ $errors->first('images') }}</span>
                          @endif
                          
                          @if(isset($hotel_images) && !empty($hotel_images))
                          @foreach($hotel_images as $key => $value)
                          @if(file_exists(public_path().'/uploads/hotel-images/'.$hotel_images[$key]->image))
                          <img src="{{asset('/uploads/hotel-images/'.$hotel_images[$key]->image)}}" class="img img-responsive img-thumbnail" style="width: 200px;">
                          {{ Form::checkbox('checkbox[]',$hotel_images[$key]->image)}}Delete
                          @endif
                          @endforeach
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                      	{{ Form::label('submit','Submit:',['class'=>'col-sm-3'])}}
                      	<div class="col-sm-9">
                      		{{ Form::button('<i class="fas fa-paper-plane"></i> Submit',['id'=>'submit','class'=>'btn btn-success','type'=>'submit'])}}
                          @if(!isset($hotel_info))
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