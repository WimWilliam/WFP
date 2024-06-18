@extends('layout.conquer2')

@section('content')
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
    Create New Products
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
                <a href="#">Create New Products</a>
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
  <form method="POST" action="{{route('products.store')}}">
    @csrf
    <div class="form-group">
        <label for="exampleInputType">Name of Products</label>
        <input type="text" class="form-control" id="exampleInputType" name="products_name" 
            aria-describedby="nameHelp" placeholder="Enter Name of Products...">
        <small id="nameHelp" class="form-text text-muted">Please write down the name of products here.</small>
        <br><br>
        <label for="exampleInputType">Price of Products</label>
        <input type="text" class="form-control" id="exampleInputType" name="products_price" 
            aria-describedby="nameHelp" placeholder="Enter Price of Products...">
        <small id="nameHelp" class="form-text text-muted">Please write down the price of products here.</small>
        
        <br><br>
        <label for="exampleInputType">Available Room of Products</label>
        <input type="text" class="form-control" id="exampleInputType" name="products_available" 
            aria-describedby="nameHelp" placeholder="Enter Available of Products...">
        <small id="nameHelp" class="form-text text-muted">Please write down the Available of products here.</small>
        
        <br><br>
        <label for="exampleInputType">Name Hotel of Products</label>
        <br>
        <select name="hotels_id">
            <option value="1">Hotel A</option>
            <option value="2">Hotel B</option>
        <!-- Add more options as needed -->
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

</div>
@endsection
</body>
</html>


