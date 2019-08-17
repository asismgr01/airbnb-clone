@extends('layouts.template')
@section('content')
     <div class="">
     	<div class="row">
           	<div class="page-title">
              <div class="title_left">
                <h3>Room Management</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <table class="table jambo_table">
           		        <thead>
           		           <th>S.No</th>
                         <th>Title</th>
           		           <th>Room Type</th>
           		           <th>HoteL Name</th>
                         <th>Price</th>
                         <th>Size</th>
                         <th>Status</th>
           		           <th>Action</th>
           		        </thead>
           		        <tbody>
           			        @if(isset($data))
                          @foreach($data as $key=>$room_info)
                           <tr>
                             <td>{{($key+1)}}</td>
                             <td><a href="">{{ $room_info->title }}</a></td>
                             <td>{{ucfirst($room_info->room_type)}}</td>
                             <td>{{$room_info->hotel_info->hotel_name}}</td>
                             <td>{{ucfirst($room_info->price)}}</td>
                             <td>{{ucfirst($room_info->size)}}</td>
                             <td>{{ucfirst($room_info->status)}}</td>        
                             <td>
                               <a href="{{route('adminroom.edit',$room_info->id)}}" class="btn btn-success"><i class="fas fa-pen"></i></a>
                               <form onsubmit="return confirm('Are you sure you want to delete this banner')" action="{{route('adminroom.destroy',$room_info->id)}}" method="POST">
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