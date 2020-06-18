@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">Product Section</span>
      </nav>

      <div class="sl-pagebody">
      
      <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Product Details
          <a href="{{ route('product.index')}}" class="btn btn-info btn-sm pull-right">Back</a>
          </h6>
          <hr>
          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Product Code: </label>
                  <strong>{{$product->product_code}}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Product Name: </label>
                  <strong>{{$product->product_name}}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Quantity:</label>
                  <strong>{{$product->product_quantity}}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Category: </label>
                  <strong>{{$product->category->category_name}}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Subcategory: </label>
                  <strong>{{$product->subcategory->subcategory_name}}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Brand: </label>
                  <strong>{{$product->brand->brand_name}}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Product Size: </label>
                  <strong>{{$product->product_size}}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Product Colour: </label>
                  <strong>{{$product->product_color}}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Selling Price: </label>
                  <strong>{{$product->selling_price}}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Product Details: </label>
                  <strong>{!! $product->product_details !!}</strong>
                </div>
              </div><!-- col-12 -->
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Video link of product: </label>
                  <strong>{{$product->video_link}}</strong>
                </div>
              </div><!-- col-12 -->

              <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Image One: </label>
                    <img src="{{ asset('public/media/product/'.$product->image_one)}}" height="50px;" width="70px;">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Image two: </label>
                    <img src="{{ asset('public/media/product/'.$product->image_two)}}" height="50px;" width="70px;">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Image three: <span class="tx-danger">*</span></label>
                    <img src="{{ asset('public/media/product/'.$product->image_three)}}" height="50px;" width="70px;">
                </div>
              </div><!-- col-4 -->

            </div><!-- row -->

            <hr><br>

            <div class="row">
                <div class="col-lg-4">
                    @if($product->main_slider == 1)
                    <span class="badge badge-success">Main Slider</span>
                    @else
                    <span class="badge badge-danger">Main Slider</span>
                    @endif
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    @if($product->hot_deal == 1)
                    <span class="badge badge-success">Hot Deal</span>
                    @else
                    <span class="badge badge-danger">Hot Deal</span>
                    @endif
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    @if($product->best_rated == 1)
                    <span class="badge badge-success">Best Rated</span>
                    @else
                    <span class="badge badge-danger">Best Rated</span>
                    @endif
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    @if($product->mid_slider == 1)
                    <span class="badge badge-success">Mid Slider</span>
                    @else
                    <span class="badge badge-danger">Mid Slider</span>
                    @endif
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    @if($product->hot_new == 1)
                    <span class="badge badge-success">Hot New</span>
                    @else
                    <span class="badge badge-danger">Hot New</span>
                    @endif
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    @if($product->buyone_getone == 1)
                    <span class="badge badge-success">Buy-One Get-One</span>
                    @else
                    <span class="badge badge-danger">Buy-One Get-One</span>
                    @endif
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    @if($product->trend == 1)
                    <span class="badge badge-success">Trend Product</span>
                    @else
                    <span class="badge badge-danger">Trend Product</span>
                    @endif
                </div><!-- col-4 -->
                
            </div><!-- row -->

          </div><!-- form-layout -->
        </div><!-- card -->


    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
