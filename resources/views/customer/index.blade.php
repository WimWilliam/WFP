@extends('layout.conquer2')

@section('content')
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
    Customers List
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Customer</a>
            </li>
        </ul>
        <div class="page-toolbar">
            <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height btn-primary" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                <i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
            </div>
        </div>

    <!-- END PAGE HEADER-->
</div>

<div class="container">
    @if(session("status"))
        <div class="alert alert-success">
            {{session("status")}}
        </div>
    @endif

    @if(session("statusError"))
        <div class="alert alert-danger">
            {{session("statusError")}}
        </div>
    @endif

  
    <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content" >
                <div class="modal-header">
                  <button type="button" class="close" 
                    data-dismiss="modal" aria-hidden="true"></button>
                  <h4 class="modal-title">Add New Customer</h4>
                </div>
                <div class="modal-body">

                  <form method="POST" action="{{route('customer.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputType">Name of Customers</label>
                        <input type="text" class="form-control" id="exampleInputType" name="customer_name" 
                            aria-describedby="nameHelp" placeholder="Enter Name of Customer...">
                        <small id="nameHelp" class="form-text text-muted">Please write down the name of customer here.</small>
                        <br><br>
                        <label for="exampleInputType">Address of Customers</label>
                        <input type="text" class="form-control" id="exampleInputType" name="customer_address" 
                            aria-describedby="nameHelp" placeholder="Enter address of Customer...">
                        <small id="nameHelp" class="form-text text-muted">Please write down the address of customer here.</small>
                    </div>
    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
    </div>



    
     <table class="table table-light">
      <thead>
        <tr>
          <th>Customer</th>
          <th>
            <a href={{ route('customer.create') }}>
                <button class="btn btn-xs btn-info">Tambah</button>
            </a>

            <a href="#modalCreate" data-toggle="modal" class="btn btn-xs btn-info">Tambah(with Modals)</a>

            <div class="modal fade" id="modalEditA" tabindex="-1" role="basic" aria-hidden="true">
              <div class="modal-dialog modal-wide">
                <div class="modal-content" >
                    <div class="modal-body" id="modalContent">
                      {{-- You can put animated loading image here... --}}
                    </div>
                </div>
              </div>
            </div> 



          </th>
        </tr>
      </thead>
      <tbody>

          @foreach ($rsCustomer as $r )
            <tr  id="tr_{{$r->id}}">
              <td  id="td_name_{{$r->id}}">{{$r->name}}</td>
              <td>{{$r->address}}</td>
              <td>
                <!-- <button class="btn btn-xs btn-warning">Edit</button> -->
                <!-- <button class="btn btn-xs btn-danger">Delete</button> -->
                <a href="{{url('customer/'.$r->id."/edit")}}"><button class="btn btn-xs btn-warning">Edit</button></a>
                
                <a href="#modalEditA" class="btn btn-warning btn-xs" data-toggle="modal" onclick="getEditForm({{$r->id}})">Edit Type A</a>

  
                <form style="display: inline;" method="POST" action="{{route('customer.destroy',$r->id)}}">
                  @csrf
                  @method('DELETE')
                  <input type="submit" value="delete" class="btn btn-danger btn-xs " onclick="return confirm('Are you sure to delete {{$r->id}} - {{$r->name}} ? ');">
                </form>
                
              </td>
            </tr>
          @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

@section('js')
<script>
  function getEditForm(customer_id)
  {
    $.ajax({
      type:'POST',
      url:'{{route("customer.getEditForm")}}',
      data: {
        '_token' : '<?php echo csrf_token() ?>',
        'id': customer_id
      },
      success: function(data){
        $('#modalContent').html(data.msg)
      }
    });
  }




</script>
@endsection