@extends('layouts.home')
@section('menu')
    @include('site.home.menu1')
@endsection
@section('content')
    <!-- Experiences -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					Experiences 
				</h3>
			</div>
            <div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						All Products
					</button>
                    
                    @if(isset($activity_cat) && !empty($activity_cat))
                    @foreach($activity_cat as $activity_cat)
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{ $activity_cat->category }}">
						{{ $activity_cat->category }}
					</button>
					@endforeach
					@endif
				</div>

				<div class="flex-w flex-c-m m-tb-10">

					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Search
					</div>
				</div>
				
				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
					</div>	
				</div>
			</div>
            <div class="row isotope-grid">
            	@if(isset($activity) && !empty($activity))
            	@foreach($activity as $key => $activity)
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{ $activity['category'] }}">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							@if(isset($activity->activity_images[0]->image) && !empty($activity->activity_images[0]->image))
							   @if(file_exists(public_path().'/uploads/activity-images/'.$activity->activity_images[0]->image))
							      <img src="{{asset('/uploads/activity-images/'.$activity->activity_images[0]->image)}}" alt="IMG-PRODUCT">
							   @endif 
							@else
							<img src="{{asset('coza/images/product-01.jpg')}}" alt="IMG-PRODUCT">
							@endif
                            
							
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6" style="color: #767676;">
									<b>{{ $activity->category }} - {{ ucfirst($activity->city) }}</b>
								</a>
								<h5>
								    <a href="{{route('experiences_detail',$activity->id)}}">
									    {{ $activity->title}}
								    </a>
							    </h5>

								<span class="stext-105 cl3">
									${{$activity->price}} per person
								</span>
								<span class="stext-105 cl3">
									{{$activity->duration}}
								</span>
							</div>             						
						</div>
					</div>
				</div>
				@endforeach
				@endif
			</div>

			<!-- Show All Experiences -->
			<div class="flex-c-m flex-w w-full p-t-45">
				<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04" onclick="load_experiences()">
					Show More
				</a>
			</div>
		</div>
	</section>
@endsection
@section('script')
   <script type="text/javascript">
   	function load_experiences(){
   		$.ajax({
   			url: "{{route('load_experiences')}}",
   			type: "GET",
   			data:{
   				_token: "{{ csrf_token() }}"
   			},
   			success :function(response){
               if (typeof(response) != "object") {
               	   response = $.parseJSON(response); 
               }
               if (response.status == true) {
                   console.log(response.data);
               }
   			}
   		});
   	} 
   </script>
@endsection