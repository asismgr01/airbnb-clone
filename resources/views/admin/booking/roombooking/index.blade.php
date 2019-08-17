@extends('layouts.template')
@section('content')
     <div class="">
      <div class="row">
            <div class="page-title">
              <div class="title_left">
                <h3>Room Booking Management</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <?php flash(); ?>
                    <table class="table jambo_table">
                      <thead>
                         <th>S.No</th>
                         <th>Cart Id</th>
                         <th>Hotel</th>
                         <th>Room</th>
                         <th>User</th>
                         <th>City</th>
                         <th>Check In</th>
                         <th>Check Out</th>
                         <th>Quantity</th>
                         <th>Amount</th>
                         <th>Status</th>
                         <th>Action</th>
                      </thead>
                      <tbody>
                        @if(isset($data))
                          @foreach($data as $key=>$booking_info)
                           <tr>  
                             <td>{{($key+1)}}</td>
                             <td>{{$booking_info->cart_id}}</td>
                             <td>{{$booking_info->hotel->hotel_name}}</td>
                             <td>{{$booking_info->room->title}}</td>
                             <td>{{$booking_info->user->email}}</td>
                             <td>{{ucfirst($booking_info->city)}}</td>
                             <td>{{$booking_info->check_in}}</td>
                             <td>{{$booking_info->check_out}}</td>
                             <td>{{$booking_info->quantity}}</td>
                             <td>{{$booking_info->amount}}</td>
                             <td>{{ucfirst($booking_info->status)}}</td>         
                             <td>
                               <a href="{{route('roombooking.edit',$booking_info->id)}}" class="btn btn-success"><i class="fas fa-pen"></i></a>
                               <form onsubmit="return confirm('Are you sure you want to delete this banner')" action="{{route('roombooking.destroy',$booking_info->id)}}" method="POST">
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