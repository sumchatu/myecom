@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Search report</h5>
            </div><!-- sl-page-title -->

            <div class="row">
                <div class="col-lg-6">
                    <div class="card pd-20 pd-sm-40">
                        <div class="table-wrapper">
                        <form action="{{route('search.date')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <label for="exampleInputEmail1">Search By Date</label>
                            <div class="modal-body pd-20">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="date">
                                </div>
                            </div><!-- modal-body -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info pd-x-20">Submit</button>
                            </div>
                        </form>
                        </div><!-- table-wrapper -->
                    </div><!-- card -->
                </div><!-- col-lg-6 -->

                <div class="col-lg-6">
                    <div class="card pd-20 pd-sm-15">
                        <div class="table-wrapper">
                        <form action="{{route('search.monthYear')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <label for="exampleInputEmail1">Search By Month & Year</label>
                            <div class="modal-body pd-20">
                                <div class="form-group">
                                    <select class="form-control" name="month">
                                        <option value="">Select Month</option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="year">
                                        <option value="">Select Year</option>
                                        @for($i=date('Y'); $i>=2019; $i--)
                                        <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div><!-- modal-body -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info pd-x-20">Submit</button>
                            </div>
                        </form>
                        </div><!-- table-wrapper -->
                    </div><!-- card -->
                </div><!-- col-lg-6 -->
            </div><!-- row -->
        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection