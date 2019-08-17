@extends('layouts.template')
@section('content')
     <div class="">
      <div class="row">
            <div class="page-title">
              <div class="title_left">
                <h3>Hotel Management</h3>
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
                         <th>Hotel Type</th>
                         <th>Status</th>
                         <th>City</th>
                         <th>Address</th>
                         <th>Image</th>
                         <th>Action</th>
                      </thead>
                      <tbody>
                        @if(isset($data))
                          @foreach($data as $key=>$hotel_info)
                           <tr>
                             <td>{{($key+1)}}</td>
                             <td>{{$hotel_info->hotel_name}}</td>
                             <td>{{ucfirst($hotel_info->type)}}</td>
                             <td>{{ucfirst($hotel_info->status)}}</td>
                             <td>{{ucfirst($hotel_info->city)}}</td>
                             <td>{{$hotel_info->address}}</td>
                             <td>
                               @if($hotel_info->image !=null && file_exists(public_path().'/uploads/hotel-thumbnails/thumbnail-'.$hotel_info->image))
                               <img style="width: 400px, height:140px;" src="{{asset('/uploads/hotel-thumbnails/thumbnail-'.$hotel_info->image)}}" alt="" class="img img-responsive img-thumbnail">
                               @else
                                 No Image 
                               @endif
                             </td>
                             <td>
                               <a href="{{route('adminhotel.edit',$hotel_info->id)}}" class="btn btn-success"><i class="fas fa-pen"></i></a>
                               <form onsubmit="return confirm('Are you sure you want to delete this banner')" action="{{route('adminhotel.destroy',$hotel_info->id)}}" method="POST">
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