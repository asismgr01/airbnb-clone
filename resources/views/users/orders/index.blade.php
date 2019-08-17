@extends('layouts.template')
@section('content')
     <div class="">
     	<div class="row">
           	<div class="page-title">
              <div class="title_left">
                <h3>Booking History</h3>
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
                         <th>Status</th>
                         <th>Quantity</th>
                         <th>Amount</th>
           		           <th>Arrival Date</th>
                         <th>Departure Date</th>
           		           <th>Action</th>
           		        </thead>
           		        <tbody>
           			        @if(isset($data))
                          @foreach($data as $key=>$order_info)
                           <tr>  
                             <td>{{($key+1)}}</td>
                             <td>{{$order_info->cart_id}}</td>
                             <td>{{$order_info->hotel->hotel_name}}</td>
                             <td>{{$order_info->room->title}}</td>
                             <td>{{ucfirst($order_info->status)}}</td>
                             <td>{{$order_info->quantity}}</td>
                             <td>{{$order_info->amount}}</td>
                             <td>{{$order_info->check_in}}</td>
                             <td>{{$order_info->check_out}}</td>
                             <td>
                               @if($order_info->status == 'cancelled')
                               <a href="#" class="btn btn-success" disabled>Cancelled</a>
                               @else
                               <a href="#" onclick="cancel(this)" data-order_id="{{$order_info->id}}" class="btn btn-success">Cancel Booking</a>
                               @endif
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
@section('script')
<script type="text/javascript">
  function cancel(elem){
      var order_id = $(elem).data('order_id');
      //console.log(order_id);
      $.ajax({
         url: "{{route('cancel')}}",
         type: "GET",
         data:{
            _token: "{{ csrf_token() }}",
            order_id: order_id
         },
         success:function(response){
            if (response.status == true) {
              //window.alert("Booking Cancelled Successfully");
              window.location.reload(true);
            }
         }
      });
  }
</script>
@endsection