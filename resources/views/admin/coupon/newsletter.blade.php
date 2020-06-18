@extends('admin.admin_layouts')

@section('admin_content')

        <!-- ########## START: MAIN PANEL ########## -->
        <div class="sl-mainpanel">
      
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Subscriber List</h5>
        </div><!-- sl-page-title -->
        
        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Subscriber List</h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">ID</th>
                  <th class="wd-15p">Email Address</th>
                  <th class="wd-15p">Subscribing Time</th>
                  <th class="wd-20p">Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach($newsletter as $key=>$row)
                <tr>
                  <td>{{$key + 1}}</td>
                  <td>{{$row->email}}</td>
                  <td>{{$row->created_at}}</td>
                  <td>
                    {!! Form::open(['method' => 'DELETE','route' => ['admin.newsletter.delete', $row->id],'style'=>'display:inline']) !!}
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
@endsection