@extends('admin.admin_layouts')

@section('admin_content')

        <!-- ########## START: MAIN PANEL ########## -->
        <div class="sl-mainpanel">
      
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Coupon Table</h5>
        </div><!-- sl-page-title -->
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
          <h6 class="card-body-title">Coupon List
          <a href="" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal" data-target="#modaldemo3">Add New</a>
          </h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">ID</th>
                  <th class="wd-15p">Coupon name</th>
                  <th class="wd-15p">Coupon Discount(%)</th>
                  <th class="wd-20p">Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach($coupon as $key=>$row)
                <tr>
                  <td>{{$key + 1}}</td>
                  <td>{{$row->coupon_name}}</td>
                  <td>{{$row->coupon_discount}} %</td>
                  <td>
                  <a href="{{route('coupon.edit',['coupon'=>$row->slug])}}" class="btn btn-sm btn-info">Edit</a>
                  {!! Form::open(['method' => 'DELETE','route' => ['coupon.destroy', $row->slug],'style'=>'display:inline']) !!}
                    <button class="btn btn-sm btn-danger" id="delete">Delete</button>
                  {!! Form::close() !!}
                    <!-- <a href="{{route('category.destroy',['category'=>$row->slug])}}" class="btn btn-sm btn-danger" id="delete">Delete</a> -->
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <!-- LARGE MODAL -->
    <div id="modaldemo3" class="modal fade">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
              <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Coupon Add</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
              <form action="{{ route('coupon.store')}}" method="post">
              @csrf
              <div class="modal-body pd-20">
                <div class="form-group">
                    <label for="exampleInputEmail1">Coupon Name</label>
                    <input type="text" class="form-control" id="coupon_name" name="coupon_name" placeholder="coupon name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Coupon Discount(%)</label>
                    <input type="text" class="form-control" id="coupon_discount" name="coupon_discount" placeholder="coupon discount">
                </div>
              </div><!-- modal-body -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-info pd-x-20">Submit</button>
                <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
              </div>
            </div>
            </form>
          </div><!-- modal-dialog -->
        </div><!-- modal -->

@endsection