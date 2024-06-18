@extends('layout.conquer2')

@section('content')
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
    Type
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Type</a>
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
                  <h4 class="modal-title">Add New Type</h4>
                </div>
                <div class="modal-body">

                  <form method="POST" action="{{route('type.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputType">Name of Type</label>
                        <input type="text" class="form-control" id="exampleInputType" name="type_name" 
                            aria-describedby="nameHelp" placeholder="Enter Name of Type...">
                        <small id="nameHelp" class="form-text text-muted">Please write down the name of type here.</small>
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
          <th>Type</th>
          <th>
            @if(Auth::user()->role=='owner')
            <a href={{ route('type.create') }}>
                <button class="btn btn-xs btn-info">Tambah</button>
            </a>

            <!-- fungsi data-toggle modal untuk mengeluarkan pop up  -->
            <a href="#modalCreate" data-toggle="modal" class="btn btn-xs btn-info">Tambah(with Modals)</a>
            @endif
            <div class="modal fade" id="modalEditA" tabindex="-1" role="basic" aria-hidden="true">
              <div class="modal-dialog modal-wide">
                <div class="modal-content" >
                    <div class="modal-body" id="modalContent">
                      {{-- You can put animated loading image here... --}}
                    </div>
                </div>
              </div>
            </div> 

            <div class="modal fade" id="modalEditB" tabindex="-1" role="basic" aria-hidden="true">
              <div class="modal-dialog modal-wide">
                <div class="modal-content" >
                    <div class="modal-body" id="modalContentB">
                      {{-- You can put animated loading image here... --}}
                    </div>
                </div>
              </div>
            </div> 

          </th>
        </tr>
      </thead>
      <tbody>

          @foreach ($rs as $r )
            <tr id="tr_{{$r->id}}">
              <td id="td_name_{{$r->id}}">{{$r->name}}</td>
              <td>
                <a href="{{url('type/'.$r->id."/edit")}}"><button class="btn btn-xs btn-warning">Edit</button></a>
                <!-- <button class="btn btn-xs btn-danger">Delete</button> -->

                <a href="#modalEditA" class="btn btn-warning btn-xs" data-toggle="modal" onclick="getEditForm({{$r->id}})">Edit Type A</a>

                <a href="#modalEditB" class="btn btn-info btn-xs" data-toggle="modal" onclick="getEditFormB({{$r->id}})">Edit Type B</a>
                
                @can('delete-permission',Auth::user())
                <a href="#" value="DeleteNoReload" class="btn btn-danger btn-xs" onclick="if(confirm('Are you sure to delete {{$r->id}} - {{$r->name}} ? ')) deleteDataRemoveTR({{$r->id}})">Delete without Reload</a>
                @endcan

                <form style="display: inline;" method="POST" action="{{route('type.destroy',$r->id)}}">
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
  function getEditForm(type_id)
  {
    $.ajax({
      type:'POST',
      url:'{{route("type.getEditForm")}}',
      data: {
        '_token' : '<?php echo csrf_token() ?>',
        'id': type_id
      },
      success: function(data){
        $('#modalContent').html(data.msg)
      }
    });
  }

  function getEditFormB(type_id)
  {
    $.ajax({
      type:'POST',
      url:'{{route("type.getEditFormB")}}',
      data: {
        '_token' : '<?php echo csrf_token() ?>',
        'id': type_id
      },
      success: function(data){
        $('#modalContentB').html(data.msg)
      }
    });
  }


  function saveDataUpdateTD(type_id)
  {
      var eName = $('#eName').val();
      console.log(eName); //debug->print to browser console
      $.ajax({
         type:'POST',
         url:'{{route("type.saveDataTD")}}',
         data: {
            '_token' : '<?php echo csrf_token() ?>',
            'id': type_id,
            'name':eName
         },
         success: function(data){
            if(data.status == "oke")
            {
               $('#td_name_'+ type_id).html(eName);
               $('#modalEditB').modal('hide');
            }
         }
      })
   }

   function deleteDataRemoveTR(type_id)
   {
      $.ajax({
         type:'POST',
         url:'{{route("type.deleteData")}}',
         data: {
            '_token' : '<?php echo csrf_token() ?>',
            'id': type_id
         },
         success: function(data){
            if(data.status == "oke")
            {
               $('#tr_'+type_id).remove();
               alert($msg);
            }
         }
      });
   }



</script>
@endsection