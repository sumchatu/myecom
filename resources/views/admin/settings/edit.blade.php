@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <span class="breadcrumb-item active">Edit Website Settings</span>
      </nav>

      <div class="sl-pagebody">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      <div class="card pd-20 pd-sm-40">
          <p class="mg-b-20 mg-sm-b-30">Edit Settings <a href="{{route('settings.index',$setting->id)}}"><i class="fa-arrow-left pull-right" title="Back"></i></a></p>
          <form action="{{route('settings.update',$setting)}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            @csrf
          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Shop Name:</label>
                  <input class="form-control" type="text" name="shop_name" value="{{$setting->shop_name}}" >
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Email: <i class="fa fa-envelope" aria-hidden="true"></i></label>
                  <input class="form-control" type="email" name="email" value="{{$setting->email}}">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Phone 1: <i class="fa fa-phone" aria-hidden="true"></i></label>
                  <input class="form-control" type="text" name="phone_1" value="{{$setting->phone_1}}">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Phone 2: <i class="fa fa-phone" aria-hidden="true"></i></label>
                  <input class="form-control" type="text" name="phone_2" value="{{$setting->phone_2}}">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Facebook: <i class="fa fa-facebook" aria-hidden="true"></i></label>
                  <input class="form-control" type="text" name="facebook" value="{{$setting->facebook}}">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Youtube: <i class="fa fa-youtube" aria-hidden="true"></i></label>
                  <input class="form-control" type="text" name="youtube" value="{{$setting->youtube}}">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Instagram: <i class="fa fa-instagram" aria-hidden="true"></i></label>
                  <input class="form-control" type="text" name="instagram" value="{{$setting->instagram}}">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Twitter: <i class="fa fa-twitter" aria-hidden="true"></i></label>
                  <input class="form-control" type="text" name="twitter" value="{{$setting->twitter}}">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">VAT:</label>
                  <input class="form-control" type="text" name="vat" value="{{$setting->vat}}">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Shipping Charge:</label>
                  <input class="form-control" type="text" name="shipping_charge" value="{{$setting->shipping_charge}}">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Shop Address:</label>
                  <textarea class="form-control" name="address" rows="4" cols="10" disabled>
                    {{$setting->address}}
                  </textarea>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Shop Logo:</label>
                    <label class="custom-file">
                        <input type="file" id="image_one" name="shop_logo" class="custom-file-input" onchange="readURL1(this);"> 
                        <span class="custom-file"><img src="{{asset('public/media/logo/'.$setting->logo)}}"></span>
                        <span class="custom-file-control"></span>
                        <img src="#" id="one">
                    </label>
                </div>
              </div><!-- col-4 -->
            </div><!-- row -->
            <hr><br>
            <div class="form-layout-footer">
              <button class="btn btn-info mg-r-5" type="submit">Submit Form</button>
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
        </form>
        </div><!-- card -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

    <script type="text/javascript">
        function readURL1(input){
            if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#one')
                .attr('src', e.target.result)
                .width(80)
                .height(80);
            };
            reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
