@extends('admin.admin_layouts')

@section('admin_content')

        <!-- ########## START: MAIN PANEL ########## -->
        <div class="sl-mainpanel">
      
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Product Table</h5>
        </div><!-- sl-page-title -->
        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Product List
          <a href="{{ route('product.create')}}" class="btn btn-sm btn-warning" style="float: right;">Add New</a>
          </h6>
          <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-5p">Sl.No</th>
                  <th class="wd-10p">Product Code</th>
                  <th class="wd-10p">Product Name</th>
                  <th class="wd-15p">Image</th>
                  <th class="wd-10p">Category</th>
                  <th class="wd-10p">Subcategory</th>
                  <th class="wd-10p">Brand</th>
                  <th class="wd-10p">Quantity</th>
                  <th class="wd-10p">Status</th>
                  <th class="wd-20p">Action</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              @foreach($products as $key=>$row)
                <tr>
                  <td>{{$key + 1}}</td>
                  <td>{{$row->product_code}}</td>
                  <td>{{$row->product_name}}</td>
                  <td><img src="{{ asset('public/media/product/'.$row->image_one)}}" height="50px;" width="50px;"></td>
                  <td>{{$row->category->category_name}}</td>
                  <td>{{$row->subcategory->subcategory_name}}</td>
                  <td>{{$row->brand->brand_name}}</td>
                  <td>{{$row->product_quantity}}</td>
                  <td>
                    @if($row->status == 1)
                    <span class="badge badge-success">Active</span>
                    @else
                    <span class="badge badge-danger">Inactive</span>
                    @endif
                  </td>
                  <td>
                  <a href="{{route('product.show',Crypt::encrypt($row->id))}}" class="btn btn-sm btn-success" title="Show"><i class="fa fa-eye"></i></a>
                  <a href="{{route('product.edit',Crypt::encrypt($row->id))}}" class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></a>
                  {!! Form::open(['method' => 'DELETE','route' => ['product.destroy', $row->id],'style'=>'display:inline']) !!}
                    <button class="btn btn-sm btn-danger" id="delete" title="Delete"><i class="fa fa-trash"></i></button>
                  {!! Form::close() !!}
                  @if($row->status == 1)
                    <a href="{{route('product.activeDeactive',Crypt::encrypt($row->id))}}" class="btn btn-sm btn-danger" title="Deactivate"><i class="fa fa-thumbs-down"></i></a>
                  @else
                  <a href="{{route('product.activeDeactive',Crypt::encrypt($row->id))}}" class="btn btn-sm btn-warning" title="Activate"><i class="fa fa-thumbs-up"></i></a>
                  @endif
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