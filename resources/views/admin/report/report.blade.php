@extends('admin.admin_layouts')

@section('admin_content')

        <!-- ########## START: MAIN PANEL ########## -->
        <div class="sl-mainpanel">
      
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>{{$bladeTitle}}</h5>
        </div><!-- sl-page-title -->
        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Order List</h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">Payment Type</th>
                  <th class="wd-15p">Transaction ID</th>
                  <th class="wd-15p">Sub Total</th>
                  <th class="wd-20p">Shipping</th>
                  <th class="wd-20p">Total</th>
                  <th class="wd-20p">Date</th>
                  <th class="wd-20p">Status</th>
                  <th class="wd-20p">Action</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              @foreach($order as $row)
                <tr>
                  <td>{{$row->payment_type}}</td>
                  <td>{{$row->blnc_transaction	}}</td>
                  <td>{{$row->subtotal}}</td>
                  <td>{{$row->shipping}}</td>
                  <td>{{$row->total}}</td>
                  <td>{{$row->date}}</td>
                  <td>
                  @if($row->status==0)
                      <span class="badge badge-warning">Pending</span>
                  @elseif($row->status==1)
                      <span class="badge badge-info">Payment Accept</span>
                  @elseif($row->status==2)
                      <span class="badge badge-warning">Progress</span>
                  @elseif($row->status==3)
                      <span class="badge badge-success">Delivered</span>
                  @else
                      <span class="badge badge-danger">Cancelled</span>
                  @endif
                  </td>
                  <td>
                  <a href="{{route('admin.orderDetails',$row->id)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                  </td>
                  <td></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection