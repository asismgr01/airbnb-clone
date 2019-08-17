@extends('layouts.template')
@section('content')
     <div class="">
      <div class="row">
            <div class="page-title">
              <div class="title_left">
                <h3>User Management</h3>
              </div>
              <div class="title_right">
                <a href="{{route('vendor.create')}}" class="btn btn-success pull-right"><i class="fas fa-plus"></i>Add Activity</a>   
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <?php flash(); ?>
                    <table class="table jambo_table">
                      <thead>
                         <th>S.No</th>
                         <th>Name</th>
                         <th>Email</th>
                         <th>Role</th>
                         <th>Mobile No.</th>
                         <th>Address</th>
                         <th>Status</th>
                         <th>Action</th>
                      </thead>
                      <tbody>
                        @if(isset($data))
                          @foreach($data as $key=>$user_info)
                           <tr>  
                             <td>{{($key+1)}}</td>
                             <td>{{$user_info->name}}</td>
                             <td>{{$user_info->email}}</td>
                             <td>{{ucfirst($user_info->role)}}</td>
                             <td>{{$user_info->mobile_no}}</td>
                             <td>{{$user_info->address}}</td>
                             <td>{{ucfirst($user_info->status)}}</td>
                             <td>
                               <a href="{{route('adminuser.edit',$user_info->id)}}" class="btn btn-success"><i class="fas fa-pen"></i></a>
                               <form onsubmit="return confirm('Are you sure you want to delete this banner')" action="{{route('adminuser.destroy',$user_info->id)}}" method="POST">
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