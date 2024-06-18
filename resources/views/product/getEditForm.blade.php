<form method="POST" action="{{route('products.update', $data->id)}}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="exampleInputType">Name of Products</label>
        <input type="text" class="form-control" id="exampleInputType" name="products_name" 
            aria-describedby="nameHelp" placeholder="Enter Name of Products..." value="{{$data->name}}">
        <small id="nameHelp" class="form-text text-muted">Please write down the name of Products here.</small>

        <label for="exampleInputType">Price of Products</label>

        <input type="text" class="form-control" id="exampleInputType" name="products_price" 
            aria-describedby="nameHelp" placeholder="Enter Price of Products..." value="{{$data->price}}">
        <small id="nameHelp" class="form-text text-muted">Please write down the name of Price here.</small>
    </div>
    
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
