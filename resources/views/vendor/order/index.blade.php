@extends('layouts.template')
@section('content')
     <div class="">
     	<div class="row">
           	<div class="page-title">
              <div class="title_left">
                <h3>Order Management</h3>
              </div>
              <div class="title_right">
                <a href="#" class="btn btn-success pull-right"><i class="fas fa-plus"></i>Add Activity</a>		
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
           		           <th>Hotel Id</th>
                         <th>Status</th>
                         <th>Quantity</th>
                         <th>Amount</th>
           		           <th>Arrival Date</th>
                         <th>Departure Date</th>
           		           <th>Action</th>
           		        </thead>
           		        <tbody>
           			        @if(isset($data) && !empty($data))
                          @foreach($data as $key=>$order_info)
                           <tr>  
                             <td>{{($key+1)}}</td>
                             <td>{{$order_info['cart_id']}}</td>
                             <td>{{$order_info['hotel_id']}}</td>
                             <td>{{ucfirst($order_info['status'])}}</td>
                             <td>{{$order_info['quantity']}}</td>
                             <td>{{$order_info['amount']}}</td>
                             <td>{{$order_info['check_in']}}</td>
                             <td>{{$order_info['check_out']}}</td>
                             <td>
                               <a href="{{route('userorder.edit',$order_info->id)}}" class="btn btn-success">Cancel Order</a>
                               <form onsubmit="return confirm('Are you sure you want to delete this banner')" action="{{route('userorder.destroy',$order_info->id)}}" method="POST">
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