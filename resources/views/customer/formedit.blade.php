@extends('layout.conquer2')

@section('content')
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
    Edit The Customer
        <small>statistics and more</small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="index.html">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Edit Customer</a>
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
    <!-- END PAGE HEADER-->
  <form method="POST" action="{{route('customer.update', $data->id)}}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="exampleInputType">Address of Customer</label>
        <!-- Value={{$data->name}} = memberikan value di inputan-->
        <input type="text" class="form-control" id="exampleInputType" name="customer_address" 
            aria-describedby="nameHelp" placeholder="Enter Address of Customer..." value="{{$data->address}}">
        <small id="nameHelp" class="form-text text-muted">Please write down the name of customer here.</small>
    </div>
    
    <button type="submit" class="btn btn-primary">Update</button>
  </form>

</div>
@endsection
</body>
</html>


