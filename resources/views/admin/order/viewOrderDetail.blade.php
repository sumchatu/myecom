@extends('admin.admin_layouts')

@section('admin_content')

    <div class="sl-mainpanel">
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Order Details</h6>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><strong>Order </strong>Details</div>
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <th>Name:</th>
                                        <th>{{$order->user->name}}</th>
                                    </tr>
                                    <tr>
                                        <th>Phone:</th>
                                        <th>{{$order->user->phone}}</th>
                                    </tr>
                                    <tr>
                                        <th>Payment Type:</th>
                                        <th>{{$order->payment_type}}</th>
                                    </tr>
                                    <tr>
                                        <th>Payment ID:</th>
                                        <th>{{$order->payment_id}}</th>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <th>{{$order->total}}</th>
                                    </tr>
                                    <tr>
                                        <th>Month:</th>
                                        <th>{{$order->month}}</th>
                                    </tr>
                                    <tr>
                                        <th>Date:</th>
                                        <th>{{$order->date}}</th>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><strong>Shipping </strong>Details</div>
                            <div class="card-body">
                            <table class="table">
                                    <tr>
                                        <th>Name:</th>
                                        <th>{{$order->ship->ship_name}}</th>
                                    </tr>
                                    <tr>
                                        <th>Phone:</th>
                                        <th>{{$order->ship->ship_phone}}</th>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <th>{{$order->ship->ship_email}}</th>
                                    </tr>
                                    <tr>
                                        <th>Address:</th>
                                        <th>{{$order->ship->ship_address}}</th>
                                    </tr>
                                    <tr>
                                        <th>City:</th>
                                        <th>{{$order->ship->ship_city}}</th>
                                    </tr>
                                    <tr>
                                        <th>Pin Code:</th>
                                        <th>{{$order->ship->ship_pincode}}</th>
                                    </tr>
                                    <tr>
                                        <th>Status:</th>
                                        <th>
                                            @if($order->status==0)
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($order->status==1)
                                                <span class="badge badge-info">Payment Accept</span>
                                            @elseif($order->status==2)
                                                <span class="badge badge-warning">Progress</span>
                                            @elseif($order->status==3)
                                                <span class="badge badge-success">Delivered</span>
                                            @else
                                                <span class="badge badge-danger">Cancelled</span>
                                            @endif
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="card pd-20 pd-sm-40 col-lg-12">
                        <h6 class="card-body-title">Product Details</h6>
                        <div class="table-wrapper">
                        <table class="table display responsive nowrap">
                            <thead>
                                <tr>
                                <th class="wd-5p">Product ID</th>
                                <th class="wd-10p">Product Name</th>
                                <th class="wd-10p">Image</th>
                                <th class="wd-15p">Color</th>
                                <th class="wd-10p">Size</th>
                                <th class="wd-20p">Quantity</th>
                                <th class="wd-20p">Price/Unit</th>
                                <th class="wd-20p">Total Price</th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($order->orderDetails as $row)
                                <tr>
                                <td>{{$row->product->product_code}}</td>
                                <td>{{$row->product->product_name}}</td>
                                <td><img src="{{ asset('public/media/product/'.$row->product->image_one)}}" height="50px;" width="50px;"></td>
                                <td>{{$row->color}}</td>
                                <td>{{$row->size}}</td>   
                                <td>{{$row->quantity}}</td>
                                <td>{{$row->single_price}}</td>
                                <td>{{$row->total_price}}</td>
                                <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div><!-- table-wrapper -->
                    </div><!-- card -->
                </div>  
                @if($order->status == 0)
                    <a href="{{route('adminOrder.action',[$order->id,1])}}" class="btn btn-info">Payment Accept</a>    
                    <a href="{{route('adminOrder.action',[$order->id,5])}}" class="btn btn-danger">Order Cancel</a>
                @elseif($order->status == 1)
                    <a href="{{route('adminOrder.action',[$order->id,2])}}" class="btn btn-info">Procss Delivery</a>
                @elseif($order->status == 2)
                    <a href="{{route('adminOrder.action',[$order->id,3])}}" class="btn btn-success">Delivery Done</a>
                @elseif($order->status == 5)
                    <strong class="text-danger text-center">This is not a valid Order</strong>
                @else
                    <strong class="text-success text-center">This Order has been Successfully Delivered</strong>
                @endif
            </div>
        </div>
    </div>
@endsection