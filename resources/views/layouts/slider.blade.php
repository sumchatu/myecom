<!-- Banner -->

<div class="banner">
        <div class="banner_background" style="background-image:url({{ asset('public/frontend/images/banner_background.jpg')}})"></div>
        <div class="container fill_height">
            <div class="row fill_height">
                <div class="banner_product_image"><img src="{{ asset('public/media/product/'.$bannerProduct->image_one)}}" alt="" style="height: 450px;"></div>
                <div class="col-lg-5 offset-lg-4 fill_height">
                    <div class="banner_content">
                        <h1 class="banner_text">{{$bannerProduct->product_name}}</h1>
                        <div class="banner_price">
                         @if($bannerProduct->discount_price == NULL)
                            <h2> ₹ {{$bannerProduct->selling_price }} </h2>
                         @else
                            <span> ₹ {{$bannerProduct->selling_price}}</span>₹ {{$bannerProduct->discount_price}}
                         @endif
                        </div>
                        <div class="banner_product_name">{{$bannerProduct->brand->brand_name}}</div>
                        <div class="button banner_button"><a href="#">Shop Now</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>