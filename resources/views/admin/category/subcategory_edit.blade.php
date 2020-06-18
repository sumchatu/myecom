@extends('admin.admin_layouts')

@section('admin_content')

        <!-- ########## START: MAIN PANEL ########## -->
        <div class="sl-mainpanel">
      
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Subcategory Edit</h5>
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
          <h6 class="card-body-title">Subcategory Update
          </h6>
          <div class="table-wrapper">
              <form action="{{ route('subcategory.update',$subcategory->id)}}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="modal-body pd-20">
                <div class="form-group">
                    <label for="exampleInputEmail1">Subcategory Name</label>
                    <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" value="{{$subcategory->subcategory_name}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    {!! Form::select('category_id', $categoryArr,$subcategory->category_id, array('class' => 'form-control','id' =>'category_id' )) !!}
                </div>
              </div><!-- modal-body -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-success pd-x-20">Submit</button>
                <a class="btn btn-default icon-btn" href="{{url('admin/subcategory')}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
              </div>
            </div>
            </form>
          </div><!-- table-wrapper -->
        </div><!-- card -->

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection