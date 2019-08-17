@extends('layouts.template')
@section('content')
     <div class="">
     	<div class="row">
           	<div class="page-title">
              <div class="title_left">
                <h3>Banner Management</h3>
              </div>
              <div class="title_right">
                <a href="{{route('banner.create')}}" class="btn btn-success pull-right"><i class="fas fa-plus"></i>Add Banner</a>		
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <?php flash(); ?>
                    <table class="table jambo_table">
           		        <thead>
           		           <th>S.No</th>
           	             <th>Title</th>
                         <th>Description</th>
                         <th>Link</th>
                         <th>Status</th>
                         <th>Added By</th>
                         <th>Image</th>
           		           <th>Action</th>
           		        </thead>
           		        <tbody>
           			        @if(isset($data))
                          @foreach($data as $key=>$banner_info)
                           <tr>  
                             <td>{{($key+1)}}</td>
                             <td>{{ $banner_info->title }}</td>
                             <td>{{ $banner_info->description }}</td>
                             <td>{{ $banner_info->link }}</td>
                             <td>{{ ucfirst($banner_info->status) }}</td>
                             <td>{{ $banner_info->added_by }}</td>
                             <td>
                               @if($banner_info->banner !=null && file_exists(public_path().'/uploads/banner/thumbnail-'.$banner_info->banner))
                               <img style="width: 200px;" src="{{asset('/uploads/banner/thumbnail-'.$banner_info->banner)}}" alt="" class="img img-responsive img-thumbnail">
                               @else
                                 No Image 
                               @endif
                             </td>
                             <td>
                               <a href="{{route('banner.edit',$banner_info->id)}}" class="btn btn-success"><i class="fas fa-pen"></i></a>
                               <form onsubmit="return confirm('Are you sure you want to delete this banner')" action="{{route('banner.destroy',$banner_info->id)}}" method="POST">
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