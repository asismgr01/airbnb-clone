@extends('layouts.home')
@section('menu')
    @include('site.home.menu1')
@endsection
@section('content')
   <!-- Product -->
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
        @include('site.home.category')
        @include('site.home.product-list')
        </div>
    </section>
@endsection
@section('script')
   <script type="text/javascript">
   	$(document).ready(function(){
      $("#click").click(function(){
           $.ajax({
           url: "{{route('ajaxcall')}}",
           type: "POST",
           data: {
             _token: "{{ csrf_token() }}"
           },
           success:function(response){
             if (typeof(response) != "object" ) {
                   response=$.parseJSON(response);
             }
           if (response.success == true) {
                console.log(response.data);
             }else{
                console.log('failed');
             }
           }
        });
      });
   });
   </script>
@endsection