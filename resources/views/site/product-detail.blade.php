@extends('layouts.home')
@section('menu')
    @include('site.home.menu1')
@endsection
@section('content')
    
	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60">
	   @if(isset($hotel) && !empty($hotel))
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-8 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
                            @if(isset($hotel[0]->hotel_images) && !empty($hotel[0]->hotel_images))
							<div class="slick3 gallery-lb">
								@foreach($hotel[0]->hotel_images as $hotel_images)
								@if(isset($hotel_images->image) && file_exists(public_path().'/uploads/hotel-images/'.$hotel_images->image))
								<div class="item-slick3" data-thumb="{{asset('uploads/hotel-images/'.$hotel_images->image)}}">
									<div class="wrap-pic-w pos-relative">
										<img src="{{asset('uploads/hotel-images/'.$hotel_images->image)}}" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{asset('uploads/hotel-images/'.$hotel_images->image)}}">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
								@endif
								@endforeach
							</div>
							@else
                                <div class="item-slick3" data-thumb="{{asset('uploads/hotel-thumbnails/'.$hotel->image)}}">
									<div class="wrap-pic-w pos-relative">
										<img src="{{asset('uploads/hotel-thumbnails/'.$hotel->image)}}" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{asset('uploads/hotel-thumbnails/'.$hotel->image)}}">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
							@endif
						</div>
					</div>
				</div>
					
				<div class="col-md-6 col-lg-4 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							{{ $hotel[0]->hotel_name }}
						</h4>

						<span class="mtext-106 cl2">
							$58.79
						</span>

						<p class="stext-102 cl3 p-t-23">
							{!! $hotel[0]->summary !!}
						</p>

						<div class="col">
                      	  <label for="formGroupExampleCheck-in"><b>CHECK-In-Date</b></label>
                          <input type="date" class="form-control" placeholder="" name="check-in" id="check-in">
                        </div>
                        <div class="col">
                      	  <label for="formGroupExampleCheck-out"><b>CHECK-OUT-Date</b></label>
                          <input type="date" class="form-control" placeholder="" name="check-out" id="check-out">
                        </div>
						<!--  -->
						<div class="p-t-33">

							<div class="flex-w flex-r-m p-b-10">
								<div class="size-204 flex-w flex-m respon6-next">

									<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail" onclick="addTocart(this, 'quantity')" data-hotel_id="{{ $hotel[0]->id }}">
										Add to cart
									</button>
								</div>
							</div>	
						</div>

						<!--  -->
						<div class="flex-w flex-m p-l-100 p-t-40 respon7">


							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
								<i class="fa fa-facebook"></i>
							</a>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
								<i class="fa fa-twitter"></i>
							</a>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
								<i class="fa fa-google-plus"></i>
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="bor10 m-t-50 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item p-b-10">
							<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
						</li>

                       <li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#what'saround" role="tab">What's Around</a>
						</li>


						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews (1)</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content p-t-43">
						<!-- - -->
						<div class="tab-pane fade show active" id="description" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6">
									{!! $hotel[0]->description !!}
								</p>
							</div>
						</div>

                        <div class="tab-pane fade show active" id="what'saround" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6">
								
								</p>
							</div>
						</div>
						<!-- - -->
						<div class="tab-pane fade" id="reviews" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<div class="p-b-30 m-lr-15-sm">
										<!-- Review -->
										<div class="flex-w flex-t p-b-68">
											<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
												<img src="images/avatar-01.jpg" alt="AVATAR">
											</div>

											<div class="size-207">
												<div class="flex-w flex-sb-m p-b-17">
													<span class="mtext-107 cl2 p-r-20">
														Ariana Grande
													</span>

													<span class="fs-18 cl11">
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star-half"></i>
													</span>
												</div>

												<p class="stext-102 cl6">
													Quod autem in homine praestantissimum atque optimum est, id deseruit. Apud ceteros autem philosophos
												</p>
											</div>
										</div>

										@if(isset($review) && !empty($review))
										@foreach($review as $review)
										<div class="flex-w flex-t p-b-68">
											<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
												<img src="images/avatar-01.jpg" alt="AVATAR">
											</div>

											<div class="size-207">
												<div class="flex-w flex-sb-m p-b-17">
													<span class="mtext-107 cl2 p-r-20">
														{{ $review->user_info->name }}
													</span>

													<span class="fs-18 cl11">
														@for($i=0;$i<5;$i++)
														@if($i<$review->rate)
														<i class="zmdi zmdi-star"></i>
														@else
														<i class="zmdi zmdi-star-outline"></i>
														@endif
														@endfor
													</span>
												</div>

												<p class="stext-102 cl6">
													{{ $review->review }}
												</p>
											</div>
										</div>
										@endforeach
										@else
										  'No review'
										@endif
										
										@guest
										   <strong>
                                                To review this product Please
                                                <a href="{{ route('login') }}"> Login </a> or
                                                <a href="{{ route('signup') }}"> Register </a> first.
                                            </strong>
										@else
										<!-- Add review -->
										<form class="w-full" method="POST" action="{{route('hotelreview.store',['hotel_id' => $hotel[0]->id])}}">
											@csrf
											<h5 class="mtext-108 cl2 p-b-7">
												Add a review
											</h5>

											<p class="stext-102 cl6">
												Your email address will not be published. Required fields are marked *
											</p>

											<div class="flex-w flex-m p-t-50 p-b-23">
												<span class="stext-102 cl3 m-r-16">
													Your Rating
												</span>

												<span class="wrap-rating fs-18 cl11 pointer">
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<input class="dis-none" type="number" name="rating">
												</span>
											</div>

											<div class="row p-b-25">
												<div class="col-12 p-b-5">
													<label class="stext-102 cl3" for="review">Your review</label>
													<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
												</div>

												<div class="col-sm-6 p-b-5">
													<label class="stext-102 cl3" for="name">Name</label>
													<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name" value="{{Auth::user()->name }}">
												</div>

												<div class="col-sm-6 p-b-5">
													<label class="stext-102 cl3" for="email">Email</label>
													<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="email" name="email" value="{{ Auth::user()->email }}">
												</div>
											</div>

											<button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
												Submit
											</button>
										</form>
										@endguest
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        @endif

	</section>

	<!-- Rooms -->
	<section class="sec-relate-product bg0 p-t-45 p-b-105">
		<div class="container">
			<div class="p-b-45">
				<h3 class="ltext-106 cl5 txt-center">
					Rooms  Available
				</h3>
			</div>

            @if(isset($hotel[0]->rooms) && !empty($hotel[0]->rooms))
			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
					@foreach($hotel[0]->rooms as $key => $room)
					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								@if(file_exists(public_path().'/uploads/room-images/'.$room_images[$key]))
								    <img src="{{asset('uploads/room-images/'.$room_images[$key])}}" alt="IMG-PRODUCT">
								@else
								<img src="{{asset('coza/images/product-01.jpg')}}" alt="IMG-PRODUCT">
								@endif

                                <a href="#" onclick="example({{ $room->id }})" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
								    Quick View
							    </a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<!-- Anchor trigger modal -->
									<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"></a>
										{{ $room->title }}
									</a>
									<span class="stext-105 cl3" style="color: green;">
										@php
										   if($room->discount > 0){
                                              $actual = $room->price-($room->discount/100*$room->price);
                                              echo "<del>"."$".$room->price."</del>";
										      echo "$".$actual;
										}
										else{
                                            echo "$".$room->price;
									    }
										@endphp
									</span>
									<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail" onclick="addTocart(this)" data-room_id="{{ $room->id }}" data-quantity="1" data-city="{{ $hotel[0]->city }}" data-hotel_id="{{ $hotel[0]->id }}" data-slug="{{ $hotel[0]->slug}}">
										Add to cart
									</button>
								</div>								
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			@else
			    No rooms available. 
			@endif
		</div>
	</section>

    <!-- Modal1 -->
	        <div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		        <div class="overlay-modal1 js-hide-modal1"></div>

		        <div class="container">
			        <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				        <button class="how-pos3 hov3 trans-04 js-hide-modal1">
					        <img src="{{asset('coza/images/icons/icon-close.png')}}" alt="CLOSE">
				        </button>

				        <div class="row">
					        <div class="col-md-6 col-lg-7 p-b-30">
						        <div class="p-l-25 p-r-30 p-lr-0-lg">
							        <div class="wrap-slick3 flex-sb flex-w">
                                        <div class="wrap-slick3-dots"></div>
								        <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
								        <div class="slick3 gallery-lb">
									        <div class="item-slick3" data-thumb="{{asset('coza/images/product-detail-03.jpg')}}">
										        <div class="wrap-pic-w pos-relative">
											        <img id="image" src="{{asset('coza/images/product-detail-03.jpg')}}" alt="IMG-PRODUCT">

											        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{asset('coza/images/product-detail-03.jpg')}}">
												        <i class="fa fa-expand"></i>
											        </a>
										        </div>
									        </div>
								        </div>
							        </div>
						        </div>
						        <div class="p-l-25 p-r-30 p-lr-0-lg">
							        <h4 id="header" class="mtext-105 cl2 js-name-detail p-b-14"></h4>

							        <span class="mtext-106 cl2" id="price">
								        
							        </span>

							        <p class="stext-102 cl3 p-t-23" id="room_type" style="padding-top: 0px !important;">
							        </p>
							        <p class="stext-102 cl3 p-t-23" id="size"
							        style="padding-top: 0px !important;">
							        </p>
							        <p class="stext-102 cl3 p-t-23" id="beds"
							        style="padding-top: 0px !important;">
							        </p>
							        <p class="stext-102 cl3 p-t-23" id="discount"
							        style="padding-top: 0px !important;">
							        </p>
							    </div>    
					        </div>
					
					        <div class="col-md-6 col-lg-5 p-b-30">
						        <div class="p-r-50 p-t-5 p-lr-0-lg">
							        <div class="scroll-box" id="room_detail">
							        </div>
							
							        <!--  -->
							        <div class="p-t-33">
								       <div class="flex-w flex-r-m p-b-10">
									       <div class="size-204 flex-w flex-m respon6-next">
										       <div class="wrap-num-product flex-w m-r-20 m-tb-10">
											       <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												       <i class="fs-16 zmdi zmdi-minus"></i>
											       </div>

											       <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

											       <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												       <i class="fs-16 zmdi zmdi-plus"></i>
											       </div>
										       </div>

										       <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
											       Add to cart
										       </button>
									       </div>
								       </div>	
							        </div>

							        <!--  -->
							        <div class="flex-w flex-m p-l-100 p-t-40 respon7">
								        <div class="flex-m bor9 p-r-10 m-r-11">
									        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
										        <i class="zmdi zmdi-favorite"></i>
									        </a>
								        </div>

								        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
									        <i class="fa fa-facebook"></i>
								        </a>

								        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
									        <i class="fa fa-twitter"></i>
								        </a>

								        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
									        <i class="fa fa-google-plus"></i>
								        </a>
							        </div>
						        </div>
					        </div>
				        </div>
			        </div>
		        </div>
	        </div>


@endsection
@section('script')
	<script>
		function example(room_id){
			$.ajax({
				url: "{{route('hotel-rooms')}}",
				type: "POST",
				data: {
					room_id: room_id,
					_token: "{{ csrf_token() }}"
				},
				success :function(response){
                    if (typeof(response) != "object") {
                    	response = $.parseJSON(response);
                    }
                    if (response.success == true) {
                    	console.log(response.data);
                    	document.getElementById("header").innerHTML = response.data.title;
                    	document.getElementById("price").innerHTML = "Price: $"+response.data.price;
                    	document.getElementById("room_type").innerHTML = "Room Type: "+response.data.room_type;
                    	document.getElementById("size").innerHTML = "Size: "+response.data.size;
                        document.getElementById("beds").innerHTML = "Beds: "+response.data.beds;
                        if (response.data.discount != null) {
                            document.getElementById("discount").innerHTML = "Discount: "+response.data.discount+"%";
                        }
                        if (response.data.summary) {
                            document.getElementById("room_detail").innerHTML = response.data.summary+response.data.room_details;
                        }
                        else{
                            document.getElementById("room_detail").innerHTML = response.data.room_details;
                        }
                        if (response.data.room_images) {
                        	$.each(response.data.room_images, function(key,value){
                        		console.log(value.image);
                        		var image = "{{asset('uploads/room-images/"+console.log(value.image)+"')}}";
                        		console.log(image);
                        		document.getElementById("image").src = "{{asset('uploads/room-images/data:image/gif;base64," + value.image + "')}}";
                        	})
                        }  
                    }
				}
			});
		}
		/*function addTocart(elem, id=null){
            var room_id=$(elem).data('room_id');
            var hotel_id=$(elem).attr('data-hotel_id'); mathi ko data function or attr function jun use gareni hunxa data function use garda chai direct data use gare hunxa argument ma data() ma.
            var quantity=$(elem).data('quantity');
            var city=$(elem).data('city');
            var hotel_id=$(elem).data('hotel_id');
            var check_in=$('#check-in').val();
            var check_out=$('#check-out').val();
            var slug=$(elem).data('slug');
            console.log(room_id,quantity,city,hotel_id,check_in,check_out,slug);

            quantity = parseInt(quantity)
            $.ajax({
            	url: "{{route('cartadd')}}",
            	type: "POST",
            	data: {
            		room_id: room_id,
            		city: city,
            		check_in: check_in,
            		check_out: check_out,
            		hotel_id: hotel_id,
            		_token: "{{ csrf_token() }}",
            		quantity: quantity,
            		slug: slug
            	},
            	success: function(response){
            		if (typeof(response) != "object") {
            			response = $.parseJSON(response);
            		}
            		if(response.status == true){
                    swal("Cart Update!", response.msg, "success").then(function(){
                        document.location.href = document.location.href;
                        });
                    }
            		else{
            			swal("Cart Update", response.msg, "error");
            		}
            	}
            });           
		}*/
	</script>
@endsection