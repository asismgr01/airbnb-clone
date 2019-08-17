@extends('layouts.template')
@section('content')
     <div class="">
     	<div class="row">
           	<div class="page-title">
              <div class="title_left">
                <h3>Cities Management</h3>
              </div>
              <div class="title_right">
                <a href="{{route('city.create')}}" class="btn btn-success pull-right"><i class="fas fa-plus"></i>Add City</a>		
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <?php flash(); ?>
                    <table class="table jambo_table">
           		        <thead>
           		           <th>S.No</th>
           		           <th>City</th>
                         <th>Summary</th>
                         <th>Status</th>
                         <th>Image</th>
           		           <th>Action</th>
           		        </thead>
           		        <tbody>
           			        @if(isset($data))
                          @foreach($data as $key=>$cities_info)
                           <tr>  
                             <td>{{($key+1)}}</td>
                             <td>{{ucfirst($cities_info->city)}}</td>
                             <td>{!! $cities_info->summary !!}</td>
                             <td>{{ucfirst($cities_info->status)}}</td>
                             <td>
                               @if($cities_info->image !=null && file_exists(public_path().'/uploads/city-images/thumbnail-'.$cities_info->image))
                               <img style="width: 200px;" src="{{asset('/uploads/city-images/thumbnail-'.$cities_info->image)}}" alt="" class="img img-responsive img-thumbnail">
                               @else
                                 No Image 
                               @endif
                             </td>
                             <td>
                               <a href="{{route('city.edit',$cities_info->id)}}" class="btn btn-success"><i class="fas fa-pen"></i></a>
                               <form onsubmit="return confirm('Are you sure you want to delete this banner')" action="{{route('city.destroy',$cities_info->id)}}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                  </button>
                               </form>
                             </td>
                           </tr>
                          @endforeach
                        @else
                         <tr>
                           <td><b>No data to show.</b></td>
                         </tr>
                        @endif
           		        </tbody>
           	        </table>                 
                </div>
              </div>
            </div>
           </div>            
     </div>
@endsection