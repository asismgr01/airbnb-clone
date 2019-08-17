@extends('layouts.template')
@section('content')
   <div class="">
      <div class="row">
            <div class="page-title">
              <div class="title_left">
                <h3>Activity {{$title}}</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>Activity {{$title}} Form</h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     @if(isset($activities_info) && !empty($activities_info))
                        {{Form::open(['url'=>route('adminactivity.update',$activities_info->id),'class'=>'form','enctype'=>'multipart/form-data'])}}
                        @method('PUT')
                      @else
                        {{Form::open(['url'=>route('adminactivity.store'),'class'=>'form','enctype'=>'multipart/form-data'])}}
                      @endif
                      <div class="form-group row">
                        {{ Form::label('title','Title:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::text('title',isset($activities_info->title) ? $activities_info->title : '' ,['class'=>'form-control','id'=>'title','required'=>true])}}
                          @if($errors->has('title'))
                          <span class="alert-danger">{{ $errors->first('title') }}</span>
                          @endif
                        </div>    
                      </div>   
                      <div class="form-group row">
                        {{ Form::label('category','Category:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::select('category',@$activity_category,@$activities_info->category,['class'=>'form-control','id'=>'category','required'=>true])}}
                          @if($errors->has('category'))
                          <span class="alert-danger">{{ $errors->first('category') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('price','Price:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::text('price',isset($activities_info->price) ? $activities_info->price : '' ,['class'=>'form-control','id'=>'price','required'=>true])}}
                          @if($errors->has('price'))
                          <span class="alert-danger">{{ $errors->first('price') }}</span>
                          @endif
                        </div>    
                      </div> 
                      <div class="form-group row">
                        {{ Form::label('discount','Discount:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::text('discount',isset($activities_info->discount) ? $activities_info->discount : '' ,['class'=>'form-control','id'=>'discount'])}}
                          @if($errors->has('discount'))
                          <span class="alert-danger">{{ $errors->first('discount') }}</span>
                          @endif
                        </div>    
                      </div>  
                      <div class="form-group row">
                        {{ Form::label('duration','Duration:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::text('duration',isset($activities_info->duration) ? $activities_info->duration : '' ,['class'=>'form-control','id'=>'duration','required'=>true])}}
                          @if($errors->has('duration'))
                          <span class="alert-danger">{{ $errors->first('duration') }}</span>
                          @endif
                        </div>    
                      </div>  
                      <div class="form-group row">
                        {{ Form::label('status','Status:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::select('status',['active'=>'Active','inactive'=>'Inactive'],@$activities_info->status,['class'=>'form-control','id'=>'status','required'=>true])}}
                          @if($errors->has('status'))
                          <span class="alert-danger">{{ $errors->first('status') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('city','City:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::select('city',['kathmandu'=>'Kathmandu','pokhara'=>'Pokhara','chitwan'=>'Chitwan','dharan'=>'Dharan','butwal'=>'Butwal','nepalgunj'=>'Nepalgunj'],isset($activities_info->city) ? $activities_info->city : '' ,['class'=>'form-control','id'=>'city','required'=>true])}}
                          @if($errors->has('city'))
                          <span class="alert-danger">{{ $errors->first('city') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('notice','Notice:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::textarea('notice',isset($activities_info->notice) ? $activities_info->notice : '' ,['class'=>'form-control','id'=>'notice','rows'=>4,'style'=>'resize:none'])}}
                          @if($errors->has('notice'))
                          <span class="alert-danger">{{ $errors->first('notice') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('summary','Summary:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::textarea('summary',isset($activities_info->summary) ? $activities_info->summary : ''  ,['class'=>'form-control','id'=>'summary','rows'=>4,'style'=>'resize:none'])}}
                          @if($errors->has('summary'))
                          <span class="alert-danger">{{ $errors->first('summary') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('description','Description:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::textarea('description',@$activities_info->description ,['class'=>'form-control','id'=>'description','required'=>true,'rows'=>8,'style'=>'resize:none'])}}
                          @if($errors->has('description'))
                          <span class="alert-danger">{{ $errors->first('description') }}</span>
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('images','Activity Images:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::file('images[]',['id'=>'images', 'accept'=>'image/*','multiple'=>true])}}
                          @if($errors->has('images'))
                          <span class="alert-danger">{{ $errors->first('images') }}</span>
                          @endif
                
                          @if(isset($activity_images) && !empty($activity_images))
                          @foreach($activity_images as $key => $value)
                          @if(file_exists(public_path().'/uploads/activity-images/'.$activity_images[$key]->image))
                          <img src="{{asset('/uploads/activity-images/'.$activity_images[$key]->image)}}" class="img img-responsive img-thumbnail" style="width: 200px;">
                          {{ Form::checkbox('checkbox[]',$activity_images[$key]->image)}}Delete
                          @endif
                          @endforeach
                          @endif
                        </div>    
                      </div>
                      <div class="form-group row">
                        {{ Form::label('submit','Submit:',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                          {{ Form::button('<i class="fas fa-paper-plane"></i> Submit',['id'=>'submit','class'=>'btn btn-success','type'=>'submit'])}}
                          @if(!isset($activities_info))
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