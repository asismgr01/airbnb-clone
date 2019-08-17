@extends('layouts.template')
@section('content')
     <div class="">
      <div class="row">
            <div class="page-title">
              <div class="title_left">
                <h3>Activity Management</h3>
              </div>
              <div class="title_right">
                <a href="{{route('activitycategory.create')}}" class="btn btn-success pull-right"><i class="fas fa-plus"></i>Add Activity</a>   
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <?php flash(); ?>
                    <table class="table jambo_table">
                      <thead>
                         <th>S.No</th>
                         <th>Category</th>
                         <th>Status</th>
                         <th>Image</th>
                         <th>Action</th>
                      </thead>
                      <tbody>
                        @if(isset($data))
                          @foreach($data as $key=>$activity_info)
                           <tr>  
                             <td>{{($key+1)}}</td>
                             <td>{{$activity_info->category}}</td>
                             <td>{{ucfirst($activity_info->status)}}</td>
                             @if(file_exists(public_path().'/uploads/activitycategory-images/'.$activity_info->image))
                             <td>
                               <img src="{{asset('uploads/activitycategory-images/'.'thumbnail-'.$activity_info->image)}}" class="img img-thumbnail">
                             </td>
                             @endif
                             <td>
                               <a href="{{route('activitycategory.edit',$activity_info->id)}}" class="btn btn-success"><i class="fas fa-pen"></i></a>
                               <form onsubmit="return confirm('Are you sure you want to delete this banner')" action="{{route('activitycategory.destroy',$activity_info->id)}}" method="POST">
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