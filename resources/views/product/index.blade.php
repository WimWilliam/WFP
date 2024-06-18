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

<div class="container">
    <!-- Menyimpan status notifikasi di halaman index -->
    @if(session("status"))
        <div class="alert alert-success">
            {{session("status")}}
        </div>
    @endif

    <!-- Form pencarian -->
    <form action="{{ route('products.index') }}" method="GET" class="form-inline mb-2">
        <div class="form-group">
            <input type="text" name="search" class="form-control" placeholder="Search by Name Room...">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <!-- Modal tambah produk -->
    <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add New Products</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('products.store') }}">
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
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <h2>Products</h2>
    <table class="table table-light">
        <thead>
            <tr>
                <th>Name Room</th>
                <th>Foto</th>
                <th>Price</th>
                <th>Nama Hotel</th>
                <th>Gambar Hotel</th>
                <th>Available Room</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rsProduct as $rProduct)
            <tr id="tr_{{$rProduct->id}}">
                <td id="td_name_{{$rProduct->id}}">{{$rProduct->name}}</td>

                <td>
                    @if($rProduct->filenames)
                    @foreach ($rProduct->filenames as $filename)
                    <img height="60px" src="{{asset('product/'.$rProduct->id.'/'.$filename)}}" />

                    <form style="display: inline" method="POST" action="{{url('product/delPhoto')}}">
                        @csrf
                        <input type="hidden" value="{{'product/'.$rProduct->id.'/'.$filename}}" name='filepath' />
                        <input type="submit" value="delete" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure ? ');">
                    </form>
                    <br>
                    @endforeach
                    @endif

                    <a href="{{ route('uploadPhoto', ['hotel_id' => $rProduct->hotels->id]) }}">
                        <button class='btn btn-xs btn-default'>upload</button>
                    </a>
                </td>

                <td>{{$rProduct->price}}</td>
                <td>{{$rProduct->hotels->name}}</td>
                <td><img src="{{asset('image/'.$rProduct->hotels->image)}}" /></td>
                <td>{{$rProduct->available_room}}</td>
                <td>
                    <a href="{{url('products/'.$rProduct->id."/edit")}}">
                        <button class="btn btn-xs btn-warning">Edit</button>
                    </a>

                    <a href="#modalEditA" class="btn btn-warning btn-xs" data-toggle="modal"
                        onclick="getEditForm({{$rProduct->id}})">Edit Type A</a>

                    <form style="display: inline;" method="POST" action="{{route('products.destroy',$rProduct->id)}}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="delete" class="btn btn-danger btn-xs "
                            onclick="return confirm('Are you sure to delete {{$rProduct->id}} - {{$rProduct->name}} ? ');">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('js')
<script>
    function getEditForm(product_id) {
        $.ajax({
            type: 'POST',
            url: '{{route("product.getEditForm")}}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': product_id
            },
            success: function (data) {
                $('#modalContent').html(data.msg)
            }
        });
    }
</script>
@endsection
