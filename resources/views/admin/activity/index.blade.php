@extends('layouts.template')
@section('content')
     <div class="">
      <div class="row">
            <div class="page-title">
              <div class="title_left">
                <h3>Activity Management</h3>
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
                         <th>Price</th>
                         <th>Status</th>
                         <th>Discount</th>
                         <th>Duration</th>
                         <th>City</th>
                         <th>Action</th>
                      </thead>
                      <tbody>
                        @if(isset($data))
                          @foreach($data as $key=>$activity_info)
                           <tr>  
                             <td>{{($key+1)}}</td>
                             <td>{{$activity_info->title}}</td>
                             <td>{{$activity_info->category}}</td>
                             <td>{{$activity_info->price}}</td>
                             <td>{{ucfirst($activity_info->status)}}</td>
                             <td>{{($activity_info->discount) ? $activity_info->discount : 'Null'}}</td>
                             <td>{{$activity_info->duration}}</td>
                             <td>{{ucfirst($activity_info->city)}}</td>            
                             <td>
                               <a href="{{route('adminactivity.edit',$activity_info->id)}}" class="btn btn-success"><i class="fas fa-pen"></i></a>
                               <form onsubmit="return confirm('Are you sure you want to delete this banner')" action="{{route('adminactivity.destroy',$activity_info->id)}}" method="POST">
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