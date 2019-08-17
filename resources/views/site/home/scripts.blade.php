<!--===============================================================================================-->	
	<script src="{{asset('coza/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('coza/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('coza/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('coza/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('coza/vendor/select2/select2.min.js')}}"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="{{asset('coza/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('coza/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('coza/vendor/slick/slick.min.js')}}"></script>
	<script src="{{asset('coza/js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('coza/vendor/parallax100/parallax100.js')}}"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="{{asset('coza/vendor/MagnificPopup/jquery.magnific-popup.min.js')}}"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="{{asset('coza/vendor/isotope/isotope.pkgd.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('coza/vendor/sweetalert/sweetalert.min.js')}}"></script>
	<script>
		$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});
        
		/*---------------------------------------------*/

		/*$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});*/
        
        /*---------------------------------------------*/
		function addTocart(elem, id=null){
            var room_id=$(elem).data('room_id');
            var hotel_id=$(elem).attr('data-hotel_id'); /*mathi ko data function or attr function jun use gareni hunxa data function use garda chai direct data use gare hunxa argument ma data() ma.*/
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
		}

		function removeFromCart(key,quantity=1){

            $.ajax({
            	url: "{{route('cartremove')}}",
            	type: "GET",
            	data: {
            		key: key,
            		quantity: quantity
            	},
            	success: function(response){
                    if (typeof(response) != "object") {
                    	response = $.parseJSON(response);
                    }
                    if (response.status == true) {
                    	console.log(response.data);
                    	swal(response.msg , "success");
                    }
            	}
            });
		}
	    
	    function addToWishlist(hotel_id){
        	$.ajax({
        		url: "{{route('wishlist')}}",
        		type: "GET",
        	    data: {
        	    	hotel_id: hotel_id
        	    },
        	    success: function(response){

        	    }
        	});
        }
        /*---------------------------------------------*/
        /*htmlentities() is a PHP function which converts special characters (like <) into their escaped/encoded values (like &lt;). This allows you to show to display the string without the browser reading it as HTML.JavaScript doesn't have a native version of it. If you just need the very basics to so that the browser won't interpret as HTML, this should work fine (via James Padolsey and I got a a similar idea from David Walsh).*/
        function htmlEntities(str) {
            return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }

	</script>
<!--===============================================================================================-->
	<script src="{{asset('coza/vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="{{asset('coza/js/main.js')}}"></script>
<!--===============================================================================================-->
</body>
<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c36bbc79e7f042d"></script>
</html>