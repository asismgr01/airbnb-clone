@extends('layouts.home')
@section('meta')
    <meta content="sasto, nepali ecommerce, ecommerce, nepal, online shopping, first ecommerece of nepal, mt. everest, lumbini, nepal, politics, electronics" name="keywords">
    <meta content="The one and only nepali ecommerce website which provides you all sort of goods in an afforadable price with in nepal." name="description">

    <meta content="The one and only nepali ecommerce website which provides you all sort of goods in an afforadable price with in nepal." property="og:description">
    <meta content="Ecommerce.com, the first nepali online ecommerce portal" property="og:title">
    <meta content="{{ asset('assets/home/images/icons/logo-01.png') }}" property="og:image">
    <meta content="website" property="og:type">
    <meta content="" property="og:url">
@endsection
@section('menu')
    @include('site.home.menu')
@endsection 
@section('content')

<!-- Slider -->
	<section class="section-slide">
		<div class="wrap-slick1">
			<div class="slick1">
				<div class="item-slick1" style="background-image: url({{asset('coza/images/slide-01.jpg')}} );">
				</div>

				<div class="item-slick1" style="background-image: url({{asset('coza/images/slide-02.jpg')}} );">
				</div>

				<div class="item-slick1" style="background-image: url({{asset('coza/images/slide-03.jpg')}} );">
				</div>
			</div>

		</div>
		<div class="container">
			<div class="searchbox">
				<div class="_zzbinmg">
					<h1>Book unique homes and experiences.</h1>
				</div>
				<form method="GET" action="{{route('search')}}">
                  <div class="form-group">
                    <label for="formGroupExampleWhere"><b>WHERE</b></label>
                    <select class="form-control" id="city">
                    	@foreach($data as $value)
                    	<option value="{{$value['city']}}">{{$value['city']}}</option>
                    	@endforeach
                    </select>
                  </div>
                  <div class="form-group">
                  	<div class="form-row">
                      <div class="col">
                      	<label for="formGroupExampleCheck-in"><b>CHECK-In</b></label>
                        <input type="date" class="form-control" placeholder="">
                      </div>
                      <div class="col">
                      	<label for="formGroupExampleCheck-out"><b>CHECK-OUT</b></label>
                        <input type="date" class="form-control" placeholder="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="formGroupExamplePerson"><b>PERSON</b></label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
                  </div>
                  <button class="btn btn-danger"><b>Search</b></button>
                </form>
			</div>
		</div>
	</section>

    <!--Explore -->
   <div class="sec-banner bg0 p-t-80 p-b-50">
		<div class="container">
			<div class="p-b-10">
				<h4 class="" style=" color: #222222;"><b>
					Explore AirBnb Clone
				</b>
				</h4>
			</div>
			<div class="row">
				<div class="col-md-6 col-xl-3 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="{{asset('coza/images/banner-01.jpg')}}" alt="IMG-BANNER">

						<a href="{{route('hotels')}}" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<div class="block1-txt-child2 p-b-4 trans-05">
								    <span class="block1-name ltext-102 trans-04 p-b-8">
									    Hotels
								    </span>

							    </div>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Explore Now
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-md-6 col-xl-3 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="{{asset('coza/images/banner-02.jpg')}}" alt="IMG-BANNER">

						<a href="{{route('experiences')}}" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<div class="block1-txt-child2 p-b-4 trans-05">
								    <span class="block1-name ltext-102 trans-04 p-b-8">
									    Experiences
								    </span>

							    </div>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
								    Explore Now
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-md-6 col-xl-3 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="{{asset('coza/images/banner-03.jpg')}}" alt="IMG-BANNER">

						<a href="product.html" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<div class="block1-txt-child2 p-b-4 trans-05">
								    <span class="block1-name ltext-102 trans-04 p-b-8">
									    Resturants
								    </span>

							    </div>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Explore Now
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-md-6 col-xl-3 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="{{asset('coza/images/banner-03.jpg')}}" alt="IMG-BANNER">

						<a href="product.html" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child2 p-b-4 trans-05">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									Homes
								</span>

							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Explore Now
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

   <!-- top Destination -->
	<section class="sec-relate-product bg0 p-t-45 p-b-105">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					Top Destination
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
					@if(isset($data) && !empty($data))
                    @foreach($data as $data_info)
					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						<!-- Block2 -->
						<div class="block1 wrap-pic-w">
							@if($data_info['image'] && file_exists(public_path().'/uploads/city-images/'.$data_info['image']))
						    <img src="{{asset('/uploads/city-images/thumbnail-'.$data_info['image'])}}" alt="IMG-PRODUCT">
						    @endif

						    <a href="product.html" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							    <div class="block1-txt-child1 flex-col-l">
								    <div class="block1-txt-child2 p-b-4 trans-05">
								        <span class="block1-name ltext-102 trans-04 p-b-8">
									        {{ $data_info['city'] }}
								        </span>
							        </div>
							    </div>

							    <div class="block1-txt-child2 p-b-4 trans-05">
							    	<span class="block1-info stext-102 trans-04">
									         {{ $data_info['count']}} bookings
								        </span>
								    <div class="block1-link stext-101 cl0 trans-09">
									    Explore Now
								    </div>
							    </div>
						    </a>
					    </div>
					</div>
					@endforeach
                    @endif
				</div>
			</div>
		</div>
	</section>


	<!-- Hotels -->
	<section class="bg0 p-t-23 p-b-140">
        <div class="container">
        	<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					Hotels Around Country
				</h3>
			</div>
			<div class="flex-w flex-sb-m p-b-52">
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
				@if(isset($hotel) && !empty($hotel))
				@foreach($hotel as $hotel)
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img src="{{asset('uploads/hotel-thumbnails/'.'thumbnail-'.$hotel->image)}}" alt="IMG-BANNER">
							
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6" style="color: #767676;">
									<b>{{ $hotel->address}} - {{ ucfirst($hotel->city) }}</b>
								</a>
                                <h5><a href="{{route('product_detail',$hotel->slug)}}">{{ $hotel->hotel_name }}</a></h5>
								<span class="stext-105 cl3">
									${{ $hotel->price }} per night
								</span>
								<span class="stext-105 cl3">
									{{ $hotel->booking }} times booked
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
									<img class="icon-heart1 dis-block trans-04" src="{{asset('/coza/images/icons/icon-heart-01.png')}}" alt="ICON">
									<img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{asset('/coza/images/icons/icon-heart-02.png')}}" alt="ICON">
								</a>
							</div>
						</div>
					</div>
				</div>
				@endforeach
				@endif
			</div>

			<!-- Show All Hotels -->
			<div class="flex-c-m flex-w w-full p-t-45">
				<a href="{{route('hotels')}}" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					Show All Hotels
				</a>
			</div>
        </div>
    </section>

	<!-- Experiences -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					Experiences 
				</h3>
			</div>
            <div class="flex-w flex-sb-m p-b-52">
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
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							@if(isset($activityimage[$key]) && !empty($activityimage[$key]))
							   @if(file_exists(public_path().'/uploads/activity-images/'.$activityimage[$key][0]))
							      <img src="{{asset('/uploads/activity-images/'.$activityimage[$key][0])}}" alt="IMG-PRODUCT">
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
								    <a href="{{route('experiences_detail',$activity->slug)}}">
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
				<a href="{{route('experiences')}}" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					Show All Experiences
				</a>
			</div>
		</div>
	</section>
@endsection
