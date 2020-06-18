@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/cart_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/cart_responsive.css')}}">

	<!-- Cart -->

	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="cart_container">
						<div class="cart_title">Your Wishlist Products</div>
						<div class="cart_items">
							<ul class="cart_list">
                                @foreach($user->wishlistedProducts as $row)
								<li class="cart_item clearfix">
									<div class="cart_item_image text-center"><br><img src="{{ asset('public/media/product/'.$row->product->image_one)}}" alt="" style="height: 70px; width: 70px;"></div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Name</div>
											<div class="cart_item_text">{{$row->product->product_name}}</div>
										</div>
                                        @if($row->product->product_color == NULL)

                                        @else
										<div class="cart_item_color cart_info_col">
											<div class="cart_item_title">Color</div>
											<div class="cart_item_text">{{$row->product->product_color}}</div>
										</div>
                                        @endif
                                        @if($row->product->product_size == NULL)

                                        @else
                                        <div class="cart_item_color cart_info_col">
											<div class="cart_item_title">Size</div>
											<div class="cart_item_text">{{$row->product->product_size}}</div>
										</div>
                                        @endif
                                        <div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Action</div><br>
											<a href="" class="btn btn-sm btn-danger">Add to Cart</a>
										</div>
									</div>
								</li>
                                @endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <script src="{{asset('public/frontend/js/cart_custom.js')}}"></script>
@endsection