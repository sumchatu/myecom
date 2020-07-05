@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/product_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/product_responsive.css')}}">
@include('layouts.menubar')
    	<!-- Single Product -->

	<div class="single_product">
		<div class="container">
			<div class="row">

				<!-- Images -->
				<div class="col-lg-2 order-lg-1 order-2">
					<ul class="image_list">
						<li data-image="{{ asset('public/media/product/'.$product->image_one)}}"><img src="{{ asset('public/media/product/'.$product->image_one)}}" alt=""></li>
						<li data-image="{{ asset('public/media/product/'.$product->image_two)}}"><img src="{{ asset('public/media/product/'.$product->image_two)}}" alt=""></li>
						<li data-image="{{ asset('public/media/product/'.$product->image_three)}}"><img src="{{ asset('public/media/product/'.$product->image_three)}}" alt=""></li>
					</ul>
				</div>

				<!-- Selected Image -->
				<div class="col-lg-5 order-lg-2 order-1">
					<div class="image_selected"><img src="{{ asset('public/media/product/'.$product->image_one)}}" alt=""></div>
				</div>

				<!-- Description -->
				<div class="col-lg-5 order-3">
					<div class="product_description">
						<div class="product_category">{{$product->category->category_name}}>{{$product->subcategory->subcategory_name}}</div>
						<div class="product_name">{{$product->product_name}}</div>
						<div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
						<div class="product_text"><p>{!! str_limit($product->product_details,$limit=600) !!}</p></div>
						<div class="order_info d-flex flex-row">
							<form action="{{route('product.cart')}}" method="post">
								@csrf
								<input type="hidden" name="product_id" value="{{$product->id}}">
								<div class="row">
									@if($product->product_color == NULL)

									@else
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Color</label>
											<select class="form-control input-lg" id="exampleFormControlSelect1" name="color">
												@foreach($product_color as $color)
												<option value="{{$color}}">{{$color}}</option>
												@endforeach
											</select>
                                        </div>
                                    </div>
									@endif

									@if($product->product_size == NULL)

									@else
									<div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2">Size</label>
											<select class="form-control input-lg" id="exampleFormControlSelect2" name="size">
												@foreach($product_size as $size)
												<option value="{{$size}}">{{$size}}</option>
												@endforeach
											</select>
                                        </div>
                                    </div>
									@endif
									<div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect3">Quantity</label>
											<input type="number" class="form-control" id="exampleFormControlSelect3"  value="1" pattern="[0-9]" name="qty">
                                        </div>
                                    </div>
								</div>

								@if($product->discount_price == NULL)
                                    <div class="product_price">₹{{$product->selling_price }}</div>
                                @else
                                    <div class="product_price discount">₹{{$product->discount_price }}<span>₹{{$product->selling_price }}</span></div>
                                @endif
								<div class="button_container">
									<button type="submit" class="button cart_button">Add to Cart</button>
									<div class="product_fav"><i class="fas fa-heart"></i></div>
								</div>
								
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Product Details -->

	<div class="viewed">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title">Product Details</h3>
						<div class="viewed_nav_container">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>

					<ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Video Link</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Product Review</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">{!! $product->product_details !!}</div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">Video Link</div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Product Reviews</div>
                    </div>
				</div>
			</div>
		</div>
	</div>

@endsection