@extends('admin.admin_layouts')

@section('admin_content')

        <!-- ########## START: MAIN PANEL ########## -->
        <div class="sl-mainpanel">
      
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Brand Table</h5>
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
          <h6 class="card-body-title">Brand List
          <a href="" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal" data-target="#modaldemo3">Add New</a>
          </h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">ID</th>
                  <th class="wd-15p">Brand name</th>
                  <th class="wd-15p">Brand logo</th>
                  <th class="wd-20p">Action</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              @foreach($brand as $key=>$row)
                <tr>
                  <td>{{$key + 1}}</td>
                  <td>{{$row->brand_name}}</td>
                  @if($row->brand_logo)
                  <td><img src="{{ asset('public/media/brand/'.$row->brand_logo)}}" height="50px;" width="70px;"></td>
                  @else
                  <td><button class="wd-32 rounded-circle">No image</button></td>
                  @endif
                  <td>
                  <a href="{{route('brand.edit',['brand'=>$row->slug])}}" class="btn btn-sm btn-info">Edit</a>
                  {!! Form::open(['method' => 'DELETE','route' => ['brand.destroy', $row->slug],'style'=>'display:inline']) !!}
                    <button class="btn btn-sm btn-danger" id="delete">Delete</button>
                  {!! Form::close() !!}
                    <!-- <a href="{{route('category.destroy',['category'=>$row->slug])}}" class="btn btn-sm btn-danger" id="delete">Delete</a> -->
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

    <!-- LARGE MODAL -->
    <div id="modaldemo3" class="modal fade">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
              <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Brand Add</h6>
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
              <form action="{{ route('brand.store')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="modal-body pd-20">
                <div class="form-group">
                    <label for="exampleInputEmail1">Brand Name</label>
                    <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Brand name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Brand Logo</label>
                    <input type="file" class="form-control" id="brand_logo" name="brand_logo">
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