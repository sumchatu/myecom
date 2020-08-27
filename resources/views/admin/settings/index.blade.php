@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <span class="breadcrumb-item active">Website Settings</span>
      </nav>

      <div class="sl-pagebody">
      <div class="card pd-20 pd-sm-40">
          <p class="mg-b-20 mg-sm-b-30">All Settings <a href="{{route('settings.edit',$setting->id)}}"><i class="fa fa-edit pull-right" title="Edit"></i></a></p>
          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Shop Name:</label>
                  <input class="form-control" type="text" value="{{$setting->shop_name}}" disabled>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Email: <i class="fa fa-envelope" aria-hidden="true"></i></label>
                  <input class="form-control" type="text" value="{{$setting->email}}" disabled>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Phone 1: <i class="fa fa-phone" aria-hidden="true"></i></label>
                  <input class="form-control" type="text" value="{{$setting->phone_1}}" disabled>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Phone 2: <i class="fa fa-phone" aria-hidden="true"></i></label>
                  <input class="form-control" type="text" value="{{$setting->phone_2}}" disabled>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Facebook: <i class="fa fa-facebook" aria-hidden="true"></i></label>
                  <input class="form-control" type="text" value="{{$setting->facebook}}" disabled>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Youtube: <i class="fa fa-youtube" aria-hidden="true"></i></label>
                  <input class="form-control" type="text" value="{{$setting->youtube}}" disabled>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Instagram: <i class="fa fa-instagram" aria-hidden="true"></i></label>
                  <input class="form-control" type="text" value="{{$setting->instagram}}" disabled>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Twitter: <i class="fa fa-twitter" aria-hidden="true"></i></label>
                  <input class="form-control" type="text" value="{{$setting->twitter}}" disabled>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">VAT:</label>
                  <input class="form-control" type="text" value="{{$setting->vat}}" disabled>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Shipping Charge:</label>
                  <input class="form-control" type="text" value="{{$setting->shipping_charge}}" disabled>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Shop Address:</label>
                  <textarea class="form-control" rows="4" cols="10" disabled>
                    {{$setting->address}}
                  </textarea>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Shop Logo:</label>
                      <span class="form-control">
                        <img src="{{asset('public/media/logo/'.$setting->logo)}}">
                      </span>
                    </label>
                </div>
              </div><!-- col-4 -->
            </div><!-- row -->
        </div><!-- card -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
