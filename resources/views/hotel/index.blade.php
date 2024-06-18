@extends('layout.conquer2')

@section('content')
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
    Dashboard <small>statistics and more</small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="index.html">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Dashboard</a>
            </li>
        </ul>
        <div class="page-toolbar">
            <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height btn-primary" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                <i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
            </div>
        </div>

    <!-- END PAGE HEADER-->
</div>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<!-- <style>
    img {
        width: 200px;
        height: 100px;
    }
    div {
        border: 1px solid;
        padding: 10px;
        margin: 10px;
        border-radius: 10px;
    }

</style> -->
<body>

<div class="container">
  <h2>Hotels</h2>
  <a class="btn btn-primary" data-toggle="modal" href="#disclaimer">Disclaimer</a>
  <table class="table table-light">
    <thead>
      <tr>
        <th>Name</th>
        <th>Logo</th>
        <th>Address</th>
        <th>City</th>
        <th>Foto</th>
        <th>Room</th>
        <th>Lihat Produk</th>
      </tr>
    </thead>
    <tbody>
        
        @foreach($rs as $r)
        <tr>
         
            <td >
              <!-- Untuk link pada text jika di klik -->
              <a href="/hotels/{{$r->id}}">{{$r->name}}</a>
            </td>

            <td>
              <img height='100px' src="{{ asset('/logo/'.$r->id.'.jpg')}}"/><br>
              <a href="{{ url('hotels/uploadLogo/'.$r->id) }}">
                <button class='btn btn-xs btn-default'>upload</button></a>
            </td>


            <td>{{$r->address}}</td>
            <td>{{$r->city}}</td>
            <td>
              <!-- //Untuk saat gambar di klik bisa membesar -->
              <a class="btn btn-info"  href="#detail_{{$r->id}}" data-toggle="modal">{{ $r->name }}
              <img src="{{asset('image/'.$r->image)}}" />
              </a>
              
              <a href="{{ url('hotels/uploadPhoto/'.$r->id) }}">
              <button class='btn btn-xs btn-default'>upload</button></a>

                <div class="modal fade" id="detail_{{$r->id}}" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">{{$r->name}}</h4>
                            </div>
                            <div class="modal-body">
                                <img src={{ asset('image/'.$r->image)}} height='200px' />
                            </div>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
              </a>
            </td>

            <td>
              @foreach($r->products as $p) 
              - {{$p->name}} ({{$p->price}}) <br>
              @endforeach
            </td>

            <td>
                <form method="POST" action="{{ route('cekproduk') }}">
                    @csrf
                    <input type="hidden" name="hotel_id" value="{{$r->id}}">
                    <button type="submit" class="btn btn-xs btn-danger">Cek Product Hotels</button>
                </form>
            </td>
        </tr>
        @endforeach



    </tbody>
  </table>
  <br>
    @foreach($rs as $r)
        <div class="col-sm-4">
            <img height="100px" src="{{asset('image/'.$r->image)}}" />
            <br>
            {{$r->name}}
            <br>
            {{$r->address}}
            <br>
            {{$r->city}}
        </div>
    @endforeach
</div>
<!-- 
Untuk Disclaimer notifikasi berupa alert -->
<div class="modal fade" id="disclaimer" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">DISCLAIMER</h4>
              </div>
              <div class="modal-body">
                Pictures shown are for illustration purpose only. Actual product may vary due to product enhancement.
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
         </div>
</div>
@endsection
</body>
</html>


