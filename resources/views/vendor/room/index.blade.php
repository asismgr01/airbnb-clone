@extends('layouts.template')
@section('content')
     <div class="">
     	<div class="row">
           	<div class="page-title">
              <div class="title_left">
                <h3>Room Management</h3>
              </div>
              <div class="title_right">
                <a href="{{route('room.create')}}" class="btn btn-success pull-right"><i class="fas fa-plus"></i>Add Room</a>		
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
           		           <th>Action</th>
           		        </thead>
           		        <tbody>
           			        @if(isset($data))
                          @foreach($data as $key=>$room_info)
                           <tr>
                             <td>{{($key+1)}}</td>
                             <td><a href="">{{ $room_info->title }}</a></td>
                             <td>{{$room_info->room_type}}</td>
                             <td>{{$room_info->hotel_info->hotel_name}}</td>
                             <td>{{ucfirst($room_info->price)}}</td>
                             <td>{{ucfirst($room_info->size)}}</td>        
                             <td>
                               <a href="{{route('room.edit',$room_info->id)}}" class="btn btn-success"><i class="fas fa-pen"></i></a>
                               <form onsubmit="return confirm('Are you sure you want to delete this banner')" action="{{route('room.destroy',$room_info->id)}}" method="POST">
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
     <button type="submit" id="click">Click</button>
@endsection
@section('script')
 <script>
   /*function display(){
      $.ajax({
         url: "{{route('ajax')}}",
         type: "POST",
         data: {
           _token: "{{ csrf_token() }}",
         }
         success:function(response){
           if (typeof(response)! = "object" ) {
                 response=$.parseJSON(response);
           }
           if (response.success == true) {
              console.log('success');
           }else{
              console.log('failed');
           }
         }
      });
   }*/
   $(document).ready(function(){
      $("#click").click(function(){
           $.ajax({
           url: "{{route('ajax')}}",
           type: "POST",
           data: {
             _token: "{{ csrf_token() }}",
           }
           success:function(response){
             if (typeof(response)! = "object" ) {
                   response=$.parseJSON(response);
             }
           if (response.success == true) {
                console.log('success');
             }else{
                console.log('failed');
             }
           }
        });
      });
   });
 </script>
@endsection