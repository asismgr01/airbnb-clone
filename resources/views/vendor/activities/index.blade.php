@extends('layouts.template')
@section('content')
     <div class="">
     	<div class="row">
           	<div class="page-title">
              <div class="title_left">
                <h3>Activities Management</h3>
              </div>
              <div class="title_right">
                <a href="{{route('activities.create')}}" class="btn btn-success pull-right"><i class="fas fa-plus"></i>Add Activity</a>		
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
           		           <th>Category</th>
                         <th>Status</th>
                         <th>City</th>
                         <th>Price</th>
           		           <th>Duration</th>
           		           <th>Action</th>
           		        </thead>
           		        <tbody>
           			        @if(isset($data))
                          @foreach($data as $key=>$activities_info)
                           <tr>  
                             <td>{{($key+1)}}</td>
                             <td>{{$activities_info->title}}</td>
                             <td>{{ucfirst($activities_info->category)}}</td>
                             <td>{{ucfirst($activities_info->status)}}</td>
                             <td>{{ucfirst($activities_info->city)}}</td>
                             <td>{{$activities_info->price}}</td>
                             <td>{{$activities_info->duration}}</td>
                             <td>
                               <a href="{{route('activities.edit',$activities_info->id)}}" class="btn btn-success"><i class="fas fa-pen"></i></a>
                               <form onsubmit="return confirm('Are you sure you want to delete this banner')" action="{{route('activities.destroy',$activities_info->id)}}" method="POST">
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