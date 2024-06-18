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
