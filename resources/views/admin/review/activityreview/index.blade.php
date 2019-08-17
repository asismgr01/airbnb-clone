@extends('layouts.template')
@section('content')
     <div class="">
      <div class="row">
            <div class="page-title">
              <div class="title_left">
                <h3>Review Management</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <?php flash(); ?>
                    <table class="table jambo_table">
                      <thead>
                         <th>S.No</th>
                         <th>Activity Id</th>
                         <th>Email</th>
                         <th>Rating</th>
                         <th>Review</th>
                         <th>Status</th>
                         <th>Action</th>
                      </thead>
                      <tbody>
                        @if(isset($data))
                          @foreach($data as $key=>$review_info)
                           <tr>  
                             <td>{{($key+1)}}</td>
                             <td>{{$review_info->activity->title}}</td>
                             <td>{{$review_info->email}}</td>
                             <td>{{ucfirst($review_info->rate)}}</td>
                             <td>{{$review_info->review}}</td>
                             <td>{{ucfirst($review_info->status)}}</td>
                             <td>
                               <a href="{{route('activityreview.edit',$review_info->id)}}" class="btn btn-success"><i class="fas fa-pen"></i></a>
                               <form onsubmit="return confirm('Are you sure you want to delete this banner')" action="{{route('activityreview.destroy',$review_info->id)}}" method="POST">
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